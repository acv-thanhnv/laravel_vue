<?php

namespace App\Api\V1\Services\Interfaces;

use App\Api\V1\Http\Requests\ProductAdvanceSearchRequest;
use Illuminate\Http\Request;

interface ProductServiceInterface
{
    public function advanceSearch(ProductAdvanceSearchRequest $request);
    public function getSteelTypeList();
    public function getProductTypeList();
}
