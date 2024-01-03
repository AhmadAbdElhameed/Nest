<?php

namespace App\Http\Traits;

use App\Http\Requests\Admin\ProductImageGallery\StoreProductImageGalleryRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Request;

trait ImageTrait
{
    protected function uploadImage2($newImag, $path, $oldImag = null)
    {

        if (isset($newImag)) {
            $this->removeImage($oldImag);
            $image_name = time() . '_' . $newImag->hashName();
            $newImag->move($path, $image_name);
            return  $image_name;
        }
        return $oldImag;
    }

    public function uploadMultiImage(StoreProductImageGalleryRequest $request , $inputName , $path){
        $paths = [];
        if ($request->hasFile($inputName)) {
            $images = $request->{$inputName};

            foreach ($images as $image){
                $ext = $image->getClientOriginalExtension();
                $imageName = 'product_image_'.uniqid() .'.'. $ext;
                $image->move(public_path($path),$imageName);
                $paths[] = $path . '/' . $imageName;
            }
            return $paths;

        }
    }


    protected function removeImage($path): void
    {
        if (isset($path) && File::exists(public_path($path))) {
            File::delete(public_path($path));
        }
    }

    public function deleteImage($path){
        if(File::exists(public_path($path))){
            File::delete(public_path($path));
        }
    }
}

