<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payment\PagSeguro\CreditCard;
use App\Payment\PagSeguro\Notification;
use App\Store;
use Ramsey\Uuid\Uuid;
use App\UserOrder;

class CheckoutController extends Controller
{
    public function index(){

        //var_dump(session()->get('pagseguro_session_code'));
        //session()->forget('pagseguro_session_code');

        if(!auth()->check()){
            return redirect()->route('login');
        } 

        if(!session()->has('cart')){
            return redirect()->route('home');
        }
        
        $this->makePagSeguroSession();


        $cartItens = array_map(function($line){

            return $line['amount'] * $line['price'];

        }, session()->get('cart'));

        $cartItens = array_sum($cartItens);

        return view('checkout',compact('cartItens'));

    }

    public function proccess(Request $request){
        
        try {
        $cartItens = session()->get('cart');
        $user = auth()->user();
        $dataPost = $request->all();
        $stores = array_unique(array_column($cartItens,'store_id'));
        $reference = strval(Uuid::uuid4());

        $creditCardPayment = new CreditCard($cartItens, $user, $dataPost, $reference);
        $result = $creditCardPayment->doPayment();

        $userOrder = [
            'reference' => $reference,
            'pagseguro_code' => $result->getCode(),
            'pagseguro_status' => $result->getStatus(),
            'items' => serialize($cartItens)
            
        ];

        $userOrder = $user->orders()->create($userOrder);
        $userOrder->stores()->sync($stores);

        $store = (new Store())->notifyStoreOwners($stores);

        session()->forget('cart');
        session()->forget('pagseguro_session_code');

        return response()->json([
            'data' => [
                'status' => true,
                'message' => 'Pedido criado com sucesso',
                'order' => $reference
            ]
        ]);

        } catch (\Exception $e) {

            $message = env('APP_DEBUG') ? $e->getMessage() : 'Erro ao processar pedido.';

            return response()->json([
            'data' => [
                'status' => false,
                'message' => $message
            ] 
            ], 401);
        }


    }

    public function thanks(){
        return view('thanks');
    }

    public function notification(){
        try{

            $notification = new Notification();

            $notification = $notification->getTransaction();

            // Atualizar

            $reference = base64_decode($notification->getReference());

            $userOrder = UserOrder::whereReference($reference);
            $userOrder->update([
                'pagseguro_status' => $notification->getStatus()
            ]);

            //Comentario

            return response()->json([],204);

        } catch(Exception $e){
            $message = env('APP_DEBUG') ? $e->getMessage() : '';
            return response()->json(['error' => $message],500);
        }
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
