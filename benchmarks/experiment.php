<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require __DIR__ . '/../vendor/autoload.php';

use FeatureScience\Test;
use FeatureScience\PayloadSaver;

\FeatureScience\DI::set('payload.saver', new PayloadSaver('/tmp'));

$experiment = new Test('array.performance', [
    'control' => function(){
        for($i=0;$i<=10000;++$i) {
            $arr = ['a'=>'b', 'c'=>'d'];
            array_key_exists('a', $arr);
        }
    },
    'candidate' => function(){
        for($i=0;$i<=10000;++$i) {
            $arr = ['a'=>'b', 'c'=>'d'];
            array_key_exists('a', $arr);
        }
    }
]);

for($i=0;$i<=1000;++$i) {
    $experiment->run();
}
