<?php

namespace FeatureScience;

/**
 * Main class to run tests.
 *
 * Configuring.
 * <pre>
 * 		\FeatureScience\DI::set([
 *			'storage'=> new \FeatureScience\FileStorage('/tmp');
 * 		]);
 * </pre>
 * NOTE: By default FeatureScience uses `FileStorage` class.
 *
 * Support config options:
 *  - storage: Class to temporary store expetiment results.
 *
 * Example usage:
 * <pre>
 *		$experiment = new \FeatureScience\Test('file.save', [
 *			'control'   => function() { return $this->oldMethod(); },
 *			'candidate' => function() { return $this->newMethod(); }
 *		]);
 *
 * 		// Will return randomly selected lambda and save results to storage.
 *		$experiment->run();
 * </pre>
 */
class Test
{

    protected $name;
    protected $candidates;

    public function __construct($name, $candidates)
    {
        $this->name       = $name;
        $this->candidates = $candidates;
    }

    public function run()
    {
        $experiment = new Experiment($this->name, $this->candidates);
        $saver      = new Saver(new Results($experiment), $this->getStorage());

        $return = $experiment->run();
        $saver->save();

        return $return;
    }

    protected function getStorage()
    {
        return DI::get('storage', new FileStorage);
    }
}
