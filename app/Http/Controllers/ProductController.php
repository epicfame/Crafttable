<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;

// MODEL
use App\Models\Product;

class ProductController extends Controller
{
    // return view('', ['title' => '']);
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Index for product
        return view('product.index', ['title' => 'Product']);
    }

    /**
     *
     */
    public function getData(Request $request){
        // get the data
        $products = Product::all();
        return DataTables::of($products)
            ->addColumn('actions', function($product) {
                return '<button class="btn btn-sm btn-primary" onclick="editProduct('.$product->id.')"><i class="fa fa-edit"></i></button>';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Index for create product
        return view('product.create', ['title' => 'Create Product']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $response = [
            'success' => false,
            'message' => 'UNKNOWN ERROR',
            'datas' => [],
        ];
        try {
            // Example: Store product logic
            // Assuming you have a Product model
            $productName = $request->product_name != '' ? strtoupper($request->product_name) : '';
            $productDescription = $request->product_description != '' ? strtoupper($request->product_description) : '';

            // validate the input
            // 1. Product name must be filled
            if($productName == ''){
                $response['message'] = 'Product name must be filled!';
                return response()->json($response);
            }

                        // 2. Product name must be unique
            $tempProduct = Product::where('product_name', $productName)
                                    ->first();
            if($tempProduct != ''){
                $response['message'] = 'Product name must be unqiue!';
                return response()->json($response);
            }

            // save to the database for connection from config
            $connectionName = config('database.default');
            $connection = DB::connection($connectionName);
            $connection->beginTransaction();

            $product = new Product();
            $product->product_name = $productName;
            $product->product_description = $productDescription;
            $product->save();

            $connection->commit();

            $response['success'] = true;
            $response['message'] = 'Product created successfully';
            $response['datas'] = $product;

            return response()->json($response);
        } catch (\Exception $e) {
            if (isset($connection)) {
                $connection->rollBack();
            }
            Log::error('Error in store product: ' . $e->getMessage());
            return response()->json($response);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $product = Product::find($id);
        if($product == ''){
            return redirect('/product');
        }



        // jika ketemu idnya

        return view('product.edit', [
            'title' => 'Edit Product',
            'product' => $product
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $response = [
            'success' => false,
            'message' => 'UNKNOWN ERROR',
            'datas' => [],
        ];
        try {

            //validate the id
            if($id == ''){
                $response['message'] = 'No data found';
                return response()->json($response);
            }

            $product = Product::find($id);
            if($product == ''){
                $response['message'] = 'No data found';
                return response()->json($response);
            }

            // Example: Store product logic
            $productName = $request->product_name != '' ? strtoupper($request->product_name) : '';
            $productDescription = $request->product_description != '' ? strtoupper($request->product_description) : '';

            // validate the input
            // 1. Product name must be filled
            if($productName == ''){
                $response['message'] = 'Product name must be filled!';
                return response()->json($response);
            }

            // 2. Product name must be unique
            $tempProduct = Product::where('product_name', $productName)
                                    ->where('id', '!=', $id)
                                    ->first();
            if($tempProduct != ''){
                $response['message'] = 'Product name must be unqiue!';
                return response()->json($response);
            }

            // save to the database for connection from config
            $connectionName = config('database.default');
            $connection = DB::connection($connectionName);
            $connection->beginTransaction();

            $product = Product::find($id);
            $product->product_name = $productName;
            $product->product_description = $productDescription;
            $product->save();

            $connection->commit();

            $response['success'] = true;
            $response['message'] = 'Product updated successfully';
            $response['datas'] = $product;

            return response()->json($response);
        } catch (\Exception $e) {
            if (isset($connection)) {
                $connection->rollBack();
            }
            Log::error('Error in update product: ' . $e->getMessage());
            return response()->json($response);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
