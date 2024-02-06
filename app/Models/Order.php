<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'email', 'name', 'city', 'address','phone',
        'notes', 'total_amount','payment_method','payment_status','invoice_id'];


    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

}
