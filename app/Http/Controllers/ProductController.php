<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Interfaces\ProductRepositoryInterface;
use App\Models\Product;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    private ProductRepositoryInterface $productRepositoryInterface;

    public function __construct(ProductRepositoryInterface $productRepositoryInterface)
    {
        $this->productRepositoryInterface = $productRepositoryInterface;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = $this->productRepositoryInterface->index();

        $response = [
            "message" => "Product List",
            "data" => $products
        ];
        return response()->json($response, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        DB::beginTransaction();
        try {
            $item = [
                'name' => $request->name,
                'price' => $request->price,
                'stock' => $request->stock,
                'sold' => 0,
            ];

            $product = $this->productRepositoryInterface->store($item);

            DB::commit();

            $response = [
                "message" => "Product created successfully",
                "data" => $product
            ];
            return response()->json($response, 201);
        } catch (\Exception $ex) {
            DB::rollBack();
            Log::info($ex);
            throw new HttpResponseException(response()->json(["message" => "Something went wrong! Process not completed"], 500));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = $this->productRepositoryInterface->getById($id);

        if ($product) {
            $response = [
                "message" => "Product Detail",
                "data" => $product
            ];

            return response()->json($response, 200);
        } else {
            $response = [
                "message" => "Product not found",
            ];

            return response()->json($response, 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $product = $this->productRepositoryInterface->getById($id);

            if (!$product) {
                $response = [
                    "message" => "Product not found",
                ];

                return response()->json($response, 404);
            }

            $product->name = $request->name;
            $product->price = $request->price;
            $product->stock = $request->stock;
            $product->save();

            DB::commit();

            $response = [
                "message" => "Product updated successfully",
                "data" => $product
            ];
            return response()->json($response, 201);
        } catch (\Exception $ex) {
            DB::rollBack();
            Log::info($ex);
            throw new HttpResponseException(response()->json(["message" => "Something went wrong! Process not completed"], 500));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $product = $this->productRepositoryInterface->getById($id);

            if (!$product) {
                $response = [
                    "message" => "Product not found",
                ];

                return response()->json($response, 404);
            }

            $this->productRepositoryInterface->delete($id);

            DB::commit();

            $response = [
                "message" => "Product deleted successfully",
                "data" => $product
            ];
            return response()->json($response, 201);
        } catch (\Exception $ex) {
            DB::rollBack();
            Log::info($ex);
            throw new HttpResponseException(response()->json(["message" => "Something went wrong! Process not completed"], 500));
        }
    }
}
