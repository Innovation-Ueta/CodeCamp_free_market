<?php
 
namespace App\Services;
 
class FileUploadService {
    
    // 画像アップロード画像のパスを返す
    public function saveImage($avatar){
      $path = '';
      if( isset($avatar) === true ){
          $path = $avatar->store('photos', 'public');
      }
      return $path;
    }
}