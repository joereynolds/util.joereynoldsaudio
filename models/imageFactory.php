<?php
namespace jra\models;
include 'image.php';

class ImageFactory
{
    const PHOTODATA_IMAGE_DIR = 'utilities/photodata/images/';

    public function __construct()
    {
        $this->images = $this->populateImages();
    }

    public function getImages()
    {
        return $this->images;
    }

    public function populateImages()
    {
        if (empty($this->images)) {
            foreach(scandir(static::PHOTODATA_IMAGE_DIR) as $file) {
                $this->images[] = new Image(static::PHOTODATA_IMAGE_DIR . $file);
            }
        }

        //Remove unix '.' and '..'
        unset($this->images[0]);
        unset($this->images[1]);
    }
}
