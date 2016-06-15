<?php

class Index_Controller {

	public function _before_call()
	{

	}

	public function index()
	{
		$filePath = ROOT_PATH.'/config/book.json';
		$jsonData = @file_get_contents($filePath);
		$books = @json_decode($jsonData, true);
		echo _V('layout', [
				'body' => _V('list', [
						'books' => $books
					]),
				'title' => '图书馆列表'
			]);
	}	

	public function add()
	{
		$form = $_POST;
		if ($form['submit']) {

			$book = new book();
			$book->name = $form['name'];
			$book->position = $form['position'];
			$book->description = $form['description'];
			$book->save();

			if ($book->id) {
				header('Location: /edit/'.$book->id, TRUE, 302);
				exit();
			}
		}
		echo _V('layout', [
				'body' => _V('add'),
				'title' => '添加图书'
			]);
	}

	public function edit($id=0)
	{
		$book = new book($id);
		$form = $_POST;
		if ($form['submit']) {

			$book->name = $form['name'];
			$book->position = $form['position'];
			$book->description = $form['description'];
			$book->save();

			if ($book->id) {
				header('Location: /edit/'.$book->id, TRUE, 302);
				exit();
			}
		}
		echo _V('layout', [
				'body' => _V('edit', [
						'book' => $book
					]),
				'title' => strtr('修改图书 [%name]', ['%name' => $book->name])
			]);
	}

	public function delete($id=0)
	{
		$book = new book($id);
		$book->delete();
		return '删除成功!';
	}

}