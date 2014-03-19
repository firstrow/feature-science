<?php

namespace FeatureScience;

use FeatureScience\Experiment;
use FeatureScience\Results;
use FeatureScience\FileStorage;
use FeatureScience\Saver;

class Test
{

	protected $name;
	protected $candidates;

    public function __construct($name, $candidates)
    {
		$this->name = $name;
		$this->candidates = $candidates;
    }

    public function run()
    {
		$experiment = new Experiment($this->name, $this->candidates);

		$return = $experiment->run();

		$results = new Results($experiment);
		$saver   = new Saver($results, $this->getStorage());
		$saver->save();

		return $return;
	}

	public function getStorage()
	{
		$storage = new FileStorage('/tmp');
		return $storage;
	}
}
