<?php
/**
 * Created by PhpStorm.
 * User: MSI
 * Date: 6/14/2018
 * Time: 10:23 AM
 */
namespace App\Core\Services\Interfaces;

use App\Core\Entities\DataResultCollection;

interface UploadServiceInterface
{
    public function uploadFile($fileList,$diskName,$subFolder,$option):DataResultCollection;
    public function deleteFile($diskName,$filePath):DataResultCollection;
}
