<?php
 namespace App\Service;

use Cloudinary\Configuration\Configuration;

 class CloudinaryContainer 
 {
    public function __construct()
    {
      Configuration::instance([ 
        "cloud_name" => $_ENV['CLOUDINARY_NAME'], 
        "api_key" => $_ENV['CLOUDINARY_API_KEY'], 
        "api_secret" => $_ENV['CLOUDINARY_API_SECRET'], 
        "secure" => FALSE]);
    }
 }
 