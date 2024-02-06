<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\Checkout\StoreCheckoutRequest;
use App\Http\Services\CashOnDeliveryService;
use App\Http\Services\MyFatoorahService;
use App\Http\Services\StripeService;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\StripeSetting;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Stripe\Stripe;

class CheckoutController extends Controller
{

    public function __construct(StripeService $stripeService, CashOnDeliveryService $codService , MyFatoorahService $fatoorah)
    {
        $this->stripeService = $stripeService;
        $this->codService = $codService;
        $this->myfatoorahService = $fatoorah;
    }

    public function index(){
    // Retrieve categories for the dropdown or other UI elements
    $categories = Category::with(['subCategories' => function ($query) {
        $query->where('status',1)->select('id', 'category_id', 'slug','image');
    }, 'translations'])->where('status', 1)->select('id', 'slug','image')->get();

    // Retrieve cart items for the current user
        $cartItems = Cart::content()->map(function ($item) {
            $product = Product::with('images')->find($item->id);
            return [
                'rowId' => $item->rowId,
                'id' => $item->id,
                'name' => $item->name,
                'qty' => $item->qty,
                'price' => $item->price,
                'subtotal' => $item->subtotal,
                'image' => $product->images->first()->image ?? 'default.png', // Assuming 'image' is the correct field
            ];
        });
    $cartSubtotal = Cart::subtotal(); // This gives you the subtotal without shipping
    $shippingFee = $this->calculateShippingFee(); // Implement this method based on your shipping logic
    $total = (float)str_replace(',', '', $cartSubtotal) + $shippingFee; // Convert subtotal to float and add shipping fee

    $order_details = ['cartItems' => $cartItems ,'total' => $total];
    Session::put('order_details', $order_details);
    // Pass the cart items and totals to the checkout view
        return view('front.pages.checkout', [
            'categories' => $categories,
            'cartItems' => $cartItems,
            'cartSubtotal' => Cart::subtotal(),
            'shippingFee' => $this->calculateShippingFee(),
            'total' => $total
        ]);
}

    private function calculateShippingFee()
    {
        // Implement your logic here to calculate shipping fee based on cart items
        // For example, you might offer free shipping over a certain subtotal amount
        $subtotal = Cart::subtotal();
        return $subtotal > 1000 ? 0 : 30; // Free shipping for orders over $1000, else $10 fee
    }


    public function store(StoreCheckoutRequest $request)
    {
        $order_details = Session::get('order_details');

        $checkoutDetails = [
          'user_id' => auth()->user()->id,
          "name" => $request->name,
          "email" => $request->email,
          "city" => $request->city,
          "phone" => $request->phone,
          "address" => $request->address,
          "notes" => $request->notes,
          "payment_method" => $request->payment_method,
          'total' => $order_details['total'],
          'cart_items' => $order_details['cartItems'],
        ];
//        dd($checkoutDetails);
        Session::put('checkout_details', $checkoutDetails);
        $paymentMethod = $request->payment_method;
        $total = $order_details['total'];
        try {
            switch ($paymentMethod) {
                case 'stripe':
                    return $this->stripeService->stripePayment($total);
                case 'cod':
                    return $this->codService->codPayment();
                case 'myfatoorah':
                    return $this->myfatoorahService->checkout($request , $checkoutDetails);
                default:
                    throw new \Exception('Invalid payment method selected.');
            }
        } catch (\Exception $e) {
            report($e);
            return back()->withErrors('Error processing your request: ' . $e->getMessage());
        }

    }



    public function stripeSuccess(Request $request)
    {
        $checkout_details = Session::get('checkout_details');
        $cartProducts = $checkout_details['cart_items'];
        DB::transaction(function () use ($checkout_details, $cartProducts) {
            $order = Order::create([
                'payment_method' => 'stripe',
                'phone' => $checkout_details['phone'],
                'user_id' => $checkout_details['user_id'],
                'name' => $checkout_details['name'],
                'email' => $checkout_details['email'],
                'city' => $checkout_details['city'],
                'address' => $checkout_details['address'],
                'notes' => $checkout_details['notes'] ?? NULL,
                'payment_status' => 'success',
                'total_amount' => $checkout_details['total']
            ]);

            foreach ($cartProducts as $product) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product['id'],
                    'quantity' => $product['qty'],
                    'price' => $product['price'],
                ]);
            }
        });

//        OrderPlacedNotificationEvent::dispatch($order);
        Cart::destroy();

        toast()->success('Payment successful and order confirmed!');
        return redirect()->route('home');
    }

    public function stripeCancel()
    {
        toast()->error('Payment failed, Please try again.');
        return redirect()->route('checkout.index');
    }


    public function myfatoorahSuccess(Request $request)
    {
        $paymentId = $request->paymentId;

        // This call will handle the API response
        $invoiceDetails = $this->myfatoorahService->handleCallback($paymentId);
//        dd($invoiceDetails['Data']['InvoiceId']);
        // Assuming $invoiceDetails['Data']['InvoiceStatus'] is available and contains the status
        if ($invoiceDetails['Data']['InvoiceStatus'] === 'Paid') {
            $checkoutDetails = Session::get('checkout_details');
            $cartProducts = $checkoutDetails['cart_items'];

            DB::transaction(function () use ($invoiceDetails, $checkoutDetails, $cartProducts) {
                $order = Order::create([
                    'payment_method' => 'myfatoorah',
                    'phone' => $checkoutDetails['phone'],
                    'user_id' => $checkoutDetails['user_id'],
                    'name' => $checkoutDetails['name'],
                    'email' => $checkoutDetails['email'],
                    'city' => $checkoutDetails['city'],
                    'address' => $checkoutDetails['address'],
                    'notes' => $checkoutDetails['notes'] ?? null,
                    'payment_status' => 'success',
                    'total_amount' => $checkoutDetails['total'],
                    'invoice_id' => $invoiceDetails['Data']['InvoiceId'],
                ]);

                foreach ($cartProducts as $product) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $product['id'],
                        'quantity' => $product['qty'],
                        'price' => $product['price'],
                    ]);
                }
            });

            // Clear the cart after successful payment
            Cart::destroy();
            Session::forget('checkout_details');
            Session::forget('order_details');

            // Return success message and redirect to a thank you page or home page
            toast()->success('Payment successful and order confirmed!');
            return redirect()->route('home');
        } else {
            // Handle non-successful payment statuses
            toast()->error('Payment failed or is pending.');
            return redirect()->route('checkout.index');
        }
    }

    public function myfatoorahError(Request $request)
    {
        // Log the error or handle it as needed
        Log::error('MyFatoorah payment error', ['request' => $request->all()]);

        // Return error message and redirect to the checkout page
        toast()->error('Payment failed, Please try again.');
        return redirect()->route('checkout.index');
    }

}
