<?php
  namespace App\Http\Services;
  use Illuminate\Support\Facades\Http;
  use Illuminate\Http\Request;

  Class ShopServices {

    public function getMyCart(Request $request)
    {
      $myCart = $request->session()->get('myCartProducts');
      if (!$myCart) {
        $request->session()->put('myCartProducts', []); 
      }
      return $myCart;
    }

    public function addProductToCart($request, $product) 
    {
      return $request->session()->push('myCartProducts', $product);            
    }
  }
?>