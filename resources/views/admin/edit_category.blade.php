@extends('admin_layout.admin')

@section('title')
    Edit Category
@endsection


@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">

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
                        <div class="card card-primary">

                            <div class="card-header">
                                <h3 class="card-title">Edit Category</h3>
                            </div>

                            {!! Form::open(['action' => 'App\Http\Controllers\CategoryController@updateEditedCategory', 'method' => 'POST']) !!}
                            {{ csrf_field() }}

                            <div class="card-body">
                                <div class="form-group">
                                    {{ Form::hidden('id', $categoryByUrlId->id) }}  <!-- hidden "id" for method: "updateEditedCategory" -->

                                    {{ Form::label('inputCategoryName', 'Category Name') }}
                                    {{ Form::text('category_name', $categoryByUrlId->category_name, ['class' => 'form-control', 'placeholder' => 'Enter Category Name', 'id' => 'inputCategoryName']) }}
                                </div>

                                <div class="card-footer">
                                    {{ Form::submit('Update', ['class' => 'btn btn-primary']) }}
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

    {{-- <script src="{{ asset('backend/dist/js/demo.js') }}"></script> --}}
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
