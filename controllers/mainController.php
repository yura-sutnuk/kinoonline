<?php

include ($_SERVER['DOCUMENT_ROOT'].'/const.php');
include_once(ROOT."/models/FilmModel.php");


	class mainController
	{	
		//private $model;
		
	/*	public function __construct (IConnection $IConnect)
		{
			//$this->model = new 
		}*/

		public function actionMain()
		{	
			$modelObj = new FilmModel(new PDOConnect());
			$filmsList = $modelObj->getFilmsList();
			$randFilm = $modelObj->getRandomPoster();
			
			for($i=0;$i<count($filmsList);$i++)
			$filmsList[$i]['genre'] = explode(',', $filmsList[$i]['genre']);			
			
			include ROOT.'/views/main.php';

			return true;
		}
		
		public function actionGenre($genre)
		{
			$modelObj = new FilmModel(new PDOConnect());
			$genre = GENRE_LIST[$genre];
			$filmsList = $modelObj->getFilmByGenre($genre);
			$randFilm = $modelObj->getRandomPoster();
			for($i=0;$i<count($filmsList);$i++)
			$filmsList[$i]['genre'] = explode(',', $filmsList[$i]['genre']);			
			
			include ROOT.'/views/main.php';

			return true;
		}
		
		public function actionFilm ($id, $param='')
		{  
		    $link = new PDOConnect();
			$modelObj = new FilmModel($link);
			
			$commentData = $modelObj->getCommentData($id);
			//echo '<br>$id = '.$id.'<br>';
			$filmData = $modelObj ->getFilmById($id)[0];
			$filmData["genre"]= explode(',', $filmData["genre"]);
			$randFilm = $modelObj->getRandomPoster();

			var_dump($randFilm);
			include ROOT.'/views/film.php';		
			return true;
		}
        
		public function addComment()
		{
		  include ROOT."/models/commentModel.php";
		  session_start();
		  $commentModel = new commentModel(new PDOConnect());
		  $commentModel->insertComment($_SESSION['id'], $_POST['id_film'], $_POST['text']);
		  header('Location: /film/'.$_POST['id_film']);
		}
		
		public function actionFilmEdit($id, $param='')
		{
			$link = new PDOConnect();
			$modelObj = new FilmModel($link);
			$commentData = $modelObj->getCommentData($id);		
			
			$filmData = $modelObj ->getFilmById($id)[0];
			$filmData["genre"]= explode(',', $filmData["genre"]);
			$randFilm = $modelObj->getRandomPoster();
			include ROOT.'/views/filmEdit.php';
		}
		
		public function actionAdd()
		{
		  //var_dump(genreList);
			include_once ROOT."/views/add.php";
			
			return true;
		}
		
		public function addFilm()
		{
				/*foreach($_POST as $value)
				{
					if($value==null)
					{
			    		return;
					}					
				}
				*/
				foreach ($_FILES as $field)
				{
					if($field['type']!=='image/jpeg')
					{
						return;
					}
				}
				//echo"ee";
				//$_POST['video'] = $this->upload($_POST['video'],ROOT."/views/video/");
				$_POST['video'] = preg_replace('~src="([0-9a-z/.]*)"~', '$1' , $_POST['video']);
				$_POST['poster'] = $this->upload($_FILES['poster']['tmp_name'],ROOT."/views/images/".$_FILES['poster']['name']);
				$_POST['screen1'] = $this->upload($_FILES['screen1']['tmp_name'],ROOT."/views/images/".$_FILES['screen1']['name']);
				$_POST['screen2'] = $this->upload($_FILES['screen2']['tmp_name'],ROOT."/views/images/".$_FILES['screen2']['name']);
				$_POST['screen3'] = $this->upload($_FILES['screen3']['tmp_name'],ROOT."/views/images/".$_FILES['screen3']['name']);
				
				$_POST['genre'] = implode (',',$_POST['genre']);
				//print_r($_POST);
				unset($_POST['addFilm']);
				$objModel = new FilmModel (new PDOConnect());
				//echo'22';
				$objModel->addFilm($_POST);
				//echo "“спешное добавление фильма";
				//echo"11";
				  include ROOT."/views/add.php";
				
		}
		
		public function actionFilmDelete($id)
		{
			$modelObj = new FilmModel(new PDOConnect());
			$modelObj->deleteFilm($id);
			header('Location: /');// dirname($_SERVER['HTTP_REFERER']);
		}
		
		public function editFilm()
		{	
			$link = new PDOConnect();
			$this->model = new FilmModel($link);
			
			if(!empty($_POST['video']))
			{//[0-9a-z/.]{0,}
				echo $_POST['video'].'<br><br>';
				
				$patern ='.*src=\"(.*?)\" ';
				
				var_dump(preg_match("~$patern~",$_POST['video'] ));
				
				$_POST['video'] = preg_replace("~$patern~", '$1' , $_POST['video']);
				
				echo $_POST['video'].'<br><br>';
				echo $patern;
			}
			
			$this->prepareDataForEdit('poster',$_FILES['poster']['tmp_name'],ROOT."/views/images/" );
			$this->prepareDataForEdit('screen1',$_FILES['screen1']['tmp_name'],ROOT."/views/images/" );
			$this->prepareDataForEdit('screen2',$_FILES['screen2']['tmp_name'],ROOT."/views/images/" );
			$this->prepareDataForEdit('screen3',$_FILES['screen3']['tmp_name'],ROOT."/views/images/" );
			
			$_POST['genre'] = implode (',',$_POST['genre']);
			
			
			$id = $_POST['filmId'];
			unset($_POST['filmId']);
			unset($_POST['saveChange']);
			//var_dump($_POST);
			
			$this->model->updateFilm($_POST, $id);
			//header("Location: /film/".$id);
		}
		
		private function prepareDataForEdit($index, $source, $destination  )
		{
			if(!empty($source) )
			{	
				//$fileName = $this->model->getFieldValue($index, $_POST['filmId']);
				//unlink($destination.$fileName[$index]); //delete old file
				
				$_POST[$index] = $this->upload($source, $destination.$_FILES[$index]['name']);
				//var_dump($_POST);
			}
		
		}
		
		private function upload($source,$destination)
		{	
				//$regularWeb = '~[(http)|(//[a-z]+)]~';
				//$regularLocal = '~[a-z]:/~';
				//$regularTmpDir = '~php(.+).tmp~';
				//if(preg_match($regularTmpDir,$source))
				//{
				//	echo $destination.' <br>     ';
				if(!empty($source))
				{
					move_uploaded_file($source, $destination);
					return basename($destination);
				}
				//}
				//return $source;
		}
		
		
	}
	
	
	
	var_dump($_POST);
	if(isset($_POST['sendComent']))
	{  if(!empty($_POST['text']))
	  {
	    $mainController = new mainController();
	    $mainController->addComment();
	  }
	  else
	  {
	   header('Location: /film/'.$_POST['id_film']);
	  }
	}
	elseif(isset($_POST['saveChange']) && !empty($_POST))
	{
		if(!empty($_POST['video']))
		{	
			$_POST['video']= htmlspecialchars($_POST['video']);
		}
		$mainController = new mainController();
		$mainController->editFilm();
		
	}
	elseif(isset($_POST['addFilm'])&&!empty($_POST))
	{
	
	  $_POST['video']= htmlspecialchars($_POST['video']);
      $mainController = new mainController();
	  $mainController->addFilm();
	}
	