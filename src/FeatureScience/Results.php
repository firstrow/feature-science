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

    public function getExperiment()
    {
        return $this->experiment;
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
