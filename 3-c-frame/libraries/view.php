<?php

class View {

	protected $vars = [];
	protected $parent;
	protected $path;

	private $_VEXT = '.phtml';

	function __construct($path, $vars=NULL){

		$this->path = $path;
		if (is_array($vars)) {
			$this->vars = array_merge($this->vars, $vars);
		}

	}

	static function factory($path, $vars=NULL) {
		return new View($path, $vars);
	}

	static function setup() {
	}

	//返回子View
	function __get($key){
		return $this->vars[$key];
	}

	function __set($key, $value){
		if ($value === NULL) {
			if($value instanceof View){
				$value->parent = NULL;
			}
			unset($this->vars[$key]);
		} else {
			$this->vars[$key] = $value;
			if($value instanceof View){
				$value->parent = $this;
			}
		}
	}

	function __unset($key) {
		unset($this->vars[$key]);
	}

	function __isset($key) {
		return isset($this->vars[$key]);
	}

	function ob_clean(){
		unset($this->_ob_cache);
		return $this;
	}

	//返回View内容
	private $_ob_cache;

	private function _include_view($_path, $_vars) {
		if ($_path) {
			ob_start();
			extract($_vars);

			@include($_path);

			$output = ob_get_contents();
			ob_end_clean();
		}

		return $output;
	}

	function __toString(){

		if ($this->_ob_cache !== NULL) return $this->_ob_cache;

		//从$path里面获取category;
		list($category, $path) = explode(':', $this->path, 2);
		if (!$path) {
			$path = $category;
			$category = NULL;
		}

		$v = $this;
		$_vars = [];

		while ($v) {
			$_vars += $v->vars;
			$v = $v->parent;
		}

		$_path = ROOT_PATH.'/view/'.$path.$this->_VEXT;

        if ($_path) {
    		$output = $this->_include_view($_path, $_vars);
        }

		return $this->_ob_cache = $output;

	}

	function set($name, $value=NULL){
		if(is_array($name)){
			array_map(array($this, __FUNCTION__), array_keys($name), array_values($name));
			return $this;
		} else {
			$this->$name=$value;
		}

		return $this;
	}

	function render(){
		echo $this;
	}

	function embed($view){
		$view = $view instanceof View ? $view: V($view);
		$view->parent = $this;
		return $view;
	}

}

function _V($path, $vars=NULL) {
	return View::factory($path, $vars);
}