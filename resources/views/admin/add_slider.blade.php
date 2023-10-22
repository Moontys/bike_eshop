@extends('admin_layout.admin')


@section('content')

 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Slider</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add Slider</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
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


        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">Add slider</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              {!! Form::open(['action' => 'App\Http\Controllers\SliderController@saveAddedSlider', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
              {{ csrf_field() }}

              <div class="card-body">
                  <div class="form-group">
                      {{ Form::label('inputProductName', 'Slider Description 1') }}
                      {{ Form::text('slider_description1', '', ['class' => 'form-control', 'placeholder' => 'Enter Description One', 'id' => 'inputProductName']) }}
                  </div>

                  <div class="form-group">
                      {{ Form::label('inputProductName', 'Slider Description 2') }}
                      {{ Form::text('slider_description2', '', ['class' => 'form-control', 'placeholder' => 'Enter Description Two', 'id' => 'inputProductName']) }}
                  </div>

                  <div class="form-group">
                    {{ Form::label('efectsForImageInput', 'Slider Image') }}

                    <div class="input-group">
                        <div class="custom-file">
                          
                        {{ Form::file('slider_image', ['class' => 'custom-file-input', 'id' => 'efectsForImageInput']) }}
                        {{ Form::label('inputProductImage', 'Choose file', ['class' => 'custom-file-label']) }}

                        </div>
                    </div>
                  </div>

              <div class="card-footer">
                  {{ Form::submit('Save', ['class' => 'btn btn-success']) }}
              </div>
              
              {!! Form::close() !!}
            </div>
            <!-- /.card --> 
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

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
          alert( "Form successful submitted!" );
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
            required: "Please enter a email address",
            email: "Please enter a vaild email address"
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