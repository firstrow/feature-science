<?php

namespace spec\FeatureScience;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use FeatureScience\Experiment;

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

    function it_should_save_experiment()
    {
        $experiment = new Experiment('foo.bar', [
            'control'   => function(){},
            'candidate' => function(){},
        ]);
        $experiment->run();

        $this->save('foo.bar', []);
    }
}
