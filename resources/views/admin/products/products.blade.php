@extends('admin.master')
@section('content')
<div class="row"  id="categories">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">Product</div>
            <div class="panel-body">
                <div>
                    <form action="">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Product Name</label>
                                    <input type="text" class="form-control">
                                    <span></span>
                                </div>
                                <div class="form-group">
                                    <label for="">Description</label>
                                    <input type="text" class="form-control">
                                    <span></span>
                                </div>
                                <div class="form-group">
                                    <label for="">Image</label>
                                    <input type="text" class="form-control">
                                    <span></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Original Price</label>
                                    <input type="text" class="form-control">
                                    <span></span>
                                </div>
                                <div class="form-group">
                                    <label for="">Status</label>
                                    <input type="text" class="form-control">
                                    <span></span>
                                </div>
                                <div class="form-group">
                                    <label for="">Category</label>
                                    <input type="text" class="form-control">
                                    <span></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Create New Product">
                        </div>
                    </form>
                    <table class=" table table-striped table-bordered table-condensed">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Product Name</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Original Price</th>
                                <th>Status</th>
                                <th>Image</th>
                                <th>Image</th>
                                <th>Image</th>
                                <th colspan="2">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection