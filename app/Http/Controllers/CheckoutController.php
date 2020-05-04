<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index(){


        if(!auth()->check()){
            return redirect()->route('login');
        } 

        $this->makePagSeguroSession();


        $cartItens = array_map(function($line){

            return $line['amount'] * $line['price'];

        }, session()->get('cart'));

        $cartItens = array_sum($cartItens);

        return view('checkout',compact('cartItens'));

    }

    public function proccess(Request $request){

        $reference = 'XPTO';
        $dataPost = $request->all();


        $creditCard = new \PagSeguro\Domains\Requests\DirectPayment\CreditCard();

        $creditCard->setReceiverEmail(env('PAGSEGURO_EMAIL'));

        $creditCard->setReference($reference);

        $creditCard->setCurrency("BRL");

        $cartItens = session()->get('cart');

        foreach($cartItens as $item){
        $creditCard->addItems()->withParameters(
            $reference,
            $item['name'],
            $item['amount'],
            $item['price']
        );
    }



        $user = auth()->user();
        $email = env('PAGSEGURO_ENV') == 'sandbox' ? 'test@sandbox.pagseguro.com.br' : $user->email;

        $creditCard->setSender()->setName($user->name);
        $creditCard->setSender()->setEmail($email);

        $creditCard->setSender()->setPhone()->withParameters(
            11,
            25550888149
        );

        $creditCard->setSender()->setDocument()->withParameters(
            'CPF',
            'insira um numero de CPF valido'
        );

        $creditCard->setSender()->setHash($dataPost['hash']);

        $creditCard->setSender()->setIp('127.0.0.0');

        $creditCard->setShipping()->setAddress()->withParameters(
            'Av. Brig. Faria Lima',
            '1384',
            'Jardim Paulistano',
            '01452002',
            'São Paulo',
            'SP',
            'BRA',
            'apto. 114'
        );

        $creditCard->setBilling()->setAddress()->withParameters(
            'Av. Brig. Faria Lima',
            '1384',
            'Jardim Paulistano',
            '01452002',
            'São Paulo',
            'SP',
            'BRA',
            'apto. 114'
        );

        $creditCard->setToken($dataPost['card_token']);

        list($quatity, $installmentAmount) = explode('|', $dataPost['installment']);
        

        $creditCard->setInstallment()->withParameters($quantity, $installmentAmount);

        $creditCard->setHolder()->setBirthdate('01/10/1979');
        $creditCard->setHolder()->setName($dataPost['card_name']); // Equals in Credit Card

        $creditCard->setHolder()->setPhone()->withParameters(
            11,
            56273440
        );

        $creditCard->setHolder()->setDocument()->withParameters(
            'CPF',
            '25550888149'
        );

        $creditCard->setMode('DEFAULT');

        $result = $creditCard->register(
            \PagSeguro\Configuration\Configure::getAccountCredentials()
        );

        var_dump($result);



    }

    private function makePagSeguroSession(){


        if(!session()->has('pagseguro_session_code')){
            $sessionCode = \PagSeguro\Services\Session::create(
                \PagSeguro\Configuration\Configure::getAccountCredentials()
            );

            return session()->put('pagseguro_session_code',$sessionCode->getResult());
            
        }
    }
}
