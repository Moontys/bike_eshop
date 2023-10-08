@extends('layouts.app')

@section('title')
    {{$product->bicycle_brand}}
@endsection

@section('content')
    <div class="jumbotron">
        <h1>product.blade.php</h1>
            <div class="well">
                <h1>{{$product->bicycle_brand}}</h1>
                <hr>
                <h2>{{$product->bicycle_price}}</h2>
                <hr>
                <h3>{{$product->bicycle_description}}</h3>
                <hr>
                <h5>{{$product->created_at}}</h5>
                <hr><hr>
                <a href="/admin-like-for-now/edit-product/{{$product->id}}" class="btn btn-default">Edit</a>
                <a href="/admin-like-for-now/delete-product/{{$product->id}}" class="btn btn-danger">Delete</a>
            </div>
    </div>
@endsection