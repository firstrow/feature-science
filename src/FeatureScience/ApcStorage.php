<?php

namespace FeatureScience;

class ApcStorage implements StorageInterface
{

    public function save($key, $value)
    {
        apc_store($key, $value);
    }

    public function load($key)
    {
        return apc_fetch($key);
    }

}
