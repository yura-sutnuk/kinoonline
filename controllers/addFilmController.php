<?php
/*
include ($_SERVER['DOCUMENT_ROOT'].'/const.php');
include(ROOT."/models/FilmModel.php");

	class addFilmController
	{
		public function actionAdd()
		{
		  //var_dump(genreList);
			include_once ROOT."/views/add.php";
			
			return true;
		}
		
		public function addFilm()
		{
								var_dump($_POST);
						echo '<br><br>';
						var_dump($_FILES);
			
				foreach($_POST as $value)
				{
					if($value==null)
					{
			    		return;
					}					
				}
				
				foreach ($_FILES as $field)
				{
					if($field['type']!=='image/jpeg')
					{
						return;
					}
				}
				
				$_POST['video'] = $this->upload($_POST['video'],ROOT."/views/video/");
				$_POST['poster'] = $this->upload($_FILES['poster']['tmp_name'],ROOT."/views/images/".$_FILES['poster']['name']);
				$_POST['screen1'] = $this->upload($_FILES['screen1']['tmp_name'],ROOT."/views/images/".$_FILES['screen1']['name']);
				$_POST['screen2'] = $this->upload($_FILES['screen2']['tmp_name'],ROOT."/views/images/".$_FILES['screen2']['name']);
				$_POST['screen3'] = $this->upload($_FILES['screen3']['tmp_name'],ROOT."/views/images/".$_FILES['screen3']['name']);
				
				$_POST['genre'] = implode (',',$_POST['genre']);
				//print_r($_POST);
				unset($_POST['submit']);
				$objModel = new FilmModel (new PDOConnect());
				if($objModel->addFilm($_POST)!=false)
				//echo "Успешное добавление фильма";
			include_once ROOT."/views/add.php";
		}
		
		private function upload($source,$destination)
		{	
				//$regularWeb = '~[(http)|(//[a-z]+)]~';
				//$regularLocal = '~[a-z]:/~';
				$regularTmpDir = '~php(.+).tmp~';
				if(preg_match($regularTmpDir,$source))
				{
					echo $destination.' <br>     ';
					move_uploaded_file($source, $destination);
					return basename($destination);
				}
				return $source;
		}

	}
	
	if(isset($_POST)&&!empty($_POST)){
	//print_r($_POST);
	htmlspecialchars($_POST['video']);
	
$obj = new addFilmController();
	$obj->addFilm();}