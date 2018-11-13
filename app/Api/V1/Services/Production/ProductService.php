<?php

namespace App\Api\V1\Services\Production;

use App\Api\V1\Http\Requests\ProductAdvanceSearchRequest;
use App\Api\V1\Services\Interfaces\ProductServiceInterface;
use App\Core\Common\Pagging;
use App\Core\Common\SDBStatusCode;
use App\Core\Dao\SDB;
use App\Core\Entities\DataResultCollection;
use App\Core\Entities\DataSearchEntity;

class ProductService implements ProductServiceInterface
{
    public function advanceSearch(ProductAdvanceSearchRequest $request)
    {
        $result =  new DataResultCollection();
        $name = $request->get('name',null);
        $steelType =  $request->get('steel_type',null);
        $productType =  $request->get('product_type',null);
        $pageIndex =  (int)$request->get('page',1);
        $perPage = (int)$request->get('per_page',Pagging::PER_PAGE);
        $jis =  $request->get('jis',null);
        $aws =  $request->get('aws',null);
        $query = SDB::table('products As P')
            ->leftJoin('product_types AS PT', function($join)
            {
                $join->on('P.product_type_id', '=', 'PT.id');
            })
            ->leftJoin('product_steel_types AS PST', function($join)
            {
                $join->on('P.steel_type_id', '=', 'PST.id');
            })
            ->leftJoin('product_standard_aws AS PSA', function($join)
            {
                $join->on('P.aws_id', '=', 'PSA.id');
            })
            ->leftJoin('product_standard_jis AS PSJ', function($join)
            {
                $join->on('P.jis_id', '=', 'PSJ.id');
            })
        ->selectRaw(
            "P.*
                ,PST.name as steel_type_name
                ,PT.name AS product_type_name
                ,PSA.name AS product_standard_aws
                ,PSJ.name AS product_standard_jis
            ");
        //Search condition
        if($name !=null){
            $query->where('P.product_name', 'LIKE', "%$name%");
        }
        if($steelType!=null){
            $query->whereRaw("P.steel_type_id = ?",[$steelType]);
        }
        if($productType!=null){
            $query->whereRaw("P.product_type_id = ?",[$productType]);
        }
        if($jis!=null){
            $query->whereRaw("P.jis_id = ?",[$jis]);
        }
        if($aws!=null) {
            $query->whereRaw("P.aws_id = ?", [$aws]);
        }
        if($perPage == 0){
            $perPage = Pagging::PER_PAGE;
        }
        $result->data =  $query->paginate($perPage,['*'],'page',$pageIndex);
        $result->status =  SDBStatusCode::OK;
        return $result;
    }
    public function getSteelTypeList(){
        $result=  new DataResultCollection();
        try{
            $result->data =  SDB::table('product_steel_types')->selectRaw('id as value, name as label')->get();
            $result->status =  SDBStatusCode::OK;
        }catch (\Exception $e){
            $result->status =  SDBStatusCode::Excep;
            $result->message = $e->getMessage();
        }
        return $result;
    }
    public function getProductTypeList(){
        $result=  new DataResultCollection();
        try{
            $result->data =  SDB::table('product_types')->selectRaw('id as value, name as label')->get();
            $result->status =  SDBStatusCode::OK;
        }catch (\Exception $e){
            $result->status =  SDBStatusCode::Excep;
            $result->message = $e->getMessage();
        }
        return $result;
    }
}
