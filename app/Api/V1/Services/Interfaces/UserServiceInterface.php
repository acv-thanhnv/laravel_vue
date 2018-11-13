<?php

namespace App\Api\V1\Services\Interfaces;

use Illuminate\Http\Request;

interface UserServiceInterface
{
    public function registerNormal(array $inputs);
}
