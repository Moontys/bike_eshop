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
            {{ Form::hidden('id', $bicycleData->id) }}  {{--Hidden input field allows the server to identify which product is being edited or updated when the form is submitted--}}
            
            {{ Form::label('', 'Product Brand') }}
            {{ Form::text('product_brand', $bicycleData->bicycle_brand, ['placeholder' => 'Enter Bicycle\'s Brand', 'class' => 'form-control']) }}
        </div>
        <div class="form-group">
            {{ Form::label('', 'Product Price') }}
            {{ Form::number('product_price', $bicycleData->bicycle_price, ['placeholder' => 'Enter Bicycle\'s Price', 'class' => 'form-control']) }}
        </div>
        <div class="form-group">
            {{ Form::label('', 'Product Description') }}
            {{ Form::textarea('product_description', $bicycleData->bicycle_description, ['placeholder' => 'Enter Bicycle\'s Description', 'class' => 'form-control']) }}
        </div>

        {{Form::submit('Edit Product', ['class' => 'btn btn-primary'])}}

    {!!Form::close()!!}

@endsection


