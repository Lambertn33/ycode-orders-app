<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Http\Services\CollectionsServices;
use App\Http\Services\ShopServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    public function getMyCart($userId)
    {
        $myCart = (new ShopServices)->getMyCart($userId);
        return $this->renderResponse($myCart, 200);
    }

    public function addProductToCart(Request $request, $userId) 
    {
      $response = [];
      try {
        DB::beginTransaction();
        $productId = $request->productId;
        (new ShopServices)->addProductToCart($userId, $productId); 
        $response['message'] = "Product added to cart successfully";
        DB::commit();
        return $this->renderResponse($response, 200);
      } catch (\Throwable $th) {
        DB::rollBack();
        $response['message'] = "an error occured...please try again";
        return $this->renderResponse($response, 500);
      }
    }

    public function removeProductFromCart($userId, $productId)
    {
      $response = [];
      try {
        DB::beginTransaction();
        (new ShopServices)->removeProductFromCart($userId, $productId);
        $response['message'] = "Product removed from cart successfully";
        DB::commit();
        return $this->renderResponse($response, 200);
      } catch (\Throwable $th) {
        DB::rollBack();
        $response['message'] = "an error occured...please try again";
        return $this->renderResponse($response, 500);
      }
    }

    public function submitOrder(Request $request)
    {
      try {
        $currentUserInSession = $request->route('userId');
        $userInfo = $request->userInfo;
        $cartObject = $request->cartObject;
        $lastSavedOrder = (new CollectionsServices)->getLastSavedOrder();
        // if no current orders , initial ID is 1
        $lastSavedOrderId = $lastSavedOrder ? $lastSavedOrder[0]['ID'] : 1; 
        $newOrderId = $lastSavedOrderId + 1;
        $orderName = 'Order Items #'.$newOrderId;
        $orderSlug = 'orders-item-'.$newOrderId;
        // format order object
        $newOrder = [
          'Name' => $orderName,
          'Customer name' => $userInfo['Customer name'] ? $userInfo['Customer name']: '',
          'Slug' => $orderSlug,
          'Email' => $userInfo['Email'] ? $userInfo['Email']: '',
          'Phone' => $userInfo['Phone'] ? $userInfo['Phone'] : '',
          'Address line 1' => $userInfo['Address line 1'] ? $userInfo['Address line 1']: '',
          'Address line 2' => $userInfo['Address line 2'] ? $userInfo['Address line 2']: '',
          'City' => $userInfo['City'] ? $userInfo['City'] : '',
          'Country' => $userInfo['Country'] ? $userInfo['Country'] : '',
          'State' => $userInfo['State'] ? $userInfo['State'] : '',
          'ZIP' => $userInfo['ZIP'] ? $userInfo['ZIP'] : '',
          'Subtotal' => $cartObject['grandSubTotal'],
          'Total' => $cartObject['grandTotal'],
          'Shipping' => $cartObject['shippingFee']
        ];
        (new CollectionsServices)->saveNewOrder($newOrder);
        // after the order is saved, remove user cart
        (new ShopServices)->emptyUserCart($currentUserInSession);
        $response['message'] = 'Order Placed successfully';
        return $this->renderResponse($response, 200);
      } catch (\Throwable $th) {
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
