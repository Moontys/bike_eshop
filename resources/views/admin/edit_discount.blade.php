@extends('admin_layout.admin')


@section('title')
    Edit Discount
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
                        {{$error}}
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
                        <div class="card card-danger">

                            <div class="card-header">
                                <h3 class="card-title">Edit Discount</h3>
                            </div>

                            {!! Form::open(['action' => 'App\Http\Controllers\DiscountController@updateEditedDiscount', 'method' => 'POST']) !!}
                            {{ csrf_field() }}

                            <div class="card-body">
                                <div class="form-group">
                                    {{ Form::hidden('id', $discountByUrlId->id) }}  <!-- hidden "id" for method: "updateEditedDiscount" -->

                                    {{ Form::label('inputDiscountPercentage', 'Discount Percentage') }}
                                    {{ Form::number('discount_percentage', $discountByUrlId->discount_percentage, ['class' => 'form-control', 'id' => 'inputDiscountPercentage']) }}
                                </div>

                                <div class="form-group">
                                    {{ Form::label('inputDiscountName', 'Discount Name') }}
                                    {{ Form::text('discount_name', $discountByUrlId->discount_name, ['class' => 'form-control', 'id' => 'inputDiscountName']) }}
                                </div>

                                <div class="card-footer">
                                    {{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
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
    <script src="backend/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="backend/plugins/jquery-validation/additional-methods.min.js"></script>
    <!-- AdminLTE App -->
    <script src="backend/dist/js/adminlte.min.js"></script>

    <script src="../../dist/js/demo.js"></script>
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
