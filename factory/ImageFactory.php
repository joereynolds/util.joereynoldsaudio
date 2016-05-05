<?php
namespace jra\factory;

class ImageFactory
{
    const PHOTODATA_IMAGE_DIR = 'assets/images/photodata/';

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
                $this->images[] = new \jra\model\image(static::PHOTODATA_IMAGE_DIR . $file);
            }
        }

        //Remove unix '.' and '..'
        unset($this->images[0]);
        unset($this->images[1]);
    }
}
