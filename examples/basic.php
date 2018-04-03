<?php
	
include("../vendor/autoload.php");

use \Joswide\Canvas;



$canvas = new Canvas\Canvas();

//$canvas->setWidth(800)->setHeight(300)->setBackgroundColor('#ccc')->init();

$canvas->setWidth(800)->setHeight(300);

//->setBackgroundColor('#ccc');



$backgroundColor = new Canvas\Layers\BackgroundColor([
	'color' => '#3685b1'
]);

$canvas->addLayer($backgroundColor);

$placeholder = new Canvas\Layers\Placeholder([
	'textColor'	=> '#fefefe'
]);
$canvas->addLayer($placeholder);

$heroText = new Canvas\Layers\HeroText([
	'color' => 'rgba(255,255,255,0.8)'
]);
$canvas->addLayer($heroText);

$canvas->init();

$canvas->do();

echo $canvas->output();