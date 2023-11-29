@extends('admin_layout.admin')

@section('title')
    All Products
@endsection


@section('content')

{{ Form::hidden('', $increment = 1) }}

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">

        @if (Session::has('status'))
          <div class="alert alert-success">
              {{ Session::get('status') }}
          </div>
        @endif

      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card card-success">

              <div class="card-header">
                <h3 class="card-title">All Products</h3>
              </div>

              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Num.</th>
                      <th>Picture</th>
                      <th>Product Name</th>
                      <th>Product Category</th>
                      <th>Product Price</th>
                      <th>Discounts</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>

                    @foreach ($allProducts as $product)
                      <tr>
                        <td>{{ $increment }}</td>
                        <td>
                          <img src="storage/product_images/{{ $product->product_image }}" style="height:50px;width:50px" class="img-circle elevation-2" alt="User Image">
                        </td>
                        <td>{{ $product->product_name }}</td>
                        <td>{{ $product->category->category_name }}</td>
                        <td>{{ $product->product_price . ' €' }}</td>
                        <td>{{ $product->discount->discount_percentage ?? 0 }}</td>
                        <td>

                          @if ($product->product_status == 1)
                            <a href="{{ url('/unactivate-product/' . $product->id) }}" class="btn btn-success">Unactivate</a>
                          @else
                            <a href="{{ url('/activate-product/' . $product->id) }}" class="btn btn-warning">Activate</a>
                          @endif

                          <a href="{{ url('/edit-product/' . $product->id) }}" class="btn btn-primary"><i class="nav-icon fas fa-edit"></i></a>
                          <a href="{{ url('/delete-product/' . $product->id) }}" id="delete" class="btn btn-danger"><i class="nav-icon fas fa-trash"></i></a>
                        </td>
                      </tr>
                      
                    {{ Form::hidden('', $increment = $increment + 1) }}

                    @endforeach

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection



@section('external CSS link')
  <!-- external CSS link for the 'admin.blade.php' template -->
  <link rel="stylesheet" href="backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
@endsection



@section('scripts')
  <!-- DataTables -->
  <script src="backend/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="backend/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <!-- AdminLTE App -->
  <script src="backend/dist/js/adminlte.min.js"></script>
  <script src="backend/dist/js/bootbox.min.js"></script>

  <!-- page script -->
  <script>
    $(document).on("click", "#delete", function(e) {
      e.preventDefault();
      var link = $(this).attr("href");
      bootbox.confirm("Do you really want to delete this element?", function(confirmed) {
        if (confirmed) {
          window.location.href = link;
        }
      });
    });
  </script>
  <!-- page script -->
  <script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true,
        "autoWidth": false,
      });
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>
@endsection
