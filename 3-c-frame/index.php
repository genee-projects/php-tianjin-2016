<?php

$sys_path = realpath(isset($_SERVER['SYS_PATH']) ? $_SERVER['SYS_PATH'] : __DIR__.'/..');
define('ROOT_PATH', $sys_path);


// 加载Route配置的信息					   ---> load route
require ROOT_PATH.'/route/index.php';

// 根据Route的配置数据来进行制定相对应的C层分析 ---> dispatch Control
$url_parts = parse_url($_SERVER["REQUEST_URI"]);
$file = $url_parts['path'];
$file = preg_replace('/^\//i', '', $file);
if (!$file) $file = 'list';
$params = explode('/', $file);
$c = array_shift($params);


$scheme = $_SERVER['HTTPS'] ? 'https':'http';
define('BASE_URL', $scheme.'://'.$_SERVER['HTTP_HOST'].preg_replace('/[^\/]*$/', '', $_SERVER['SCRIPT_NAME']));

require ROOT_PATH.'/controller/index.php'; 	// __autoload
require ROOT_PATH.'/libraries/view.php';   	// 预加载机制
require ROOT_PATH.'/model/orm.php';   		// 预加载机制
require ROOT_PATH.'/model/book.php';   		// 预加载机制

$route = $routes[$c];

if ($route) {
	$controller = $route['controller'];
	$method = $route['method'];

	$controller = new $controller;

	if($method && $method[0]!='_' && method_exists($controller, $method)){
	}
	elseif ($method && $method[0]!='_' && method_exists($controller, 'action'.$method)) {
		$method = 'action_'.$method;
	}
	else {
		$method = '__index';
	}
	// 这个地方可以增加C层的拦截器
	$controller->_before_call($method, $params);
	call_user_func_array([$controller, $method], $params);
	// 这个地方可以增加C层的事后处理器
}
else {
	// 为了针对JS和CSS加载所做的临时处理，之后可以用Nginx等web服务器解决
	if ($c == 'public') {
		$path = ROOT_PATH.$url_parts['path'];
		header('Expires: Thu, 15 Apr 2100 20:00:00 GMT');
		header('Pragma: public');
		header('Cache-Control: max-age=604800');
		$ext = @pathinfo($file, PATHINFO_EXTENSION);
		if ($ext == 'js') {
			header('Content-Type: text/javascript; charset=UTF-8');
		}
		else {
			header('Content-Type: text/css; charset:utf-8');
		}
		ob_start('ob_gzhandler');
		@readfile($path);
		ob_end_flush();

		exit;
	}
	// 不符合相应的设计规则，则可以给出权限设置
	else echo '<h3 style="text-align:center;">您访问的页面在火星上!</h3>';
}



