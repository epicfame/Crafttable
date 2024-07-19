@extends('layout.layout')

@section('content')
    <div class="button-action mb-2">
        <button onclick="back()" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Back</button>
        <button onclick="confirmDelete()" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</button>
    </div>
    <form name="edit_product" id="edit_product" method="POST" action="/products/{{$product->id}}/update">
        @csrf
        @method('PUT')
        <table>
            <tr>
                <td><label for="product_photo">Product Photo</label></td>
                <td><input type="file" name="product_photo" id="product_photo"></td>
            </tr>
            <tr>
                <td><label for="product_name">Product Name</label></td>
                <td><input type="text" name="product_name" id="product_name"></td>
            </tr>
            <tr>
                <td><label for="product_description">Product Description</label></td>
                <td><textarea name="product_description" id="product_description"></textarea></td>
            </tr>
        </table>
        <div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection

@section('script')
    <script>
        function back() {
            window.location.href = '/product';
        }

        function confirmDelete(){
            showConfirmationDialog('Confimation', 'Are you sure you want to delete this product', 'deleteProduct')
        }

        function deleteProduct(){
            $.ajax({
                url: "{{ url('/product/' . $product->id) }}",
                type: "DELETE",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if(response.success){
                        showMessage('success', response.message, 5);
                        setTimeout(() => { window.location.href = '/product'; }, 2000);
                    } else {
                        showMessage('error', response.message);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    showMessage('error', errorThrown);
                }
            });
        }

        function confirmUpdate(){
            showConfirmationDialog('Confimation', 'Are you sure you want to update this product', 'updateProduct')
        }

        $('#edit_product').submit(function(e){
            e.preventDefault()
            updateProduct();
        })

        function updateProduct(){
            $.ajax({
                url: "{{ route('products.updateproduct', ['id' => $product->id]) }}",
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    product_name: $('#product_name').val(),
                    product_description: $('#product_description').val()
                },
                success: function(response) {
                    if(response.success){
                        showMessage('success', response.message, 5);
                    } else {
                        showMessage('error', response.message);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    showMessage('error', errorThrown);
                }
            });
        }

        $(document).ready(function() {

            // set the current data
            $('#product_name').val('{{$product->product_name}}')
            $('#product_description').val('{{$product->product_description}}')

        });

    </script>
@endsection
