<?php
/**
 * Created by PhpStorm.
 * User: MSI
 * Date: 6/21/2018
 * Time: 5:29 PM
 */
namespace App\Core\Entities;
class Entity{
    public function __construct($object)
    {
        $props=  get_object_vars ($this);
        if(isset($props) && !empty($props)){
            foreach ($props as $prop=>$value){
                if(isset($object->{$prop})){
                    $this->{$prop} = $object->{$prop};
                }else{
                    $this->{$prop} = 'Not exists properties';
                }

            }
        }

    }
}
