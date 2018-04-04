@extends('admin.master')

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="box">
                <div class="box-header">
                  <h3 class="box-title">List User</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <users></users>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        });
    </script>
@endsection
