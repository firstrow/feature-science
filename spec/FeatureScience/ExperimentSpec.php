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
        $this->shouldNotHaveException();
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

    function it_should_catch_and_save_exceptions()
    {
        $this->beConstructedWith('foo.bar', [
            'control'   => function(){ throw new \Exception('Test Exception'); },
            'candidate' => function(){ throw new \Exception('Test Exception'); },
        ]);

        $this->run();
        $this->shouldHaveException();
        $this->getExcepion()->shouldBeAnInstanceOf('Exception');
        $this->getExcepion()->getMessage()->shouldBe('Test Exception');
    }

    function it_should_have_payload_save_limit()
    {
        $this->setPayloadLimit(99);
        $this->getPayloadLimit()->shouldBe(99);
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
