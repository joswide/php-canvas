<?php
	
include("../vendor/autoload.php");

use \Joswide\Canvas;



$canvas = new Canvas\Canvas();

//$canvas->setWidth(800)->setHeight(300)->setBackgroundColor('#ccc')->init();

$canvas->setWidth(800)->setHeight(300);

//->setBackgroundColor('#ccc');



$backgroundColor = new Canvas\Layers\BackgroundColor([
	'color' => 'rgb(34,89,200)'
]);

$canvas->addLayer($backgroundColor);

$placeholder = new Canvas\Layers\Placeholder([]);
$canvas->addLayer($placeholder);

$heroText = new Canvas\Layers\HeroText([]);
$canvas->addLayer($heroText);

$canvas->init();

$canvas->do();

echo $canvas->output();