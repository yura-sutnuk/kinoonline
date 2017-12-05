<?php

include ($_SERVER['DOCUMENT_ROOT'].'/const.php');
include_once(ROOT."/models/FilmModel.php");


	class mainController
	{

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
		    //include ROOT."/models/commentModel.php"; 
			//include ROOT."/models/userModel.php";
			
		    $link = new PDOConnect();
			$modelObj = new FilmModel($link);
			//$commentModel = new commentModel($link);
			//$userModel = new userModel($link);
			$commentData = $modelObj->getCommentData($id);
			//$commentList = $commentModel->selectAllComment($id);
		    //var_dump($commentData);
			
			
			$filmData = $modelObj ->getFilmById($id)[0];
			$filmData["genre"]= explode(',', $filmData["genre"]);
			$randFilm = $modelObj->getRandomPoster();
			//var_dump($filmData);
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
			//$filmData["genre"]= explode(',', $filmData["genre"]);
			$randFilm = $modelObj->getRandomPoster();
			//var_dump($filmData);
			include ROOT.'/views/filmEdit.php';
		}
		
		
	}
	
	
	
	
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
	