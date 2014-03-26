<?php

namespace FeatureScience;

class PayloadSaver
{

    protected $path;
    protected $fileExt = '.json';

    public function __construct($path = null)
    {
        if (!$path) {
            $this->path = sys_get_temp_dir();
        } else {
            $this->path = $path;
        }

        $this->path = rtrim($this->path, DIRECTORY_SEPARATOR);
    }

    public function save($key, $value)
    {
        file_put_contents($this->getFullFilePath($key), json_encode($value));
    }

    public function getFullFilePath($file)
    {
        return $this->path . DIRECTORY_SEPARATOR . $file . $this->fileExt;
    }

}
