@extends('layout.layout')

@section('content')

    {{--
        Page for create, delete, and update product info
    --}}
    <div class="button-action mb-2">

    {{-- CREATE --}}
        <button id="create" class="btn btn-primary"><i class="fa fa-plus"></i> Create Product</button>
    </div>

    {{-- ADD DATATABLES --}}
    <table id="products-table" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Actions</th>
                <th>Product Name</th>
                <th>Product Description</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>

@endsection


@section('script')
    <script>
        document.getElementById('create').addEventListener('click', createProduct);

        function createProduct(){
            window.location.href = '/product/create'
        }

        // document.getElementById('delete').addEventListener('click', deleteProduct);

        // function deleteProduct(){
        //     window.location.href = '/product/delete'
        // }

        function editProduct($id){
            window.location.href = '/product/' + $id + '/edit'
        }

        $(document).ready(function() {
            $('#products-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('products.data') }}', // Your route to fetch products
                    type: 'GET'
                },
                columns: [
                    { data: 'actions', name: 'actions', orderable: false, searchable: false },
                    { data: 'product_name', name: 'product_name' },
                    { data: 'product_description', name: 'product_description' },
                ]
            })
        }) // DOCUMENT READY

    </script>
@endsection
