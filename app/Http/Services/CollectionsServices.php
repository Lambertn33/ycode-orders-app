<?php
  namespace App\Http\Services;
  use Illuminate\Support\Facades\Http;
  use stdClass;

  Class CollectionsServices {

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

    public function getCollections()
    {
      $collectionsResponse = Http::withHeaders($this->headers)->get(''.$this->endpointUrl);
      return $collectionsResponse['data'];
    }

    // get Collection By Name because all collections have different functionalities
    // eg: Customers cannot create products but they can view them/ or they can create orders but cannot view them
     
    public function getCollection($collectionName)
    {
      $collection = new stdClass();
      $allCollections = $this->getCollections();
      foreach ($allCollections as $col) {
        if ($col['name'] == $collectionName) {
          $collection = $col;
        }
      }
      $collectionId = $collection['_ycode_id'];
      $collectionResponse = Http::withHeaders($this->headers)->get(''.$this->endpointUrl.'/'.$collectionId);
      return $collectionResponse['data'];
    }

    public function getCollectionId($collectionName)
    {
      $objectCollection = $this->getCollection($collectionName);
      return $objectCollection['_ycode_id'];      
    }

    public function getCollectionItems($url)
    {
      $allCollections = Http::withHeaders($this->headers)->get($url);
      return $allCollections['data'];
    }

    public function getProductsCollectionItems()
    {
      $productsCollectionName = "Products";
      $collectionId = $this->getCollectionId($productsCollectionName);
      $url = $this->endpointUrl.'/'.$collectionId. '/items';
      return $this->getCollectionItems($url);
    }
  }
?>