<?php
declare(strict_types=1);

namespace Joswide\Canvas;

use Intervention\Image\ImageManagerStatic as Image;


class Layer{
	
	private $canvas;
	protected $params = [];
	
	
	/*
	public function __construct($canvas, $params = []){
		$this->canvas = $canvas;
		$this->params = $params;
	}
	*/
	
	public function __construct($params = []){
		
	}
	
	public function setCanvas(Canvas $canvas) : self{
		$this->canvas = $canvas;
		
		return $this;
	}
	
	public function getCanvas(): Canvas{
		return $this->canvas;
	}
	
	
	
	
}