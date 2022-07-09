<?php
 namespace App\Service;

 use Cloudinary\Api\Upload\UploadApi;
 use Cloudinary\Configuration\Configuration;

 class ImageUploader
 {
  public function upload($file, $options = [])
     {
       Configuration::instance([ 
                    "cloud_name" => $_ENV['CLOUDINARY_NAME'], 
                    "api_key" => $_ENV['CLOUDINARY_API_KEY'], 
                    "api_secret" => $_ENV['CLOUDINARY_API_SECRET'], 
                    "secure" => FALSE]);
        (new UploadApi())->upload(  $file,$options);
     }
 }