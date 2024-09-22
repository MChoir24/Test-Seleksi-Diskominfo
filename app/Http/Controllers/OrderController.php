<?php

namespace App\Http\Controllers;

use App\Http\Requests\Order\StoreOrderRequest;
use App\Interfaces\OrderRepositoryInterface;
use App\Models\Order;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    private OrderRepositoryInterface $orderRepositoryInterface;

    public function __construct(OrderRepositoryInterface $orderRepositoryInterface)
    {
        $this->orderRepositoryInterface = $orderRepositoryInterface;
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $order = $this->orderRepositoryInterface->index();

        $response = [
            "message" => "Order List",
            "data" => $order
        ];
        return response()->json($response, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        DB::beginTransaction();
        try {

            $order = $this->orderRepositoryInterface->store($request->products);

            DB::commit();

            $response = [
                "message" => "Order Created",
                "data" => $order
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
    public function show(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
