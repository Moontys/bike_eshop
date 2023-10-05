@extends('layouts.app')

@section('title')
    {{$product->bicycle_brand}}
@endsection

@section('content')
    <div class="jumbotron">
        <h1>bicycle.blade.php</h1>
            <div class="well">
                <h1><a href="/bicycle/{{$product->id}}">{{$product->bicycle_brand}}</a></h1>
                <h1>{{$product->bicycle_price}}</h1>
                <h3>{{$product->bicycle_description}}</h3>
                <hr>
                <h5>{{$product->created_at}}</h5>
            </div>
    </div>
@endsection
