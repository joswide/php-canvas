<?php
declare(strict_types=1);

namespace Joswide\Canvas\Layers;

use Joswide\Canvas\Layer;


class BackgroundColor extends Layer{
	public $color;
	
	public function __construct($params = []){
		$this->color = $params['color']??'#fff';
	}	
	
	public function apply(){
		
		$color = $this->color;
		
		$img = $this->getCanvas()->getImage();
		
		$img->rectangle(0, 0, $this->getCanvas()->getWidth(), $this->getCanvas()->getHeight(), function ($draw) use ($color) {
		    $draw->background($color);
		});
		
	}
}