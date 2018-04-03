<?php
declare(strict_types=1);

namespace Joswide\Canvas\Layers;

use Joswide\Canvas\Layer;
use Intervention\Image\ImageManagerStatic as Image;


class Placeholder extends Layer{
	public $text 		= 'Placeholder';
	public $textColor 	= '#000000';
	
	public function __construct($params = []){
		$this->text = $params['text']??'Placeholder';
		
		$this->textColor = $params['textColor']??'#000000';
	}	
	
	public function applyll(){
		
	}
	
	public function apply(){
		$fontSize = 40;
		
		$textColor	= $this->textColor;
		
		$img = $this->getCanvas()->getImage();
		
		$width = $this->getCanvas()->getWidth();
		$height	= $this->getCanvas()->getHeight();
		
		$texto = "$width x $height";
		
		$lineas = $this->fitText($texto, $fontSize, $width, $height);
		
		//echo '<pre>'; print_r($lineas); die();
		
		$fontfile = 'assets/OpenSans-Regular.ttf';
		
		$box = imagettfbbox($fontSize, 0 , $fontfile ,$texto );
		
		//echo '<pre>'; print_r($box); die();
		
		$lines = $lineas;
		
		$th = count($lines) * $fontSize; // total height
		$hs = ($height - $th) / 2; // height start
		
		foreach($lines as $i => $line){
			
			$h = ($height/2) - ((count($lines) - $i) * $fontSize);
			
			$h = $hs + ((count($lines) - $i) * $fontSize);
			$h = $hs + ($i + 1) * $fontSize;
			
			$img->text($line, ($width/2), $h, function($font) use ($fontSize, $textColor){
				
			    $font->file('assets/OpenSans-Regular.ttf');
			    $font->size($fontSize);
				$font->color($textColor);
			    $font->align('center');
			    //$font->valign('bottom');
			});
		}
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
	
}