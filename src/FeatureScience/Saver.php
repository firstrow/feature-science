<?php

namespace FeatureScience;

use FeatureScience\StorageInterface;

class Saver
{

    protected $results;
    protected $storage;

    public function __construct($results, StorageInterface $storage)
    {
        $this->results = $results;
        $this->storage = $storage;
    }

    public function save()
    {
        $this->storage->save($this->results->getExperiment()->getName(), $this->buildData());
    }

    protected function buildData()
    {
        return array_merge($this->loadStorageData(), $this->results->payload());
    }

    protected function loadStorageData()
    {
        $data = $this->storage->load($this->results->getExperiment()->getName());

        if (!$data) {
            $data = [];
        }

        return $data;
    }
}
