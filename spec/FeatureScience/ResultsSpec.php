<?php

namespace spec\FeatureScience;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

use FeatureScience\Experiment;

class ResultsSpec extends ObjectBehavior
{
    private $experiment;

    function let()
    {
        $this->experiment = new Experiment('foo.bar', [
            'control'   => null,
            'candidate' => null
        ]);

        $this->beConstructedWith($this->experiment);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('FeatureScience\Results');
    }

    function it_should_build_result_array_based_on_experiment()
    {
        $this->payload()->shouldBeArray();
    }

    function its_result_should_include_experiment_name()
    {
        $this->payload()->shouldHaveKey('name');
        $this->payload()->shouldContain('foo.bar');
    }

    function it_should_contain_control_or_cantidate_key()
    {
        if ($this->experiment->isCandidateRunsFirst()) {
            $this->payload()->shouldHaveKey('candidate');
        } else {
            $this->payload()->shouldHaveKey('control');
        }
    }

    function it_sholud_payload_exception()
    {
        $this->experiment = new Experiment('test.test', [
            'control'   => function(){ throw new \Exception('Test'); },
            'candidate' => function(){ throw new \Exception('Test'); },
        ]);
        $this->experiment->run();
        $this->beConstructedWith($this->experiment);

        $this->buildException()->shouldHaveCount(4);
    }
}
