<?php
namespace jra\models;

class ImageFactory {

    const PHOTODATA_IMAGE_DIR = '../utilities/photodata/images';

    public function __construct()
    {
        $this->images = $this->populateImages();
    }

    public function getImages() {
        return $this->images;
    }

    private function populateImages()
    {
        foreach(scandir(static::PHOTODATA_IMAGE_DIR) as $file) {
            $this->images[] = new Image($file);
        }
    }

}
