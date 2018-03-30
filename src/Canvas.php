<?php

declare(strict_types=1);

namespace Joswide\Canvas;


use Intervention\Image\ImageManagerStatic as Image;

class Canvas{
	public $img;
	
	public $width;
	public $height;
	public $backgroundColor;
	
	public $layers = [];
	
	
	public function __construct(){
		//$this->init();
	}
	
	public function setWidth(int $width):self {
		$this->width = $width;
		
		return $this;
	}
	public function getWidth():int{
		return $this->width;
	}
	
	public function getHeight():int{
		return $this->height;
	}
	
	public function setHeight(int $height) : self {
		$this->height = $height;
		
		return $this;
	}
	
	public function setBackgroundColor($color) : self{
		$this->backgroundColor = $color;
		
		return $this;
	}
	
	public function addLayer(Layer $layer):self{
		$layer->setCanvas($this);
		$this->layers[] = $layer;
		
		return $this;
	}
	public function addLayers(array $layers):self{
		foreach ($layers as $layer){
			$this->addLayer($layer);
		}
		
		return $this;
	}
	public function getLayers(): array {
		return $this->layers;
	}
	
	public function init(){
		//$this->img = Image::canvas($this->width, $this->height, $this->backgroundColor);
		$this->img = Image::canvas($this->width, $this->height, $this->backgroundColor);
		
		return $this;
	}
	
	public function getImage(){
		return $this->img;
	}
	
	public function do(){
		$this->init();
		
		foreach($this->getLayers() as $layer){
			$layer->apply();
		}
	}
	
	public function output(){
		return $this->img->response('png');
	}
	
	public function fitText($text, $fontSize, $width, $height){
		$fontfile = 'assets/OpenSans-Regular.ttf';
		
		$words = explode(' ', $text);
		
		//$box = imagettfbbox (44 ,0 , $fontfile , $texto );
		
		$lines = [];
		$line = '';
		
		//echo '<pre>'; print_r($words);
		
		foreach($words as $word){
			$line .= $word . ' ';
			$box = imagettfbbox ($fontSize, 0 , $fontfile, $line );
			//$lines[] = $line;
			
			if ($box[4] >= $width){
				$lines[] = $line;
				
				$line = '';
			}
			
			//echo '<pre>'; print_r($box);
		}
		
		$lines[] = $line;
		
		return $lines;
		
		//echo '<pre>'; print_r($box); die();
	}
	
	
	
	public function inittesting(){
		
		$width 	= 800;
		$height = 450;
		
		
		//$width 	= 350;
		//$height = 65;
		
		$fontSize = 40;
		
		$this->img = Image::canvas($width, $height, '#ccc');
		
		//$this->img->text('The quick brown fox jumps over the lazy dog.');
		
		$texto = "The quick brown fox jumps over the lazy dog jj. Murciélago";
		//$texto = "Así que, Sancho, por lo que yo quiero a Dulcinea del Toboso, tanto vale como la más alta princesa de la tierra.";
		
		$texto = 'Hola! 😀';
		
		$texto = "$width x $height";
		
		$lineas = $this->fitText($texto, $fontSize, $width, $height);
		
		//echo '<pre>'; print_r($lineas); die();
		
		$fontfile = 'assets/OpenSans-Regular.ttf';
		
		$box = imagettfbbox($fontSize, 0 , $fontfile ,$texto );
		
		//echo '<pre>'; print_r($box); die();
		
		$lines = [
			'The quick brown fox jumps',
			'over the lazy dog.',
			'yep',
			'',
		
			'yeah',
			'The quick brown fox jumps'
		];
		
		$lines = $lineas;
		
		$th = count($lines) * $fontSize; // total height
		$hs = ($height - $th) / 2; // height start
		
		foreach($lines as $i => $line){
			
			$h = ($height/2) - ((count($lines) - $i) * $fontSize);
			
			$h = $hs + ((count($lines) - $i) * $fontSize);
			$h = $hs + ($i + 1) * $fontSize;
			
			$this->img->text($line, ($width/2), $h, function($font) use ($fontSize){
				
			    $font->file('assets/OpenSans-Regular.ttf');
			    $font->size($fontSize);
				$font->color('#969696');
			    $font->align('center');
			    //$font->valign('bottom');
			    //$font->angle(45);
			    
			    
			});
		}
		
		/*
		$this->img->text($texto, (800/2), (400/2), function($font) {
		    $font->file('assets/arial.ttf');
		    $font->size(44);
		   // $font->color('#fdf6e3');
		    $font->align('center');
		    $font->valign('middle');
		    //$font->angle(45);
		});
		*/
		
		
	}
	
	
	
	
	
	
	
	
}