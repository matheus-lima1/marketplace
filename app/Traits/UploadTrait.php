<?php
namespace App\Traits;

use Illuminate\Http\Request;

trait UploadTrait{
    private function imageUpload($images, $imageColumn = null){

       
        $uploadedImages = [];

        if(is_array($images)){
            foreach($images as $i){
                if(!is_null($imageColumn)){
               $uploadedImages[] = [$imageColumn => $i->store('products','public')];
            }
        }
    } else {
        $uploadedImages = $images->store('logo','public');
    }
        return $uploadedImages;
    }
}