<?php

namespace spec\FeatureScience;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use FeatureScience\ApcStorage;
use FeatureScience\Experiment;

class SaverSpec extends ObjectBehavior
{
    function let(Experiment $experiment, ApcStorage $storage)
    {
        $this->beConstructedWith($experiment, $storage);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('FeatureScience\Saver');
    }

    function it_should_load_and_merge_arrays()
    {

    }
}
