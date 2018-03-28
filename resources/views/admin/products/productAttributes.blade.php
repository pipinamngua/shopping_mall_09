@extends('admin.master')
@section('content')
<div class="row"  id="categories">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">Product</div>
            <div class="panel-body">
                <addcolor></addcolor>
                
            </div>
        </div>
    </div>
</div>
@endsection
<script type="application/json" name="id_data">
    {{ $id }}
</script>
<!-- Inserts server data into window.server_data -->
<script>
    var json = document.getElementsByName("id_data")[0].innerHTML;
    var id = JSON.parse(json);
        
    
</script>
@section('script')
<script>
    $(document).ready( function () {
        $('#myTable').DataTable({'order': []});

    });
</script>
    
@endsection
