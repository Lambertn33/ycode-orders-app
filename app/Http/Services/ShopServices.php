<?php
  namespace App\Http\Services;
  use Illuminate\Support\Facades\Http;
  use App\Models\Cart;
  use Illuminate\Http\Request;
  use Illuminate\Support\Str;

  Class ShopServices {

    public function getMyCart()
    {
      // Simple Cart using DB 
      $myCart = Cart::select(['id', 'product_id'])->get();
      return $myCart;
    }

    public function addProductToCart($request, $productId) 
    {
      $newProduct = [
        'id' => Str::uuid()->toString(),
        'product_id' => $productId,
        'created_at' => now(),
        'updated_at' => now()
      ];
      return Cart::insert($newProduct);              
    }
  }
?>