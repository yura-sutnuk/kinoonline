<?php 

	ini_set('display_errors',0);
	//define ('ROOT',dirname(__FILE__));
	//echo '     INDEX.PHP            ';
	require_once 'const.php';
	require_once (ROOT."/components/routing.php");
	//include_once(ROOT."/components/DB.php");
	
	session_start();
	
	$router = new routing();
	$router->run();
	