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
        $return     = $experiment->run();

        // Save experiment to temporary storage
        $saver = new Saver(new Results($experiment), $this->getPayloadSaver(), $this->getStorage());
        $saver->save();

        if ($experiment->hasException()) {
            throw $experiment->getExcepion();
        }

        return $return;
    }

    protected function getStorage()
    {
        return DI::get('storage', new ApcStorage);
    }

    protected function getPayloadSaver()
    {
        return DI::get('payload.saver', new PayloadSaver);
    }
}
