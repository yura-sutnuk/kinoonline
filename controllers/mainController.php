<?php

include_once ($_SERVER['DOCUMENT_ROOT'].'/const.php');
include_once(ROOT."/models/FilmModel.php");
include_once(ROOT."/controllers/globalFunctions.php");
//include_once(ROOT."/models/favorite.php");


class mainController extends globalFunctions
{	
	private $model;
		
		
	public function __construct ()
	{
		$this->model = new FilmModel ();
	}
	// функция обновляет или добавляет оценку для рейтинга фильма	
	public function actionRating($filmid,$userid,$mark)
	{
		if($this->model->getRating($userid,$filmid)==0)//если юзер еще не оценивал фильм
		{
			$this->model->insertRating($filmid,$userid,$mark);//добвить оценку
		}
		else//иначе если юзер уже поставил оценку
		{
			$this->model->updateRating($filmid,$userid,$mark);//обновить оценку
		}
		//отослать ответ сервера с новым средним рейтингом	
		echo $this->model->getAVGRating($filmid);
	}
	/*
	currentPage - текущая страница
	fun - функция которую надо вызвать для выборки необходимых фильмов
	where - если задано используется в getFilmsCount в условии WHERE где ключ - поле, а значение- используется с LIKE 
	
	функция вернет масив где:
	первый элемент - масив фильмов для текущей страницы
	второй элемент - общее число страниц
	*/
	public function formPage($currentPage,$fun,$where=array())
	{
		$count = $this->model->getFilmsCount($where);    
		$pageCount = ceil($count/FILMS_ON_PAGE);
		$start = ($currentPage-1) *FILMS_ON_PAGE;
		$end = FILMS_ON_PAGE;
		$result = $this->model->$fun($start,$end,current($where));//функции расчитаны лишь на прием значения для WHERE условия
		$movies = [];
		foreach ($result as $film)
		{
			$film['genre'] = explode(',', $film['genre']);//разделяем жанры в масив	
			$film['avgRating']=$this->model->getAVGRating($film['id']);//получаем средний рейтинг
			$film['description']=nl2br($film['description']);//заменяем перевод строки на <br>
			$movies[]=$film;
		}
		return array($movies, $pageCount);
	}
		//формирует главную страницу
		public function actionMain( $currentPage = 1)
		{	
			//расчитать максимальное количество страниц и выбрать фильмы для текущей страницы с помощью функции getFilmsOnPage
			$result = $this->formPage($currentPage,'getFilmsOnPage');
			$randFilm = $this->model->getRandomPoster();
			$movies = $result[0];
			$pageCount = $result[1];
			if(isset($_SESSION['id']))//если выполнен вход
			{
				//получаем id фильмов которые занесены в избранное для данного пользователя
				$favoritesId = $this->model->getFavoritesFilmId($_SESSION['id']);
			}
			//адрес для перехода между страницами (пустой для главной страницы)
			$linkHref="";
			include ROOT.'/views/main.php';
			return true;
		}
		
		
		//формирует страницу с фильмами которые содержат жанр genre (genre = название жанра транслитом)
		public function actionGenre($genre,$currentPage=1)
		{
			//получаем русский вариант жанра
			$genre = GENRE_LIST[$genre];
			
			$result = $this->formPage($currentPage,'getFilmByGenre',array('genre'=>$genre));
			$randFilm = $this->model->getRandomPoster();
			
			$movies = $result[0];
			$pageCount = $result[1];
			if(isset($_SESSION['id']))//если выполнен вход
			{
				//получаем id фильмов которые занесены в избранное для данного пользователя
				$favoritesId = $this->model->getFavoritesFilmId($_SESSION['id']);
			}
			
			$linkHref="genre/".$genre.'/';
			include ROOT.'/views/main.php';
			return true;
		}
		//формирует страницу для просмотра фильма
		// id - id фильма
		public function actionFilm ($id)
		{  
			//получаем коментарии для данного фильма
			$commentData = $this->model->getCommentData($id);
			//получаем данные о фильме
			$filmData = $this->model ->getFilmById($id)[0];
			$filmData['avgRating']=$this->model->getAVGRating($id);
			$filmData["genre"]= explode(',', $filmData["genre"]);
			
			$randFilm = $this->model->getRandomPoster();
			
			if(isset($_SESSION['id']))//если выполнен вход
			{
				//получаем id фильмов которые занесены в избранное для данного пользователя
				$favoritesId = $this->model->getFavoritesFilmId($_SESSION['id']);
			}

			$filmData['description']=nl2br($filmData['description']);
			include ROOT.'/views/film.php';		
			return true;
		}
        //добавляет коментарий в БД
		public function addComment()
		{
		  session_start();//без него могли возникать проблемы с доступом к $_SESSION
		  $this->model->insertComment($_SESSION['id'], $_POST['id_film'], $_POST['text']);
		  header('Location: /film/'.$_POST['id_film']);
		}
		//формирует страницу для редактирования фильма
		public function actionFilmEdit($id)
		{
			//если пользователь не админ 
			if($_SESSION['login']!='Admin')
			{
				//вернуть его на главную страницу
				header('location: /');
			}		
			$filmData = $this->model ->getFilmById($id)[0];
			$filmData["genre"]= explode(',', $filmData["genre"]);
			
			$randFilm = $this->model->getRandomPoster();
			include ROOT.'/views/filmEdit.php';
		}
		//формирует страницу для добавления фильма
		public function actionAdd()
		{
			//если пользователь не админ
		  if($_SESSION['login']!='Admin')
			{	//выбить 404 страницу
				include ROOT.'/views/page404.php';
				return false;
			}	
			
			include_once ROOT."/views/add.php";
			return true;
		}
		//функция для добавления фильма в БД
		public function addFilm()
		{		
				
				$nextId = $this->model->getNextId();
				//из ссылки на источник получаем src на видео
				$_POST['video'] = $this->getSource($_POST['video']);
				//загружаем изображения на сервер
				$_POST['poster'] = $this->upload('poster',ROOT."/views/images/",$nextId.'_1');
				$_POST['screen1'] = $this->upload('screen1',ROOT."/views/images/",$nextId.'_2');
				$_POST['screen2'] = $this->upload('screen2',ROOT."/views/images/",$nextId.'_3');
				$_POST['screen3'] = $this->upload('screen3',ROOT."/views/images/",$nextId.'_4');
				
				
				$_POST['genre'] = implode (',',$_POST['genre']);
				unset($_POST['addFilm']);
				$this->model->addFilm($_POST);
				header('Location: /addmovie/');
		}
		//удаляет фильм
		public function actionFilmDelete($id)
		{
			//удаляем все что ссылается на этот фильм в БД
			$this->model->deleteRating($id);
			$this->model->deleteComments($id);
			$this->model->deleteFavoriteWhereFilm($id);
			
			$this->model->deleteFilm($id);
			header('Location: /');
		}
		//обновляет данные о фильме в БД 
		public function editFilm()
		{	

			$id = $_POST['filmId'];
			unset($_POST['filmId']);
			unset($_POST['saveChange']);
			
			if(!empty($_POST['video']))
			{			
				$_POST['video'] = $this->getSource($_POST['video']);
			}
			//загружаем файлы на сервер
			$this->prepareDataForEdit('poster',ROOT."/views/images/",$id.'_1' );
			$this->prepareDataForEdit('screen1',ROOT."/views/images/",$id.'_2' );
			$this->prepareDataForEdit('screen2',ROOT."/views/images/",$id.'_3' );
			$this->prepareDataForEdit('screen3',ROOT."/views/images/",$id.'_4' );
			
			$_POST['genre'] = implode (',',$_POST['genre']);

			$this->model->updateFilm($_POST, $id);
			header("Location: /film/".$id.'/');
		}
		private function prepareDataForEdit($index, $destination,$newName=''  )
		{
			//если пользователь указал новое изображение
			if(!empty($_FILES[$index]['tmp_name']) )
			{	//загрузить файлы на сервер и получить новое имя файла
				$_POST[$index] = $this->upload($index, $destination, $newName);
			}
		
		}
		//получает src из ссылки на видео
		private function getSource ($str)
		{
			
			$patern = '/(((\/\/)|(\\\\\\\\))+[\w\d:#@%\/;$()~_?\+-=\\\\\.&]*)/i';
			preg_match($patern, $str , $matches, PREG_OFFSET_CAPTURE, 0);
			//после иъятия src остается кавычка которая удаляется substr 
			//-6 потому что кавычка это спец символ html
			return substr($matches[0][0] ,0,-6); 
		}
		//при выполнении POST переадресация через .htsccess не проходит
		//и в адресной строке останется не верный адрес, функция заменяет адрес на search/
		public function searchFilmByName($currentPage=1)
		{			
			session_start();
			//в $_SESSION['search'] заносится критерий поиска (название фильма) для сохранения при переходе 
			$_SESSION['search']=$_POST['search'];
			header('Location: /search/');//активирует функцию actionSearch
		}
		//выполняет поиск фильмов по указаному имени (имя хранится в $_SESSION['search'])
		public function actionSearch($currentPage=1)
		{
			$name=$_SESSION['search'];
			//расчитать максимальное количество страниц и выбрать фильмы для текущей страницы с помощью функции getFilmsByName
			//где name %LIKE% $name
			$result = $this->formPage($currentPage,'getFilmsByName',array('name'=>$name));
			$movies = $result[0];
			$pageCount = $result[1];
			$randFilm = $this->model->getRandomPoster();
			if(isset($_SESSION['id']))//если выполнен вход
			{
				$favoritesId = $this->model->getFavoritesFilmId($_SESSION['id']);
			}
			//адрес для перехода между страницами с фильмами
			$linkHref='search/';
			include ROOT.'/views/main.php';
		}
	}
	
	
	//если пользователь отправил коментарий
	if(isset($_POST['sendComent']))
	{  
		//если коментарий не пустой
		if(!empty($_POST['text']))
		  {
			$mainController = new mainController();
			$mainController->addComment();//добавить его в БД
		  }
		  else//иначе вернуть назад к фильму
		  {
		   header('Location: /film/'.$_POST['id_film']);
		  }
	}
	//если пользователь обновил данные фильма
	elseif(isset($_POST['saveChange']) && !empty($_POST))
	{
		//если было изменено видео 
		if(!empty($_POST['video']))
		{	
			
			$_POST['video']= htmlspecialchars($_POST['video']);
		}
		$mainController = new mainController();
		$mainController->editFilm();
		
	}
	//если пользователь добавил фильм
	elseif(isset($_POST['addFilm'])&&!empty($_POST))
	{
	
	  $_POST['video']= htmlspecialchars($_POST['video']);
      $mainController = new mainController();
	  $mainController->addFilm();
	}
	//если пользователь ищет фильм по имени
	elseif(isset($_POST['search']))
	{
		$mainController = new mainController();
		$mainController->searchFilmByName();
	}
	