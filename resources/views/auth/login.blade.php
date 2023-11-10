@extends('layouts.app')

@section('content')


<login-component xyz="Propriedade 1" abc="Propriedade 2" numero-parcelas='Padrão camel case' token_csrf="{{@csrf_token()}}">

</login-component>

@endsection
