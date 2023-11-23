@extends('admin_layout.admin')


@section('title')
    All Slider
@endsection


@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
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

            <div class="card card-warning">

              <div class="card-header">
                <h3 class="card-title">Add Slider</h3>
              </div>

              {!! Form::open(['action' => 'App\Http\Controllers\SliderController@saveAddedSlider', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
              {{ csrf_field() }}

              <div class="card-body">
                <div class="form-group">
                  {{ Form::label('inputSliderDescriptionOne', 'Slider Description 1') }}
                  {{ Form::text('slider_description1', '', ['class' => 'form-control', 'placeholder' => 'Enter Description One', 'id' => 'inputSliderDescriptionOne']) }}
                </div>

                <div class="form-group">
                  {{ Form::label('inputSliderDescriptionTwo', 'Slider Description 2') }}
                  {{ Form::text('slider_description2', '', ['class' => 'form-control', 'placeholder' => 'Enter Description Two', 'id' => 'inputSliderDescriptionTwo']) }}
                </div>

                <div class="form-group">
                  {{ Form::label('inputSliderImage', 'Slider Image') }}
                  <div class="input-group">
                    <div class="custom-file">
                      {{ Form::file('slider_image', ['class' => 'custom-file-input', 'id' => 'inputSliderImage']) }}
                      {{ Form::label('inputSliderImage', 'Choose file', ['class' => 'custom-file-label']) }}
                    </div>
                  </div>
                </div>

                <div class="card-footer">
                  {{ Form::submit('Save', ['class' => 'btn btn-success']) }}
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