<?php

namespace spec\FeatureScience;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TestSpec extends ObjectBehavior
{

    function let()
    {
        $this->beConstructedWith('test.test', [
            'control'   => function(){ return 'control'; },
            'candidate' => function(){ return 'candidate'; },
        ]);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('FeatureScience\Test');
    }

    function it_should_run_experiment()
    {
        $this->run()->shouldHaveValues(['control', 'candidate']);
    }

    public function getMatchers()
    {
        return [
            'haveValues' => function($result, $possibleValues) {
                return in_array($result, $possibleValues);
            },
        ];
    }
}