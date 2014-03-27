<?php

require __DIR__ . '/../vendor/autoload.php';

$subject = function(){
    for($i=0;$i<=10000;++$i) {
        $arr = ['a'=>'b', 'c'=>'d'];
        array_key_exists('a', $arr);
    }
};

$experiment = new \FeatureScience\Test('array.performance', [
    'control'   => $subject,
    'candidate' => $subject
]);

for($i=0;$i<=1000;++$i) {
    $experiment->run();
}
