<?php

namespace FeatureScience;

class ApcStorage implements StorageInterface
{

    public function save($key, $value)
    {
        return apc_store($key, $value);
    }

    public function load($key)
    {
        return apc_fetch($key);
    }

    public function increaseSaves($key)
    {
        $key .= 'inc';

        if (!$this->load($key)) {
            $this->save($key, 0);
        }

        return apc_inc($key, 1);
    }

}
