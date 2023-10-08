@extends('layouts.app')

@section('title')
    Admin like For Now INDEX
@endsection


@section('content')

    @if(Session::has('success'))
        <div class="alert alert-success">
            {{Session::get('success')}}
            {{Session::put('success', null)}}
        </div>
    @endif

    <div class="jumbotron">
        <h1>admin_like_for_now_index.blade.php</h1>

        @foreach ($products as $product)
            <div class="well">
                <h1><a href="/admin-like-for-now/product/{{$product->id}}">{{$product->bicycle_brand}}</a></h1>
                <h1>{{$product->bicycle_price}}</h1>
            </div>
        @endforeach

    </div>

    <br><br><br><br><br><br>


    <h3><a href="{{URL::to('/admin-like-for-now/add-product')}}">Add new Product</a></h3>

    <br><br><br><br><br><br>

@endsection
