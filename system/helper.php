<?php

function get_current_url(){
	$result = '';
 
	if (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS']=='on')) {
		$result .= 'https://';
	} else {
		$result .= 'http://';
	}
	
	$result .= $_SERVER['SERVER_NAME'];
	$result .= $_SERVER['REQUEST_URI'];
	
	return $result;
}

function redirect($url = SITE_URL){
	header('Location: ' . $url);
	exit;
}

function get_controller_method_uri($controller, $method = 'Index', $flag = true){
	
	$result = '';
	if (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS']=='on')) {
		$result .= 'https://';
	} else {
		$result .= 'http://';
	}
	
	$result .= $_SERVER['SERVER_NAME'];
	$result .= '/' . $controller . '/' . $method . '/';
	
	if($flag){
		$result .= '?' . $_SERVER['QUERY_STRING'];
		$result = preg_replace('/ page=(\d{1,}) /xsi', 'page=', $result);
	}
	
	return $result;
}



function e($value){
	 return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

function isAuth(){
	 if (isset($_SESSION["is_auth"])) { 
		return $_SESSION["is_auth"];
	}
	return false; 
}

