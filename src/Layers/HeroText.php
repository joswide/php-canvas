<?php
declare(strict_types=1);

namespace Joswide\Canvas\Layers;

use Joswide\Canvas\Layer;

class HeroText extends Layer{
	public $text = 'Placeholder';
	public $color = '#000';
	
	public function __construct($params = []){
		$this->text = $params['text']??'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.';
		$this->color = $params['color']??'#000';
	}	
	
	public function apply(){
		$fontSize = 50;
		
		$img = $this->getCanvas()->getImage();
		
		$width 	= $this->getCanvas()->getWidth();
		$height	= $this->getCanvas()->getHeight();
		
		$texto 		= $this->text;
		$fontColor	= $this->color;
		
		$lineas = $this->fitText($texto, $fontSize, $width, $height);
		
		$fittedText = $this->getFittedText($texto, $fontSize, $width, $height);
		
		$lineas 	= $fittedText->lines;
		$fontSize 	= $fittedText->fontSize;
		
		//echo '<pre>'; print_r($fittedText); die();
		
		$fontfile = 'assets/OpenSans-Regular.ttf';
		
		$box = imagettfbbox($fontSize, 0 , $fontfile ,$texto );
		
		//echo '<pre>'; print_r($box); //die();
		
		$lines = $lineas;
		
		$th = count($lines) * $fontSize; // total height
		$hs = ($height - $th) / 2; // height start
		
		foreach($lines as $i => $line){
			
			$lineBox = imagettfbbox($fontSize, 0 , $fontfile, $line );
			$lineHeight = abs($lineBox[7]);
			
			//$lineHeight = 0;
			
			$h = ($height/2) - ((count($lines) - $i) * $lineHeight);
			
			$h = $hs + ((count($lines) - $i) * $lineHeight);
			$h = $hs + ($i + 1) * $lineHeight;
			
			
			$lineBox = imagettfbbox($fontSize, 0 , $fontfile ,$line );
			//echo '<pre>'; print_r($line); print_r($lineBox);
			
			$h = $h + $box[7];
			
			$img->text($line, ($width/2), $h, function($font) use ($fontSize, $fontColor){
				
			    $font->file('assets/OpenSans-Regular.ttf');
			    $font->size($fontSize);
				$font->color($fontColor);
			    $font->align('center');
			    $font->valign('middle');
			});
		}
		
		//exit();
	}
	
	public function getFittedText($text, $fontSize, $width, $height){
		$fontfile 	= 'assets/OpenSans-Regular.ttf';
		$words 		= explode(' ', $text);
		
		//$box = imagettfbbox (44 ,0 , $fontfile , $texto );
		
		$lines = [];
		$line = '';
		
		$h = 0;

		foreach($words as $word){
			$line .= $word . ' ';
			$box = imagettfbbox ($fontSize, 0 , $fontfile, $line );
			//$lines[] = $line;
			
			//echo '<pre>'; print_r($box);
			
			if ($box[4] >= $width){
				$lines[] = $line;	
				$line = '';
				
				$h = $h + abs($box[7]);
			}
		}
		
		$h = $h + abs($box[7]);
		$lines[] = $line;
		
		if ($h > $height){
			return $this->getFittedText($text, ($fontSize - 5), $width, $height);
		}
		
		return (object) [
			'fontSize'	=> $fontSize,
			'lines'		=> $lines,
		];
		
		return $lines;
	}
	
   /**
	*
	*
	*
	*
	*/
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