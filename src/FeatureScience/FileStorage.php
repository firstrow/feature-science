<?php

namespace FeatureScience;

class FileStorage implements StorageInterface
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

    public function load($key)
    {
        $path = $this->getFullFilePath($key);

        if (file_exists($path)) {
            return (array) json_decode(file_get_contents($path));
        }
    }

    public function delete($name)
    {
        if (file_exists($this->getFullFilePath($name))) {
            unlink($this->getFullFilePath($name));
        }
    }

    public function increaseSaves($name)
    {
        $name .= '_count';

        $c = $this->load($name);

        if(!$c)
            $c = ['count' => 0];

        $c['count']++;

        $this->save($name, $c);

        return $c['count'];
    }

    public function getFullFilePath($file)
    {
        return $this->path . DIRECTORY_SEPARATOR . $file . $this->fileExt;
    }

}
