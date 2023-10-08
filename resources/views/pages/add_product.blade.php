@extends('layouts.app')

@section('title')
    ADD NEW BICYCLE
@endsection

@section('content')

    @if(Session::has('success'))
        <div class="alert alert-success">
            {{Session::get('success')}}
            {{Session::put('success', null)}}
        </div>
    @endif

    {!!Form::open(['action' => 'App\Http\Controllers\ProductController@saveAddedProduct', 'method' => 'POST', 'class' => 'form-horizontal'])!!}

    {{csrf_field()}}

        <div class="form-group">
            {{ Form::label('', 'Product Brand') }}
            {{ Form::text('product_brand', '', ['placeholder' => 'Enter Bicycle\'s Brand', 'class' => 'form-control']) }}
        </div>
        <div class="form-group">
            {{ Form::label('', 'Product Price') }}
            {{ Form::number('product_price', '', ['placeholder' => 'Enter Bicycle\'s Price', 'class' => 'form-control']) }}
        </div>
        <div class="form-group">
            {{ Form::label('', 'Product Description') }}
            {{ Form::textarea('product_description', '', ['placeholder' => 'Enter Bicycle\'s Description', 'class' => 'form-control']) }}
        </div>

        {{Form::submit('Add Product', ['class' => 'btn btn-primary'])}}

    {!!Form::close()!!}

@endsection

