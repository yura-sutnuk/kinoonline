<?php

	class routing
	{
		private $routs=[];
		
		public function __construct()
		{
			$this ->routs = include_once("routs.php");
		}
		private function getURI()
		{
			if(!empty($_SERVER['REQUEST_URI']))
			{
				return trim($_SERVER['REQUEST_URI'],'/');
			}
		}
		public function run()
		{
			$uri = $this->getURI();
			
			foreach($this->routs as $patern => $path)
			{	
				if(preg_match("~$patern~", $uri) )
				{
				
					$segment = preg_replace("~$patern~", $path , $uri,1);
					$segment = explode('/',$segment);
						
					$controllerName = array_shift($segment)."Controller";
					$actionName="action".ucfirst( array_shift($segment) );
					$param = $segment;
						
					$file = ROOT."/controllers/".$controllerName.".php";
						
						
					if(file_exists($file) )
					{
						include_once($file);	
					}
					else
					{
						include ROOT.'/views/page404.php';
						return;
					}
						
					$controllerObj = new $controllerName;
					call_user_func_array( array($controllerObj, $actionName) , $param);
					return;
				}
				
			}
			
			include ROOT.'/views/page404.php';
						
			
			
		}
	}