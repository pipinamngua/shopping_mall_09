@extends('admin.master')
@section('content')
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">Discount Program</div>
            <div class="panel-body">
                <discountprogram></discountprogram>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready( function () {
        $('#myTable').DataTable({'order': []});
    
    });
</script>
@endsection