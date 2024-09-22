<?php

namespace App\Repositories;
use App\Models\Order;
use App\Interfaces\OrderRepositoryInterface;

class OrderRepository implements OrderRepositoryInterface
{
    public function index(){
        return Order::with('order_detail.product')
         ->get();
    }

    public function getById($id){
       return Order::find($id);
    }

    public function store(array $data){
       return Order::create($data);
    }

    public function update(array $data,$id){
       return Order::whereId($id)->update($data);
    }
    
    public function delete($id){
       Order::destroy($id);
    }
}