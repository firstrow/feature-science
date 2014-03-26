<?php

namespace spec\FeatureScience;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PayloadSaverSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('FeatureScience\PayloadSaver');
    }

    function it_sholud_build_right_save_path()
    {
        $this->beConstructedWith(null);
        $this->getFullFilePath('test')->shouldBe(sys_get_temp_dir() . '/test.json');
    }

    function it_sholud_build_right_save_path_for_defined_dir()
    {
        $this->beConstructedWith('/tmp');
        $this->getFullFilePath('test')->shouldBe('/tmp/test.json');
    }

    function it_should_save_and_load()
    {
        $this->save('test', [1,2,3]);
    }
}
