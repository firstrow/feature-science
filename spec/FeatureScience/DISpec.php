<?php

namespace spec\FeatureScience;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DISpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('FeatureScience\DI');
    }
}
