<?php
namespace jra\model;

class Image {

    public function __construct($filename)
    {
        $this->filename = $filename;
        $this->exifData = $this->getExifData();
    }

    public function getExifData()
    {
        return exif_read_data($this->filename, 0, true);
    }
}
