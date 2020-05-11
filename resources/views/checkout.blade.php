@extends('layouts.front')

@section('stylesheet')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endsection

@section('content')

    <div class="container">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12">
                    <h2>Dados para Pagameto</h2>
                    <hr>
                </div>
                
            </div>
            <form action="" method="POST">

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>Nome do Cartão</label>
                        <input type="text" class="form-group" name="card_name">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>Número do Cartão <span class="brand"></span></label>
                        <input type="text" class="form-group" name="card_number">
                        <input type="hidden" name="card_brand">
                    </div>
                </div>
    
                <div class="row">
                    <div class="col-md-4 form-group">
                        <label>Mês de Expiração</label>
                        <input type="text" class="form-group" name="card_month">
                    </div>

                    <div class="col-md-4 form-group">
                        <label>Ano de Expiração</label>
                        <input type="text" class="form-group" name="card_year">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-5 form-group">
                        <label>Código de segurança</label>
                        <input type="text" class="form-group" name="card_cvv">
                    </div>
                    <div class="col-md-12 installments form-group">

                    </div>
                </div>

                <button class="btn btn-success btn-lg proccessCheckout">Efetuar Pagamento</button>
            </form>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js">
    </script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    
    <script>
        const sessionId = '{{session()->get('pagseguro_session_code')}}';
        const urlThanks = '{{route('checkout.thanks')}}';
        const amountTransaction = '{{$cartItens}}';
        const urlProccess = '{{route("checkout.proccess")}}';
        const csrf = '{{csrf_token()}}';
        
        PagSeguroDirectPayment.setSessionId(sessionId);
    </script>

<script src="{{asset('js/pagseguro_functions.js')}}"></script>
<script src="{{asset('js/pagseguro_events.js')}}"></script>
@endsection