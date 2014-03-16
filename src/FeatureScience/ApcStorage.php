<?php

namespace FeatureScience;

use FeatureScience\StorageInterface;

class ApcStorage implements StorageInterface
{
	public function save($key, $value)
	{
		return apc_store($key, $value);
	}

	public function load($name)
	{
		return apc_fetch($name);
	}
}
