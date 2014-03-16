<?php

namespace FeatureScience;

interface StorageInterface
{
	public function save($key, $value);

	public function load($name);
}
