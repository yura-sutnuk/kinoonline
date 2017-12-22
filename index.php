<?php 

	ini_set('display_errors',1);
	require_once 'const.php';
	require_once (ROOT."/components/routing.php");
	
	session_start();
	
	$router = new routing();
	$router->run();
	