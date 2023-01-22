<?php

namespace App\Service;

use Cloudinary\Api\ApiResponse;
use Cloudinary\Api\Upload\UploadApi;

class ImageUploader
{
    public function __construct()
    {
        new CloudinaryContainer;
    }
    public function upload($file, $options = []): ApiResponse
    {
        $response = (new UploadApi())->upload($file, $options);
        return $response;
    }

    public function remove($file, $options = []): ApiResponse
    {
        $response = (new UploadApi())->destroy($file, $options);
        return $response;
    }
}
