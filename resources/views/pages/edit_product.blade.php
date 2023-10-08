@extends('layouts.app')

@section('title')
    EDIT PRODUCT
@endsection

@section('content')

    @if(Session::has('success'))
        <div class="alert alert-success">
            {{Session::get('success')}}
            {{Session::put('success', null)}}
        </div>
    @endif


    {!!Form::open(['action' => 'App\Http\Controllers\ProductController@updateEditedProduct', 'method' => 'POST', 'class' => 'form-horizontal'])!!}

    {{csrf_field()}}

        <div class="form-group">
            {{ Form::hidden('id', $product->id) }}  {{--ar tas susiijas su edit.blade.php (22 eilute)?--}}
            
            {{ Form::label('', 'Product Brand') }}
            {{ Form::text('product_brand', $product->bicycle_brand, ['placeholder' => 'Enter Bicycle\'s Brand', 'class' => 'form-control']) }}
        </div>
        <div class="form-group">
            {{ Form::label('', 'Product Price') }}
            {{ Form::number('product_price', $product->bicycle_price, ['placeholder' => 'Enter Bicycle\'s Price', 'class' => 'form-control']) }}
        </div>
        <div class="form-group">
            {{ Form::label('', 'Product Description') }}
            {{ Form::textarea('product_description', $product->bicycle_description, ['placeholder' => 'Enter Bicycle\'s Description', 'class' => 'form-control']) }}
        </div>

        {{Form::submit('Edit Product', ['class' => 'btn btn-primary'])}}

    {!!Form::close()!!}

@endsection