<?php

class book extends orm {

	public $id;
	public $name;
	public $description;
	public $position;

	protected $_items = ['name', 'description', 'position'];

	function _getdbFile()
	{
		return ROOT_PATH.'/config/book.json';
	}

}