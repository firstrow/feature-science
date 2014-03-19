<?php

namespace spec\FeatureScience;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

use FeatureScience\FileStorage;
use FeatureScience\Results;
use FeatureScience\Experiment;

class SaverSpec extends ObjectBehavior
{
    private $experiment;

    function let(Results $results, FileStorage $storage)
    {
        $this->experiment = new Experiment('foo.bar', [
            'control'   => null,
            'candidate' => null
        ]);

        $this->beConstructedWith($results, $storage);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('FeatureScience\Saver');
    }

    function it_should_merge_arrays_and_save_results(Results $results, FileStorage $storage)
    {
        $results->getExperiment()->willReturn($this->experiment);
        $storage->load('foo.bar')->willReturn([
            'name'    => 'foo.bar',
            'control' => ['duration' => 0.02]
        ]);
        $results->payload()->willReturn([
            'name'      => 'foo.bar',
            'candidate' => ['duration' => 0.01]
        ]);

        $storage->save('foo.bar', [
            'name'      => 'foo.bar',
            'control'   => ['duration' => 0.02],
            'candidate' => ['duration' => 0.01],
        ])->shouldBeCalled();

        $this->save();
    }
}
