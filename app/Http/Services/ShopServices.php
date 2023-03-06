<?php
  namespace App\Http\Services;
  use Illuminate\Support\Facades\Http;
  use App\Models\Cart;
  use Illuminate\Http\Request;
  use Illuminate\Support\Str;

  Class ShopServices {

    public function getMyCart($userId)
    {
      // Simple Cart using DB 
      $myCart = Cart::where('user_id', $userId)->select(['id', 'product_id'])->get();
      return $myCart;
    }

    public function addProductToCart($userId, $productId) 
    {
      $newProduct = [
        'id' => Str::uuid()->toString(),
        'product_id' => $productId,
        'user_id' => $userId,
        'created_at' => now(),
        'updated_at' => now()
      ];
      return Cart::insert($newProduct);              
    }
    public function removeProductFromCart($userId, $productId) 
    {
       return Cart::where('user_id', $userId)->where('product_id', $productId)->delete();
    }

    public function emptyUserCart($userId)
    {
      return Cart::where('user_id', $userId)->delete();
    }
  }

?>