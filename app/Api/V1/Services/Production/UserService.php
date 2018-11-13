<?php

namespace App\Api\V1\Services\Production;

use App\Api\V1\Services\Interfaces\UserServiceInterface;
use App\Core\Common\RoleConst;
use App\Core\Common\SDBStatusCode;
use App\Core\Dao\SDB;
use App\Core\Entities\DataResultCollection;
use Illuminate\Support\Facades\Hash;

class UserService implements UserServiceInterface
{
    public function registerNormal(array $inputs)
    {
        $result =  new DataResultCollection();
        try{
            SDB::beginTransaction();
            $inputs['password'] = Hash::make($inputs['password']);
            $inputs['is_active'] = false;
            $dataUser = array(
                'email'=>$inputs['email'],
                'password'=>$inputs['password'],
                'name'=>$inputs['name'],
                'role_value'=>RoleConst::NormalUser,
                'created_at'=>now()
            );
            $newUserId = SDB::table('users')->insertGetId($dataUser);
            $dataUserDetail = array(
                'user_id'=>$newUserId,
                'gender'=>$inputs['gender'],
                'birth_date'=>$inputs['birth_date']
            );
            SDB::table('users_detail')->insert($dataUserDetail);
            SDB::commit();
            $result->status= SDBStatusCode::OK;
        }catch (\Exception $exception){
            SDB::rollBack();
            $result->status =  SDBStatusCode::Excep;
            $result->message= $exception->getMessage();
        }
        return $result;
    }

}
