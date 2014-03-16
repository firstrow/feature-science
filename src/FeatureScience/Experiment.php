<?php

namespace FeatureScience;

class Experiment
{

    protected $name;
    protected $candidates;
    protected $executionTime;
    protected $subject;
    protected $candidateRunsFirst;

    public function __construct($name, $candidates)
    {
        $this->name       = $name;
        $this->candidates = $candidates;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getControl()
    {
        return $this->candidates['control'];
    }

    public function getCandidate()
    {
        return $this->candidates['candidate'];
    }

    public function run()
    {
        $start = microtime(true);

        $result = $this->getSubject()->__invoke();

        $this->executionTime = microtime(true) - $start;

        return $result;
    }

    public function getExecutionTime()
    {
        return $this->executionTime;
    }

    /**
     * Select subject to measure.
     */
    protected function getSubject()
    {
        if ($this->isCandidateRunsFirst()) {
            return $this->getCandidate();
        } else {
            return $this->getControl();
        }
    }

    public function isCandidateRunsFirst()
    {
        if ($this->candidateRunsFirst !== null) {
            return $this->candidateRunsFirst;
        }

        $this->candidateRunsFirst = rand(0, 1);

        return $this->candidateRunsFirst;
    }

}
