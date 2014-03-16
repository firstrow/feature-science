<?php

namespace spec\FeatureScience;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ExperimentSpec extends ObjectBehavior
{

    function let()
    {
        $this->beConstructedWith('foo.bar', [
            'control'   => function(){ usleep(100); return 'control'; },
            'candidate' => function(){ usleep(50); return 'candidate'; },
        ]);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('FeatureScience\Experiment');
    }

    function it_should_have_name()
    {
        $this->getName()->shouldBe('foo.bar');
    }

    function it_should_have_candidate_and_control()
    {
        $this->getCandidate()->shouldBeAnInstanceOf('Closure');
        $this->getControl()->shouldBeAnInstanceOf('Closure');
    }

    function it_should_return_result()
    {
        $this->getCandidate()->__invoke()->shouldReturn('candidate');
        $this->getControl()->__invoke()->shouldReturn('control');
    }

    function it_should_run_and_return_expected_result()
    {
        $this->run()->shouldHaveValue(['candidate', 'control']);
    }

    function it_should_measure_execution_time()
    {
        $this->run();
        $this->getExecutionTime()->shouldBeDouble();
    }

    function it_should_memoize_isCandidateRunsFirst()
    {
        $r = $this->isCandidateRunsFirst();
        for($i=0;$i<=5;++$i) {
            $this->isCandidateRunsFirst()->shouldBe($r);
        }
    }

    public function getMatchers()
    {
        return [
            'haveValue' => function($subject, $value) {
                return in_array($subject, $value);
            },
        ];
    }
}
