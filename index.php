<?php 

	ini_set('display_errors',1);
	//define ('ROOT',dirname(__FILE__));
	echo '     INDEX.PHP            ';
	require_once 'const.php';
	require_once (ROOT."/components/routing.php");
							
	$router = new routing();
	$router->run();
	