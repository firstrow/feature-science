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
        $this->experiment = new Experiment($this->name, $this->candidates);
    }

    public function run()
    {
        $return = $this->experiment->run();

        // Save experiment to temporary storage
        $saver = new Saver(new Results($this->experiment), $this->getPayloadSaver(), $this->getStorage());
        $saver->save();

        if ($this->experiment->hasException()) {
            throw $this->experiment->getExcepion();
        }

        return $return;
    }

    public function setPayloadLimit($limit)
    {
        $this->experiment->setPayloadLimit($limit);
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
