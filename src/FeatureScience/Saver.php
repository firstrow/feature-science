<?php

namespace FeatureScience;

use FeatureScience\StorageInterface;

class Saver
{

    protected $results;
    protected $storage;
    protected $experimentName;

    public function __construct($results, $payloadSaver, StorageInterface $storage)
    {
        $this->results        = $results;
        $this->storage        = $storage;
        $this->payloadSaver   = $payloadSaver;
    }

    public function save()
    {
        $data = $this->buildData();

        $this->storage->save($this->experimentName(), $data);

        if($this->reachedSaveLimit()) {
            $this->payloadSaver->save($this->experimentName(), $data);
        }
    }

    protected function buildData()
    {
        return array_merge($this->loadStorageData(), $this->results->payload());
    }

    protected function reachedSaveLimit()
    {
        $limit = $this->storage->increaseSaves($this->experimentName());
        return $limit >= $this->results->getExperiment()->getPayloadLimit();
    }

    protected function loadStorageData()
    {
        $data = $this->storage->load($this->experimentName());

        if (!$data) {
            $data = [];
        }

        return $data;
    }

    protected function experimentName()
    {
        return $this->results->getExperiment()->getName();
    }

}
