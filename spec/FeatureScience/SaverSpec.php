<?php

namespace spec\FeatureScience;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

use FeatureScience\ApcStorage;
use FeatureScience\Results;
use FeatureScience\Experiment;
use FeatureScience\PayloadSaver;

class SaverSpec extends ObjectBehavior
{
    private $experiment;

    function let(Results $results, PayloadSaver $payloadSaver, ApcStorage $storage)
    {
        $this->experiment = new Experiment('foo.bar', [
            'control'   => null,
            'candidate' => null
        ]);

        $this->beConstructedWith($results, $payloadSaver, $storage);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('FeatureScience\Saver');
    }

    function it_should_merge_arrays_and_save_results(Results $results, PayloadSaver $payloadSaver, ApcStorage $storage)
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
        $storage->increaseSaves('foo.bar')->shouldBeCalled();
        $storage->increaseSaves('foo.bar')->willReturn(101);

        $payloadSaver->save(Argument::any(), Argument::any())->shouldBeCalled();

        $this->save();
    }

}
