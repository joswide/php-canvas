<?php
namespace Joswide\Canvas\Designs;

use \Joswide\Canvas;

class BlogPost extends \Joswide\Canvas\Design{
	
	public function __construct(array $params = []){
		parent::__construct($params);
	}
	

	public function draw(){
		
		$backgroundColor	= $this->getParam('backgroundColor') ?? '#eee';
		$titleColor			= $this->getParam('titleColor') ?? '#333';
		
		$fontsFolder		= $this->getParam('fontsFolder') ?? null;
		
		//echo $fontsFolder;
		
		/** Add background layer */
		$backgroundColorLayer = new Canvas\Layers\BackgroundColor([
			'color' => $backgroundColor
		]);

		$this->getCanvas()->addLayer($backgroundColorLayer);
		
		/** Add text */
		
		$title = $this->getParam('title');
		
		$heroText = new Canvas\Layers\HeroText([
			'color' => $titleColor,
			'text'	=> $this->getParam('title'),
			'fontsFolder'	=> $fontsFolder
		]);
		$this->getCanvas()->addLayer($heroText);
		
		//echo '<pre>'; print_r($this); exit();
		
		//echo $title;
		
		
	}
	
}