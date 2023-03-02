<?php

namespace App\Http\Controllers\Collections;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\CollectionsServices;

class CollectionsController extends Controller
{
  public function getAllCollections()
  {
    $collections = (new CollectionsServices)->getCollections();
    return $this->renderResponse($collections);
  }

  public function getCollection($collectionName)
  {
    $products = (new CollectionsServices)->getCollection($collectionName);
    return $this->renderResponse($products);
  }

  public function renderResponse($object)
  {
    $contentType = "application/json";
    return response($object, 200)->header('Content-Type', $contentType);
  }
}
