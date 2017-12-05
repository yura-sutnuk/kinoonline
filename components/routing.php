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
				
						$segment = preg_replace("~$patern~", $path , $uri);
						//var_dump($segment);
						$segment = explode('/',$segment);
					//var_dump($segment);
						
						$controllerName = array_shift($segment)."Controller";
						$actionName="action".ucfirst( array_shift($segment) );
						$param = $segment;
						//echo 'param'. var_dump($param);
						$file = ROOT."/controllers/".$controllerName.".php";
						
						
						if(file_exists($file) )
						{
							include_once($file);
							
						}
						else
						{
							echo "Error 404:  ".$file ."  not founded <br>";
							return;
						}
						
						$controllerObj = new $controllerName;
						
						if(call_user_func_array( array($controllerObj, $actionName) , $param))
						{
							break;
						}
					return;//////////////////////////	
				}
				
			}
			
			
		}
	}