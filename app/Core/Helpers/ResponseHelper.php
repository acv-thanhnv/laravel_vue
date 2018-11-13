<?php
namespace App\Core\Helpers;
/**
 * Created by PhpStorm.
 * User: my computer
 * Date: 6/30/2018
 * Time: 2:05 AM
 */
use App\Core\Entities\DataResultCollection;
use Illuminate\Support\Facades\Log;
class ResponseHelper
{
    public static function JsonDataResult(DataResultCollection $data){
        return response()->json($data);
    }

}
