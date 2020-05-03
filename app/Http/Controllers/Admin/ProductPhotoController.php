<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ProductPhoto;
use Illuminate\Support\Facades\Storage;

class ProductPhotoController extends Controller
{
    public function removePhoto(Request $request){

        $photoName = $request->get('photoName');

        // Remove dos arquivos
        if(Storage::disk('public')->exists($photoName)){

            Storage::disk('public')->delete($photoName);

        }

        // Remove do banco
        $removePhoto = ProductPhoto::where('image',$photoName);
        $productId = $removePhoto->first()->product_id;

        $removePhoto->delete();
        flash('Imagem removida!')->success();

        return redirect()->route('admin.products.edit',['product' => $productId]);

    }
}
