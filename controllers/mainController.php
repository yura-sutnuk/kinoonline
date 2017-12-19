<?php

include ($_SERVER['DOCUMENT_ROOT'].'/const.php');
include_once(ROOT."/models/FilmModel.php");
include_once(ROOT."/controllers/globalFunctions.php");


	class mainController extends globalFunctions
	{	
		private $model;
		
		
		public function __construct ()
		{
			$this->model = new FilmModel ();//new PDOConnect()
		}
		public function formPage($currentPage,$fun,$param=array())
		{
			$filmsOnPage=1;
			$count = $this->model->getFilmsCount($param);    //getFieldsWhere( array('count(*)'));

			$pageCount = ceil($count/$filmsOnPage);
			$start = ($currentPage-1) *$filmsOnPage;
			$end = $filmsOnPage;
			$result = $this->model->$fun($start,$end,current($param));
			$movies = [];
			
			foreach ($result as $film)
			{
				$film['genre'] = explode(',', $film['genre']);	
				$movies[]=$film;
			}
			return array($movies, $pageCount);
		}

		public function actionMain( $currentPage = 1)
		{	
			$result = $this->formPage($currentPage,'getFilmsOnPage');
			$randFilm = $this->model->getRandomPoster();
			//getFieldsWhere
			$movies = $result[0];
			$pageCount = $result[1];
			//var_dump($_SERVER);

			
			foreach($movies as &$film)
			{
				$film['avgRating']=$this->model->getAVGRating($film['id']);
				$film['description']=nl2br($film['description']);
			}
			//var_dump($movies);
			$linkHref="";
			
			include ROOT.'/views/main.php';
			return true;
		}
		
		public function actionRating($filmid,$userid,$mark)
		{
			//var_dump($this->model->getRating($userid,$filmid));
			if($this->model->getRating($userid,$filmid)==0)
			{
				$this->model->insertRating($filmid,$userid,$mark);
			}
			else
			{
				$this->model->updateRating($filmid,$userid,$mark);
			}
			
		}
		
		public function actionGenre($genre,$currentPage=1)
		{
			$linkHref="genre/".$genre.'/';
			$genre = GENRE_LIST[$genre];
			$result = $this->formPage($currentPage,'getFilmByGenre',array('genre'=>$genre));
			$randFilm = $this->model->getRandomPoster();
			
			
			//$result = $this->FormPage($filmsList,$currentPage);
			
			$movies = $result[0];
			$pageCount = $result[1];
			foreach($movies as &$film)
			{
				$film['avgRating']=$this->model->getAVGRating($film['id']);
				$film['description']=nl2br($film['description']);
			}
			
			include ROOT.'/views/main.php';
			//$this->formPage('getFilmsList',$genre,$currentPage);

			return true;
		}
		
		public function actionFilm ($id, $param='')
		{  
		    //$link = new PDOConnect();
			//$modelObj = new FilmModel($link);
		/*				foreach($_SERVER as $k=>$v)
			{
				echo $k.'='.$v.'<br>';
			}*/
			$commentData = $this->model->getCommentData($id);
			//echo '<br>$id = '.$id.'<br>';
			$filmData = $this->model ->getFilmById($id)[0];
			$filmData['avgRating']=$this->model->getAVGRating($id);
			//var_dump($filmData['avgRating']);
			$filmData["genre"]= explode(',', $filmData["genre"]);
			$randFilm = $this->model->getRandomPoster();

			$filmData['description']=nl2br($filmData['description']);
			include ROOT.'/views/film.php';		
			return true;
		}
        
		public function addComment()
		{
		  include ROOT."/models/commentModel.php";
		  session_start();
		 // $commentModel = new commentModel(new PDOConnect());
		 var_dump($_POST['id_film']);
		  $this->model->insertComment($_SESSION['id'], $_POST['id_film'], $_POST['text']);
		  header('Location: /film/'.$_POST['id_film']);
		}
		
		public function actionFilmEdit($id, $param='')
		{
			if(!isset($_SESSION['login']) || $_SESSION['login']!='Admin')
			{
				header('location: /');
				//include ROOT.'/views/page404.php';
			//	return;
			}
			//$link = new PDOConnect();
			//$modelObj = new FilmModel($link);
			
			$commentData = $this->model->getCommentData($id);		
			
			$filmData = $this->model ->getFilmById($id)[0];
			$filmData["genre"]= explode(',', $filmData["genre"]);
			$randFilm = $this->model->getRandomPoster();
			
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
				//$_POST['video'] = preg_replace('~src="([0-9a-z/.]*)"~', '$1' , $_POST['video']);
				/*$_POST['poster'] = $this->upload($_FILES['poster']['tmp_name'],ROOT."/views/images/".$_FILES['poster']['name']);
				$_POST['screen1'] = $this->upload($_FILES['screen1']['tmp_name'],ROOT."/views/images/".$_FILES['screen1']['name']);
				$_POST['screen2'] = $this->upload($_FILES['screen2']['tmp_name'],ROOT."/views/images/".$_FILES['screen2']['name']);
				$_POST['screen3'] = $this->upload($_FILES['screen3']['tmp_name'],ROOT."/views/images/".$_FILES['screen3']['name']);
				*/
				//mkdir(ROOT.'/views/images/'.$_POST['name']);
				$nextId = $this->model->getNextId();
				$_POST['video'] = $this->getSource($_POST['video']);
				$_POST['poster'] = $this->upload('poster',ROOT."/views/images/",$nextId.'_1');
				$_POST['screen1'] = $this->upload('screen1',ROOT."/views/images/",$nextId.'_2');
				$_POST['screen2'] = $this->upload('screen2',ROOT."/views/images/",$nextId.'_3');
				$_POST['screen3'] = $this->upload('screen3',ROOT."/views/images/",$nextId.'_4');
				
				
				$_POST['genre'] = implode (',',$_POST['genre']);
				//print_r($_POST);
				unset($_POST['addFilm']);
				//$objModel = new FilmModel (new PDOConnect());
				//echo'22';
				$this->model->addFilm($_POST);
				//echo "“спешное добавление фильма";
				//echo"11";
				  //include ROOT."/views/add.php";
				header('Location: /add/');
		}
		
		public function actionFilmDelete($id)
		{
			//$modelObj = new FilmModel(new PDOConnect());
			$this->model->deleteRating($id);
			$this->model->deleteComments($id);
			$this->model->deleteFilm($id);
			header('Location: /');// dirname($_SERVER['HTTP_REFERER']);
		}
		
		public function editFilm()
		{	

			//$link = new PDOConnect();
			//$this->model = new FilmModel($link);
			$id = $_POST['filmId'];
			unset($_POST['filmId']);
			unset($_POST['saveChange']);
			
			if(!empty($_POST['video']))
			{			
				$_POST['video'] = $this->getSource($_POST['video']);
			}
			
			//$this->prepareDataForEdit('poster',$_FILES['poster']['tmp_name'],ROOT."/views/images/" );
			//$this->prepareDataForEdit('screen1',$_FILES['screen1']['tmp_name'],ROOT."/views/images/" );
			//$this->prepareDataForEdit('screen2',$_FILES['screen2']['tmp_name'],ROOT."/views/images/" );
			//$this->prepareDataForEdit('screen3',$_FILES['screen3']['tmp_name'],ROOT."/views/images/" );
			
		//var_dump($_FILES);
			$this->prepareDataForEdit('poster',ROOT."/views/images/" );
			$this->prepareDataForEdit('screen1',ROOT."/views/images/" );
			$this->prepareDataForEdit('screen2',ROOT."/views/images/" );
			$this->prepareDataForEdit('screen3',ROOT."/views/images/" );
			/*$_POST['poster'] = $this->upload('poster', ROOT."/views/images/",$id.'_1');
			$_POST['screen1'] = $this->upload('screen1', ROOT."/views/images/",$id.'_2');
			$_POST['screen2'] = $this->upload('screen2', ROOT."/views/images/",$id.'_3');
			$_POST['screen3'] = $this->upload('screen3', ROOT."/views/images/",$id.'_4');*/
			
			$_POST['genre'] = implode (',',$_POST['genre']);
			
			
			
			//var_dump($_POST);
			
			$this->model->updateFilm($_POST, $id);
			header("Location: /film/".$id.'/');
		}
		
		private function getSource ($str)
		{
				$patern = '/(((\/\/)|(\\\\\\\\))+[\w\d:#@%\/;$()~_?\+-=\\\\\.&]*)/i';
				preg_match($patern, $str , $matches, PREG_OFFSET_CAPTURE, 0);
				//$str = $matches[0][0];
				//$_POST['video'] = substr($str,0,-6);
				return substr($matches[0][0] ,0,-6);
		}
		
		private function prepareDataForEdit($index, $destination,$newName=''  )
		{
			if(!empty($_FILES[$index]['tmp_name']) )
			{	var_dump($_FILES[$index]);
				$_POST[$index] = $this->upload($index, $destination, $newName);
			}
		
		}
		
		public function searchFilmByName($currentPage=1)
		{			
			session_start();
			$_SESSION['search']=$_POST['search'];
			header('Location: /search/');
		}
		public function actionSearch($currentPage=1)
		{
			$name=$_SESSION['search'];
			$result = $this->formPage($currentPage,'getFilmsByName',array('name'=>$name));
			$randFilm = $this->model->getRandomPoster();
			
			$movies = $result[0];
			$pageCount = $result[1];
			foreach($movies as &$film)
			{
				$film['avgRating']=$this->model->getAVGRating($film['id']);
				$film['description']=nl2br($film['description']);
			}
			$linkHref='search/';
			include ROOT.'/views/main.php';
		}
	}
	
	
	
	//var_dump($_POST);
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
	elseif(isset($_POST['search']))
	{
		$mainController = new mainController();
		$mainController->searchFilmByName();
	}
	