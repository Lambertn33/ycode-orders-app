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
      return $collectionsResponse;
    }

    // get Collection By Name because all collections should not be visible for the customer
    public function getCollection($collectionName)
    {
      $productionCollection = new stdClass();
      $allCollections = $this->getCollections();
      foreach ($allCollections['data'] as $collection ) {
        if ($collection['name'] == $collectionName) {
          $productionCollection = $collection;
        }
      }
      return $productionCollection;
    }
  }
?>