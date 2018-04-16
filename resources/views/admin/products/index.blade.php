@extends('admin/layouts.app')
@section('content')
<div class="row form-group">
    <div class="col-md-6">
        <a class="browse btn btn-primary" type="button"><i class="glyphicon glyphicon-import"></i>Import Product</a>
        <input style="display: none;" name="productCsv" type="file">
        <a class="browse btn btn-danger" type="button"><i class="glyphicon glyphicon-import"></i>Delete Product</a>
        <input style="display: none;" name="deleteCsv" type="file">
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <table class="ui celled table" id="product-table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>sku</th>
                    <th>Brand</th>
                    <th>msrp</th>
                    <th>Price</th>
                    <th>Cost</th>
                    <th>Ship Cost</th>
                    <th>Options</th>
                    <th>Created At</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@push('scripts')
<script type="text/javascript">
    $(document).ready(function () {
        $('#product-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('products.index') }}",
            columns: [
                {data: 'DT_Row_Index', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'sku', name: 'sku'},
                {data: 'brand', name: 'brand'},
                {data: 'msrp', name: 'msrp'},
                {data: 'price', name: 'price'},
                {data: 'cost', name: 'cost'},
                {data: 'ship_cost', name: 'ship_cost'},
                {data: 'options', name: 'options'},
                {data: 'created_at', name: 'created_at'}
            ]
        });

        $(document).on('click', '.browse', function () {
            var file = $(this).next();
            file.trigger('click');
        });

        $(document).on('change', 'input[name=productCsv]', function (e) {
            $("#loaderOverlay").show();
            var formData = new FormData();
            formData.append('productCsv', $(this)[0].files[0]);
            $.ajax({
                url: "{{ route('products.import') }}",
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (data) {
                    $("#loaderOverlay").hide();
                    window.location.reload();
                },
                error: function (error) {
                    $("#loaderOverlay").hide();
                    alert('Something went wrong,please try again later!');
                }

            });
            return false;
        });
        $(document).on('change', 'input[name=deleteCsv]', function (e) {
            $("#loaderOverlay").show();
            var formData = new FormData();
            formData.append('deleteCsv', $(this)[0].files[0]);
            $.ajax({
                url: "{{ route('products.delete') }}",
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (data) {
                    $("#loaderOverlay").hide();
                    window.location.reload();
                },
                error: function (error) {
                    $("#loaderOverlay").hide();
                    alert('Something went wrong,please try again later!');
                }

            });
            return false;
        });
    });
</script>
@endpush
@endsection
