<?php

namespace FeatureScience;

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
