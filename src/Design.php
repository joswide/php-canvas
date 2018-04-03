<?php
declare(strict_types=1);

namespace Joswide\Canvas;

class Design{
	
	protected $canvas;
	public $params = [];
	protected $is_maked = false;
	
	public function __construct(array $params = []){
		
		//print_r($params);
		
		$this->setParams($params);
	}
	
	
	//abstract public function draw();
	
	public function make():self {
		if (!$this->is_maked){
			
			$this->initCanvas();
			
			$this->draw();
			
			$this->doCanvas();
			
			$this->is_maked = true;
		}
		
		return $this;
	}
	
	public function initCanvas():self {
		$this->canvas = new Canvas();
		
		/** size */
		$this->canvas->setWidth( $this->getParam('width')?? 1200 );
		$this->canvas->setHeight( $this->getParam('height')?? 900 );
		
		/** background color */
		$this->canvas->setBackgroundColor( $this->getParam('backgroundColor') ?? '#999');
		
		/** init canvas */
		$this->canvas->init();
		
		//echo '<pre>'; print_r($this->canvas); die();
		
		
		return $this;
	}
	
	public function doCanvas():self {
		$this->canvas->do();
		
		return $this;
	}
	
	public function getImage($format = 'png'){
		return $this->make()->getCanvas()->output($format);
	}

	
   /**
	*	Returns canvas instance
	*
	*	@return \Joswide\Canvas\Design
	*
	*/
	public function getCanvas(): \Joswide\Canvas\Canvas {
		return $this->canvas;
	}
	
	
   /**
	*	Get param value by name
	*
	*	@return mixed 
	*
	*/
	public function getParam(string $name){
		return $this->params[$name] ?? null;
	}
	
	
   /**
	*	Set param
	*
	*
	*	@param string 	$name Param name
	*	@param			$value Value param
	*
	*	@return $this
	*
	*/
	public function setParam(string $name, $value):self{
		$this->params[$name] = $value;
		
		return $this;
	}

  /**
	*	Set a list of params key => $value
	*
	*	@param string 	$name Param name
	*	@param			$value Value param
	*
	*	@return $this
	*
	*/
	public function setParams(array $params){
		
		// 
		foreach($params as $name => $value){
			$this->setParam($name, $value);
		}
		
		return $this;
	}
	
	
	
}