<?php
  namespace App\Http\Services;
  use Illuminate\Support\Facades\Http;
  use App\Models\Cart;
  use Illuminate\Http\Request;
  use Illuminate\Support\Str;

  Class ShopServices {
    private $endpointUrl;
    private $endpointToken;
    private $headers;
  
    public function __construct()
    {
      $this->endpointUrl = env('YCODE_API_URL'). "/collections";
      $this->endpointToken  = env('YCODE_API_TOKEN');
      $this->headers  = [
        "accept" => "application/json",
        "authorization" => "Bearer ".$this->endpointToken
      ];
    }

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


       // since the ID is autoincrement ,retreive the last saved order to get its ID and use it as in creating slugs
       public function getLastSavedOrder()
       {
         $ordersCollectionName = "Orders";
         $collectionId = (new CollectionsServices)->getCollectionId($ordersCollectionName);
         //include query params in url to get last saved order
         $url = $this->endpointUrl.'/'.$collectionId. '/items?sort_by=ID&order_by=desc&limit=1';
         return (new CollectionsServices)->getCollectionItems($url);
       }
   
       public function saveNewOrder($newOrder)
       {
         $ordersCollectionName = "Orders";
         $collectionId = (new CollectionsServices)->getCollectionId($ordersCollectionName);
         $url = $this->endpointUrl.'/'.$collectionId. '/items';
         return Http::withHeaders($this->headers)->post($url, $newOrder);
       }
   
       public function saveNewOrderItem($newOrderItem)
       {
         $orderItemsCollectionName = "Order items";
         $collectionId = (new CollectionsServices)->getCollectionId($orderItemsCollectionName);
         $url = $this->endpointUrl.'/'.$collectionId. '/items';
         Http::withHeaders($this->headers)->post($url, $newOrderItem);
       }
  }

?>