<?php
/**
 * Created by PhpStorm.
 * User: MSI
 * Date: 10/23/2018
 * Time: 10:52 AM
 */

namespace App\Core\Helpers;

use App\Core\Dao\SDB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use PHPUnit\Framework\Constraint\FileExists;

class DataHelper
{
    public static function importNewProductData($filePath,$selectorArea){
        if(file_exists($filePath)){
            Log::debug($filePath);
            Excel::load($filePath, function($reader)use($selectorArea) {
                $dataArray = $reader->getActiveSheet()
                    ->rangeToArray(
                        $selectorArea,     // The worksheet range that we want to retrieve
                        null,        // Value that should be returned for empty cells
                        TRUE,        // Should formulas be calculated (the equivalent of getCalculatedValue() for each cell)
                        TRUE,        // Should values be formatted (the equivalent of getFormattedValue() for each cell)
                        TRUE         // Should the array be indexed by cell row and cell column
                    );
                self::importMasterProduct($dataArray);

            })->get();

        }
    }
    public static function mergerProductData($filePath,$selectorArea){
        if(file_exists($filePath)){
            Log::debug($filePath);
            Excel::load($filePath, function($reader)use($selectorArea) {
                $dataArray = $reader->getActiveSheet()
                    ->rangeToArray(
                        $selectorArea,     // The worksheet range that we want to retrieve
                        null,        // Value that should be returned for empty cells
                        TRUE,        // Should formulas be calculated (the equivalent of getCalculatedValue() for each cell)
                        TRUE,        // Should values be formatted (the equivalent of getFormattedValue() for each cell)
                        TRUE         // Should the array be indexed by cell row and cell column
                    );
                $dataJson = json_encode($dataArray,JSON_FORCE_OBJECT|JSON_UNESCAPED_UNICODE );
                SDB::beginTransaction();
                try{
                    self::importMasterProduct($dataArray);
                    SDB::table('products')->truncate();
                    SDB::execSPs('BUSSINESS_PRODUCT_NEW_IMPORT',array($dataJson));
                    SDB::commit();
                }catch (\Exception $e){
                    SDB::rollBack();
                }

            })->get();

        }
    }

    /**
     * @param $dataArray
     */
    protected static function importMasterProduct($dataArray){
        $steelList =  array();
        $productType =  array();
        $aws =  array();
        $jis = array();
        foreach ($dataArray as $record){
            $steelList[] = $record['B'];
            $productType[]= $record['C'];
            $jis[] = $record['D'];
            $aws[] = $record['E'];
        }
        $steelList =  array_unique ($steelList);
        $steelList =  array_diff($steelList,['-','－']);
        $productType =  array_unique ($productType);
        $productType =  array_diff($productType,['-','－']);
        $aws =  array_unique ($aws);
        $aws =  array_diff($aws,['-','－']);
        $jis =  array_unique ($jis);
        $jis =  array_diff($jis,['-','－']);
        $steelData = array();
        $idSteel = 0;
        foreach ($steelList as $steel){
            $idSteel++;
            $steelData[] = array(
                "name"=>$steel,
                "created_at"=>now()
            );
        }
        $productTypeData = array();
        foreach ($productType as $productTypeItem){
            $productTypeData[] = array(
                "name"=>$productTypeItem,
                "created_at"=>now()
            );
        }
        $awsData = array();
        foreach ($aws as $awsItem){
            $awsData[] = array(
                "name"=>$awsItem,
                "created_at"=>now()
            );
        }
        $jisData = array();
        foreach ($jis as $jisItem){
            $jisData[] = array(
                "name"=>$jisItem,
                "created_at"=>now()
            );
        }
        SDB::table('product_steel_types')->truncate();
        SDB::table('product_types')->truncate();
        SDB::table('product_standard_aws')->truncate();
        SDB::table('product_standard_jis')->truncate();

        SDB::table('product_steel_types')->insert($steelData);
        SDB::table('product_types')->insert($productTypeData);
        SDB::table('product_standard_aws')->insert($awsData);
        SDB::table('product_standard_jis')->insert($jisData);

    }

}
