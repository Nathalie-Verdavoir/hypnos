<?php

namespace App\Service;

use Gedmo\Sluggable\Util\Urlizer;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ManageImage
{
    private $projectDir;

    public function __construct(string $projectDir)
    {
        $this->projectDir = $projectDir;
    }

    public function upload(UploadedFile $uploadedFile): string
    {
        //create temp file
        $destination = $this->projectDir . '/public/uploads/photos';
        $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
        $newFilename = Urlizer::urlize($originalFilename) . '-' . uniqid();
        $newFileExt = '.' . $uploadedFile->guessExtension();
        $uploadedFile->move(
            $destination,
            $newFilename . $newFileExt,
            0777
        );
        $path = $destination . '/' . $newFilename . $newFileExt;

        //copy temp file on cloudinary
        (new ImageUploader())->upload($path, ["public_id" => $newFilename]);

        //remove temp file
        $filesystem = new Filesystem();
        $filesystem->remove($path);
        return $newFilename . $newFileExt;
    }
}
