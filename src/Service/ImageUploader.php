<?php
 namespace App\Service;

use Cloudinary\Api\ApiResponse;
use Cloudinary\Api\Upload\UploadApi;
use Cloudinary\Configuration\Configuration;

 class ImageUploader
 {

    public function __construct()
    {
      Configuration::instance([ 
        "cloud_name" => $_ENV['CLOUDINARY_NAME'], 
        "api_key" => $_ENV['CLOUDINARY_API_KEY'], 
        "api_secret" => $_ENV['CLOUDINARY_API_SECRET'], 
        "secure" => FALSE]);
    }

    public function upload($file, $options = []): ApiResponse
     {
         $response=(new UploadApi())->upload(  $file, $options);
         return $response;
     }

    public function remove($file, $options = []): ApiResponse
     {
         $response=(new UploadApi())->destroy(  $file, $options);
         return $response;
     }
 }
 