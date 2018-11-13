<?php
namespace App\Core\Helpers;
/**
 * Created by PhpStorm.
 * User: my computer
 * Date: 6/30/2018
 * Time: 2:05 AM
 */
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
class CommonHelper
{
    public static function CommonLog($message){
        //Logging
        if(env('APP_DEBUG')==true){
           die($message);
            abort($message);
        }else{
            Log::error($message);
        }
    }

    /**
     * @return ModuleInfor
     */
    public static function getCurrentModuleInfor():ModuleInfor{
        $result = new ModuleInfor();
        try{
            $currentRoute =  Route::getCurrentRoute();
            if($currentRoute !=null){
                $curentActionInfo = $currentRoute->getAction();
                $module = strtolower(trim(str_replace('App\\', '', $curentActionInfo['namespace']), '\\'));
                $module =  explode("\\",$module)[0];
                $_action =isset($curentActionInfo['controller'])? explode('@', $curentActionInfo['controller']):array();
                $_namespaces_chunks =isset($_action[0])? explode('\\', $_action[0]):array();
                $controllers = strtolower(end($_namespaces_chunks));
                $action = strtolower(end($_action));
                $screenCode = $curentActionInfo['namespace']."\\".$controllers."\\".$action;

                $result->module = $module;
                $result->controller = $controllers;
                $result->action = $action;
                $result->screenCode = $screenCode;
            }

        }catch (\Exception $ex){
            //Dont handler here...
        }
        return $result;
    }
    public static function getExcelTemplatePath(){
        return base_path().'/resources/export_templates/';
    }
    public static function isJSON($string){
        return is_string($string) && is_array(json_decode($string, true)) ? true : false;
    }
    /**
     * @param $data
     * @return array
     * ex:
     * inp:
     * [
     *      key1=>[
     *          key2=>a,
     *          key3=>b,
     *     ],
     *     key4=> c
     * ]
     *  out:
     * [
     *      key1.key2=>a,
     *      key1.key3=>b,
     *      key4=>c
     * ]
     */
    public static function flatten($array, $prefix = '') {
        $delimiter= ".";
        $result = array();
        foreach($array as $key=>$value) {
            if(is_array($value)) {
                $result = $result + self::flatten($value, $prefix . $key . $delimiter);
            }else {
                $result[$prefix.$key] =  $value;
            }
        }
        return $result;
    }
    public static function array_non_empty_items($input) {
        // If it is an element, then just return it
        if (!is_array($input)) {
            return $input;
        }
        $non_empty_items = array();

        foreach ($input as $key => $value) {
            // Ignore empty cells
            if((is_array($value)  && !empty($value))||(!is_array($value) && $value)) {
                // Use recursion to evaluate cells
                $non_empty_items[$key] = self::array_non_empty_items($value);
                if(empty($non_empty_items[$key])){
                    unset($non_empty_items[$key]);
                }
            }
        }

        // Finally return the array without empty items
        return $non_empty_items;
    }
}
