@extends('layouts.app')

@section('title')
    Home
@endsection

@section('content')
    <div class="jumbotron">
        <h1>index.blade.php</h1>
        @foreach ($products as $product)
            <div class="well">
                <h1><a href="/bicycle/{{$product->id}}">{{$product->bicycle_brand}}</a></h1>
                <h1>{{$product->bicycle_price}}</h1>
            </div>
        @endforeach
    </div>

    <br><br><br><br><br><br>

    <h3><a href="{{URL::to('/all_bicycles')}}">ALL bicycles in the basment</a></h3>
@endsection
