@extends('layouts.app')

@section('title')
    Home
@endsection

@section('content')
    <div class="jumbotron">
        <h1>admin_like_for_now_index.blade.php</h1>

        @foreach ($products as $product)
            <div class="well">
                <h1><a href="/bicycle/{{$product->id}}">{{$product->bicycle_brand}}</a></h1>
                <h1>{{$product->bicycle_price}}</h1>
            </div>
        @endforeach

    </div>

    <br><br><br><br><br><br>

@endsection
