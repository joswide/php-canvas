<?php
	
include("../vendor/autoload.php");

use \Joswide\Canvas;


$titulo = 'Este es el título del último post de esta semana!. Podemos hacerlo mucho más largo y el texto se ajusta por sí mismo. Buscando una quinta línea para comparar posiciones.';

//$titulo = 'Este es el título del último post de esta semana!. Podemos hacerlo mucho más largo y el texto se ajusta por sí mismo.';

$post = new Canvas\Designs\BlogPost([
	'width'		=> 1200,
	'height'	=> 600,
	'title'		=> $titulo,
	
	'titleColor'		=> '#111',
	'backgroundColor'	=> '#FFCE00',
	
]);

$image = $post->getImage();

header ('Content-Type: image/png'); echo $image;

