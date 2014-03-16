<?php

namespace FeatureScience;

use FeatureScience\StorageInterface;

class Saver
{
    public function __construct($experiment, StorageInterface $storage)
    {
		$this->experiment = $experiment;
		$this->storage    = $storage;
    }
}
