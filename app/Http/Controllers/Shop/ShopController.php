<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Http\Services\ShopServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    public function getMyCart(Request $request)
    {
        $myCart = (new ShopServices)->getMyCart($request);
        return $this->renderResponse($myCart, 200);
    }

    public function addProductToCart(Request $request) 
    {
      $response = [];
      try {
        DB::beginTransaction();
        $productId = $request->productId;
        (new ShopServices)->addProductToCart($request, $productId); 
        $response['message'] = "Product added to cart successfully";
        DB::commit();
        return $this->renderResponse($response, 200);
      } catch (\Throwable $th) {
        DB::rollBack();
        $response['message'] = "an error occured...please try again";
        return $this->renderResponse($response, 500);
      }
    }

    public function renderResponse($object, $status)
    {
      $contentType = "application/json";
      return response($object, $status)->header('Content-Type', $contentType);
    }
}
