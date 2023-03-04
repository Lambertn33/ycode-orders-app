<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Http\Services\ShopServices;
use Illuminate\Http\Request;
use stdClass;

class ShopController extends Controller
{
    public function getMyCart(Request $request)
    {
        $myCart = (new ShopServices)->getMyCart($request);
        return $this->renderResponse($myCart);
    }

    public function addProductToCart(Request $request) 
    {
      $product = $request->product;
      (new ShopServices)->addProductToCart($request, $product); 
      $response = [];
      $response['message'] = "Product added to cart successfully";
      return $this->renderResponse($response);

    }

    public function renderResponse($object)
    {
      $contentType = "application/json";
      return response($object, 200)->header('Content-Type', $contentType);
    }
}
