<?php

namespace App\Api\V1\Http\Controllers;
use App\Api\V1\Http\Requests\ProductAdvanceSearchRequest;
use App\Api\V1\Services\Interfaces\ProductServiceInterface;
use App\Core\Helpers\ResponseHelper;
class ProductController extends Controller
{
    protected $service;
    public function __construct(ProductServiceInterface $productService)
    {
        $this->service = $productService;
    }
    public function index(){
        //view

    }
    public function advanceSearch(ProductAdvanceSearchRequest $request){
        $result = $this->service->advanceSearch($request);
        return ResponseHelper::JsonDataResult($result);
    }
    public function steelTypeList(){
        $result = $this->service->getSteelTypeList();
        return ResponseHelper::JsonDataResult($result);
    }
    public function productTypeList(){
        $result = $this->service->getProductTypeList();
        return ResponseHelper::JsonDataResult($result);
    }
}
