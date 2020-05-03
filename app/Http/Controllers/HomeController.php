<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class HomeController extends Controller
{

    private $product;
    public function __construct(Product $product){

        $this->product = $product;
    }

    public function single($slug){
        $product = $this->product->whereSlug($slug)->first();
        return view('single',compact('product'));
    }

    public function index()
    {
        $products = $this->product->limit(9)->get();
        return view('welcome',compact('products'));
    }
}


/*

    Middleware: código executado entre a requisição (request) e a aplicação (lógica executada pelo acesso a uma rota)

*/
