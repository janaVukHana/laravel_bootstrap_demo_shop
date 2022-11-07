<?php

namespace App\Models;


class Cart {
    public $items = null;
    public $totalPrice = 0;
    
    public function __construct($oldCart) {
        if($oldCart) {
            $this->items = $oldCart->items;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }

    // Add product to shopping cart
    public function add($product) {
        $this->items[$product->id] = ['item' => $product, 'quantity' => '1'];
        $this->totalPrice += $product->price;
    }

    // Update product quantity
    public function update($requests) {
        $this->totalPrice = 0;

        foreach($requests as $key => $request) {
            if(str_starts_with($key, 'id')) {
                $input = explode('-', $key);
                $id = $input[1];
                
                // Update product quantity
                $this->items[$id]['quantity'] = $request;
                // Calculate total price
                $this->totalPrice += $this->items[$id]['item']->price * $this->items[$id]['quantity'];
            }  
        }
    }
}

