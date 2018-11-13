<?php

namespace App\Api\V1\Http\Controllers;
use App\Core\Common\SDBStatusCode;
use App\Core\Dao\SDB;
use App\Core\Entities\DataResultCollection;
use App\Core\Helpers\ResponseHelper;
class CateloryController extends Controller
{
    public function index(){

        $listCategory = SDB::select("SELECT * FROM users");
        $result = new DataResultCollection();
        $result->status = SDBStatusCode::OK;
        $result->data = $listCategory;
        return ResponseHelper::JsonDataResult($result);
    }
}
