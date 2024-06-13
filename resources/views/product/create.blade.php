@extends('layout.layout')

@section('content')
    <div class="button-action mb-2">
        <button onclick="back()" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Back</button>
    </div>
    <form name="create_product" id="create_product" method="POST" action="{{ url('/product') }}">
        @csrf
        <table>
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
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
@endsection

@section('script')
    <script>
        function back() {
            window.location.href = '/product';
        }
        $(document).ready(function() {
            $('#create_product').submit(function(event) {
                // Prevent default posting of form
                event.preventDefault();

                $.ajax({
                    url: "{{ url('/product') }}",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        product_name: $('#product_name').val(),
                        product_description: $('#product_description').val()
                    },
                    success: function(response) {
                        // Handle success response
                        if(response.success == true){
                            showMessage('success', response.message, 5)
                        }
                        else{
                            showMessage('error', response.message)
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        // Handle error response
                        showMessage('error', errorThrown)
                    }
                });
            });
        });
    </script>
@endsection
