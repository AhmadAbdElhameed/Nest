<?php

namespace App\Http\Traits;
use App\Http\Requests\Admin\ProductImageGallery\StoreProductImageGalleryRequest;
use App\Http\Requests\Admin\Slider\StoreSliderRequest;
use App\Http\Requests\Admin\Slider\UpdateSliderRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

trait ImageUploadTrait
{
    public function uploadImage(Request $request , $inputName , $path){
        if ($request->hasFile($inputName)) {
            $image = $request->{$inputName};
//            $imageName = rand() . '_' . $image->getClientOriginalName();
            $ext = $image->getClientOriginalExtension();
            $imageName = 'media_'.uniqid() .'.'. $ext;
            $image->move(public_path($path),$imageName);

            return $path . '/' . $imageName;
        }
    }

    public function updateImage(UpdateSliderRequest $request , $inputName , $path , $oldPath = null){
        if ($request->hasFile($oldPath)) {
            $image = $request->{$oldPath};
//            $imageName = rand() . '_' . $image->getClientOriginalName();
            $ext = $image->getClientOriginalExtension();
            $imageName = 'media_'.uniqid() .'.'. $ext;
            $image->move(public_path($path),$imageName);

            return $path . '/' . $imageName;
        }
    }

    public function updateAnyImage(Request $request, $inputName, $path, $oldPath=null)
    {
        if($request->hasFile($inputName)){
            if(File::exists(public_path($oldPath))){
                File::delete(public_path($oldPath));
            }

            $image = $request->{$inputName};
            $ext = $image->getClientOriginalExtension();
            $imageName = 'media_'.uniqid().'.'.$ext;

            $image->move(public_path($path), $imageName);

            return $path.'/'.$imageName;
        }
    }

    public function uploadMultiImage(Request $request , $inputName , $path){
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
