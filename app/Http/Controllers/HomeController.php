<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
//use Ramsey\Uuid\Uuid;


class HomeController extends Controller
{

    private $product;
    public function __construct(Product $product){

        $this->product = $product;
    }

    public function index()
    {
       // $var = strval(Uuid::uuid4());
        //var_dump($var);
       // var_dump(session()->get('pagseguro_session_code'));
        //session()->forget('pagseguro_session_code');

        //$products = $this->product->limit(6)->get();
        $products = $this->product->paginate(12);

        $stores = \App\Store::limit(3)->get();


        return view('welcome',compact('products','stores'));
    }

    public function single($slug){
        $product = $this->product->whereSlug($slug)->first();
        return view('single',compact('product'));
    }
}


/*

    Middleware: código executado entre a requisição (request) e a aplicação (lógica executada pelo acesso a uma rota)

*/
