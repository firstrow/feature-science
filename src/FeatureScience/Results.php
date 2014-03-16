<?php

namespace FeatureScience;

class Results
{
    protected $experiment;

    public function __construct(Experiment $experiment)
    {
        $this->experiment = $experiment;
    }

    public function payload()
    {
        $dataKey = $this->getDataKeyName();

        return [
            'name'   => $this->experiment->getName(),
            $dataKey => [
                'duration' => $this->experiment->getExecutionTime()
            ]
        ];
    }

    protected function getDataKeyName()
    {
        if ($this->experiment->isCandidateRunsFirst()) {
            return 'candidate';
        } else {
            return 'control';
        }
    }
}
