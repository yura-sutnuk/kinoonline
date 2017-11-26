<?php

include ($_SERVER['DOCUMENT_ROOT'].'/const.php');

include(ROOT."/models/BDModel.php");
	class addController
	{
		public function actionAdd()
		{
		
	
						$var = include_once ROOT."/views/add.php";
						var_dump($var);
			if($var) // true при попытке повторного подключения 
			{
				
				foreach($_POST as $value)
				{
					if($value==null)
					{
						return;
					}					
				}
				
				$_POST['video'] = $this->upload($_POST['video'],ROOT."/views/video/");
				$_POST['poster'] = $this->upload($_POST['poster'],ROOT."/views/images/");
				$_POST['screen1'] = $this->upload($_POST['screen1'],ROOT."/views/images/");
				$_POST['screen2'] = $this->upload($_POST['screen2'],ROOT."/views/images/");
				$_POST['screen3'] = $this->upload($_POST['screen3'],ROOT."/views/images/");
				
				$_POST['genre'] = implode (',',$_POST['genre']);
				//print_r($_POST);
				$objModel = new BDModel (new PDOConnect());
				if($objModel->addFilm($_POST)!=false)
				echo "Успешное добавление Фильма";
			}
		}
		
		private function upload($source,$destination)
		{	
				$regularWeb = '~[(http)|(//[a-z]+)]~';
				//$regularLocal = '~[a-z]:/~';
				if(!preg_match($regularWeb,$source))
				{
					move_uploaded_file($source, $destination);
					return $destination.basename($source);
				}
				return $source;
		}
	}
	
	if(isset($_POST)){
	//print_r($_POST);
	
$obj = new addController();
	$obj->actionAdd();}