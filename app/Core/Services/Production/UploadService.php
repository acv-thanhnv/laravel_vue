<?php
/**
 * Created by PhpStorm.
 * User: MSI
 * Date: 6/14/2018
 * Time: 10:28 AM
 */

namespace App\Core\Services\Production;

use App\Core\Services\Interfaces\UploadServiceInterface;
use App\Core\Entities\DataResultCollection;
use Illuminate\Support\Facades\Storage;
use App\Core\Common\SDBStatusCode;
use Intervention\Image\ImageManagerStatic as Image;

class UploadService extends BaseService implements UploadServiceInterface
{
    /**
     * @param $fileList
     * @param $diskName   //Disk name in config/filesystem
     * @param $subFolder  //Subfolder
     * @param $option //option for cloud upload
     * @return DataResultCollection
     */
    public function uploadFile($fileList,$diskName,$subFolder,$option):DataResultCollection{
        $result = new DataResultCollection();
        $result->status = SDBStatusCode::OK;
        $result->data = array();
        //NOTE : This will store file to path with: root path has config in config/filesystems.php, sub folder is $subFolder
        if (is_array($fileList) && !empty($fileList)) {
            foreach ($fileList as $item) {
                $path = Storage::disk($diskName)->put($subFolder, $item, $option);
                $fileInfor = array(
                    'client_file_name' => $item->getClientOriginalName(),
                    'uri' => $path,
                    'url' => Storage::disk($diskName)->url($path)
                );
                $result->data[] = $fileInfor;
            }
        }
        return $result;
    }
    public function deleteFile($diskName,$filePath):DataResultCollection{
        $result = new DataResultCollection();
        $result->status = SDBStatusCode::OK;
        $result->data = array();
        Storage::disk($diskName)->delete($filePath);
        return $result;
    }
}

