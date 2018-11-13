@extends('layouts.backend_vue')
@section('content')
    <div id="page-content">
        <div class="col-md-6">
            <login-api-component actionurl="{{route('api_v1_login_call')}}"></login-api-component>
        </div>
    </div>
    <combo-component data-url="{{route('api.v1.product.steelTypeList')}}"></combo-component>
    <combo-component data-url="{{route('api.v1.product.productTypeList')}}"></combo-component>
    <table-component data-url="{{route('api.v1.product.productTypeList')}}"></table-component>
@endsection


