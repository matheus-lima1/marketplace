<h1>Olá, {{$user->name}}! Obrigado por sua inscrição !</h1>

<p>
    Faça bom proveito e é nois! <br>
    Seu email de cadastro é: <strong>{{$user->email}}</strong>
</p>
<hr>
Email enviado em {{date('d/m/Y H:i:s')}}