<?php
  namespace App\Http\Services;
  use Illuminate\Support\Facades\Http;
  use Illuminate\Http\Request;

  Class ShopServices {

    public function getMyCart(Request $request)
    {
      $myCartProducts = [];
      if ($request->session()->has('myCartProducts')) {
        $myCartProducts = $request->session()->get('myCartProducts');
      } else {
        $initialCart = [];
        $request->session()->put('myCartProducts', $initialCart);
        $myCartProducts = $initialCart;
      }
      return $myCartProducts;
    }

    public function addProductToCart($request, $product) 
    {
      return $request->session()->push('myCartProducts', $product);            
    }
  }
?>