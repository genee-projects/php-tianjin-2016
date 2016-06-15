<?php

class orm {

	public $id;

	protected $_items = [];

	public function __construct($id=0)
	{
		$this->_setData($id);
	}

	private function _setData($id=0) {
		$data = $this->_getData();
		if ($data[$id]) {
			$this->id = $id;
			foreach ($this->getItems() as $attr) {
				$this->$attr = $data[$id][$attr];
			}
		}
	} 

	function _getdbFile()
	{
		return ROOT_PATH . '/config/lock';
	}

	private function _getData()
	{
		$filePath = $this->_getdbFile();
		$jsonData = @file_get_contents($filePath);
		return @json_decode($jsonData, true);
	}

	private function getItems()
	{
		return (array)$this->_items;
	}

	public function save()
	{
		$data = $this->_getData();
		if ($this->id) {
			$id = $this->id;
		}
		else {
			$id = (int)array_pop(array_keys($data)) + 1;
			$data[$id] = [];
		}
		foreach ($this->getItems() as $attr) {
			$data[$id][$attr] = $this->$attr;
		}
		@file_put_contents($this->_getdbFile(), @json_encode($data));
		$this->_setData($id);
	}

	public function delete()
	{
		$data = $this->_getData();
		unset($data[$this->id]);
		@file_put_contents($this->_getdbFile(), @json_encode($data));
	}

}