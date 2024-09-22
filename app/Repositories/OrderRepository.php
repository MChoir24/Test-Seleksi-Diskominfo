<?php

namespace App\Repositories;

use App\Models\Order;
use App\Interfaces\OrderRepositoryInterface;
use App\Models\OrderDetail;
use App\Models\Product;

class OrderRepository implements OrderRepositoryInterface
{
   public function index()
   {
      return Order::with('order_detail.product')
         ->get();
   }

   public function getById($id)
   {
      return Order::find($id);
   }

   public function store(array $datas)
   {
      $order = Order::create();
      foreach ($datas as $key => $value) {
         $item  = [
            'quantity' => $value['quantity'],
            'product_id' => $value['id'],
            'order_id' => $order->id
         ];

         $order_detail = OrderDetail::create($item);

         $product = Product::find($value['id']);
         $product->sold += 1;
         $product->save();
      }
   }

   public function update(array $data, $id)
   {
      return Order::whereId($id)->update($data);
   }

   public function delete($id)
   {
      Order::destroy($id);
   }
}
