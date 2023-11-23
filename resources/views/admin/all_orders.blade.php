@extends('admin_layout.admin')


@section('title')
    All Orders
@endsection


@section('content')


  <div class="content-wrapper">
  <!-- Content Wrapper. Contains page content -->
    <section class="content-header">
      <div class="container-fluid">

        @if (Session::has('error'))
          <div class="alert alert-danger">
            {{ Session::get('error') }}
          </div>
        @endif

      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card card-dark">

              <div class="card-header">
                <h3 class="card-title">All Orders</h3>
              </div>

              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Date</th>
                      <th>Address</th>
                      <th>Client Names</th>
                      <th>Orders</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>

                    @foreach ($allOrdersFromTable as $orderFromTable)
                      <tr>
                        <td>{{ $orderFromTable->created_at }}</td>
                        <td>{{ $orderFromTable->order_address }}</td>
                        <td>{{ $orderFromTable->order_name }}</td>

                        <td>
                          @foreach ($orderFromTable->order_cart->items as $item)
                            {{ $item['product_name'] . ', '}}
                          @endforeach
                        </td>
                        
                        <td>
                          <a href="{{ url('/view-pdf-order/' . $orderFromTable->id) }}" class="btn btn-primary"><i class="nav-icon fas fa-eye"></i></a>
                        </td>
                      </tr>
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
  <!-- AdminLTE for demo purposes -->
  <script src="backend/dist/js/bootbox.min.js"></script>

  <!-- page script -->
  <script>
    $(document).on("click", "#delete", function(e){
    e.preventDefault();
    var link = $(this).attr("href");
    bootbox.confirm("Do you really want to delete this element ?", function(confirmed){
      if (confirmed){
          window.location.href = link;
        };
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






