@extends('admin_layout.admin')

@section('title')
    Edit Product
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">


                @if (Session::has('status'))
                    <div class="alert alert-success">
                        {{ Session::get('status') }}
                    </div>
                @endif

                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            {{ $error }}
                        @endforeach
                    </div>
                @endif

            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-success">

                            <div class="card-header">
                                <h3 class="card-title">Edit Product</h3>
                            </div>

                            {!! Form::open(['action' => 'App\Http\Controllers\ProductController@updateEditedProduct', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                            {{ csrf_field() }}

                            <div class="card-body">
                                <div class="form-group">
                                    {{ Form::hidden('id', $productByUrlId->id) }}  <!-- hidden "id" for method: "updateEditedProduct" -->

                                    {{ Form::label('inputProductName', 'Product Name') }}
                                    {{ Form::text('product_name', $productByUrlId->product_name, ['class' => 'form-control', 'id' => 'inputProductName']) }}
                                </div>

                                <div class="form-group">
                                    {{ Form::label('inputProductPrice', 'Product Price') }}
                                    {{ Form::number('product_price', $productByUrlId->product_price, ['class' => 'form-control', 'id' => 'inputProductPrice']) }}
                                </div>

                                <div class="form-group">
                                    {{ Form::label('inputProductDiscount', 'Product Discount') }}
                                    {{ Form::select('products_discount_id_discounts_id', [null => 'Please Select Discount Name'] + $allDiscountNames, $productByUrlId->discount_id, ['class' => 'form-control', 'id' => 'inputProductDiscount']) }}
                                </div>

                                <div class="form-group">
                                    {{ Form::label('inputProductCategoryName', 'Product Category Name') }}
                                    {{ Form::select('products_category_id_categories_id', $allCategoryNames, $productByUrlId->category_id, ['class' => 'form-control select', 'id' => 'inputProductCategoryName']) }}
                                </div>

                                <div class="form-group">
                                    {{ Form::label('inputProductDescription', 'Product Description') }}
                                    {{ Form::textarea('product_description', $productByUrlId->product_description, ['class' => 'form-control', 'id' => 'inputProductDescription']) }}
                                </div>

                                <div class="form-group">
                                    {{ Form::label('inputProductImage', 'Product Image') }}
                                    <div class="input-group">
                                        <div class="custom-file">
                                            {{ Form::file('product_image', ['class' => 'custom-file-input', 'id' => 'inputProductImage']) }}
                                            {{ Form::label('inputProductImage', 'Choose file', ['class' => 'custom-file-label']) }}
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    {{ Form::submit('Update', ['class' => 'btn btn-success']) }}
                                </div>
                            
                            {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection



@section('scripts')
<!-- jquery-validation -->
<script src="{{ asset('backend/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('backend/plugins/jquery-validation/additional-methods.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('backend/dist/js/adminlte.min.js') }}"></script>
<script src="{{ asset('backend/dist/js/demo.js') }}"></script>
<script>
    $(function () {
        $.validator.setDefaults({
            submitHandler: function () {
                alert("Form successfully submitted!");
            }
        });
        $('#quickForm').validate({
            rules: {
                email: {
                    required: true,
                    email: true,
                },
                password: {
                    required: true,
                    minlength: 5
                },
                terms: {
                    required: true
                },
            },
            messages: {
                email: {
                    required: "Please enter an email address",
                    email: "Please enter a valid email address"
                },
                password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 5 characters long"
                },
                terms: "Please accept our terms"
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>
@endsection
