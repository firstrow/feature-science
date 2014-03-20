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

        $result = [
            'name' => $this->experiment->getName()
        ];

        $result[$dataKey] = [
            'duration'  => $this->experiment->getExecutionTime(),
            'exception' => $this->buildException()
        ];

        return $result;
    }

    public function getExperiment()
    {
        return $this->experiment;
    }

    public function buildException()
    {
        if (!$this->experiment->hasException()) {
            return;
        }

        $e = $this->experiment->getExcepion();

        return [
            'message' => $e->getMessage(),
            'code'    => $e->getCode(),
            'file'    => $e->getFile(),
            'line'    => $e->getLine()
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
