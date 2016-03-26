<?php
namespace jra\models;

class FileManager
{
    const SERVER_LIMIT = 2000000;

    public function uploadFile($filename)
    {
        if($this->fileExceedsServerLimit($filename)) {
            return;
        }
        move_uploaded_file($_FILES['file']['tmp_name'], $filename);
    }

    public function deleteFile($filename)
    {
        unlink($filename);
    }

    public function createDirectory($directory)
    {
        if(!file_exists($directory)) {
            mkdir($directory);
        }
    }

    private function fileExceedsServerLimit() {
        if ($_FILES['file']['size'] > static::SERVER_LIMIT) {
            return;
        }
    }
}
