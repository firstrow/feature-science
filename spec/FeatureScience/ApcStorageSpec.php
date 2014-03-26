<?php

namespace spec\FeatureScience;

use PhpSpec\ObjectBehavior;
use FeatureScience\ApcStorage;

class ApcStorageSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('FeatureScience\ApcStorage');
    }

    public function it_should_save_data()
    {
        $this->save('foo', 'bar');
        $this->load('foo')->shouldReturn('bar');
    }

    public function it_should_increment()
    {
        $name = 'test_' . time();
        $this->increaseSaves($name)->shouldReturn(1);
        $this->increaseSaves($name)->shouldReturn(2);
        $this->increaseSaves($name)->shouldReturn(3);
    }
}
