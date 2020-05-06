<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $productData = $request->get('product');

        $product =\App\Product::whereSlug($productData['slug']);

        if(!$product->count() || $productData['amount']<1){
            return redirect()->route('home');
        }

        $product = $product->first(['name','price','store_id'])->toArray();
        $product = array_merge($productData,$product);

        // verificar se existe session para produtos
        if(session()->has('cart')){

            $products = session()->get('cart');
            $productsSlugs = array_column($products,'slug');

            if(in_array($product['slug'],$productsSlugs)){
                $products = $this->productIncrement($product['slug'],$product['amount'], $products);
                session()->put('cart',$products);
            } else {
                 //adicionar produto para sessão
                session()->push('cart', $product);
            }
        } else {
            // não existindo eu crio com o primeiro
            $products[] = $product;
            session()->put('cart',$products);
        }

        flash('Produto adicionado ao carrinho')->success();
        return redirect()->route('product.single',['slug' => $product['slug']]);      
    }

    public function index(){
        $cart = session()->has('cart') ? session()->get('cart') : [];

        
        return view('cart',compact('cart'));
    }

    public function remove($slug){
        if(!session()->has('cart')){
            return redirect()->route('cart.index');
        }    
        $products = session()->get('cart');

        $products = array_filter($products, function($line) use ($slug){

            return $line['slug'] != $slug;

        });

        session()->put('cart', $products);
        return redirect()->route('cart.index');
        
    }

    public function cancel(){
        session()->forget('cart');

        flash('Desistência da compra realizada com sucesso')->success();
        return redirect()->route('cart.index');
    }

    private function productIncrement($slug, $amount ,$products){

        $products = array_map(function($line) use ($slug, $amount){

            if($slug==$line['slug']){
                $line['amount'] += $amount;
            }

            return $line;

        }, $products);

        return $products;

    }
}
