<?php

include_once ($_SERVER['DOCUMENT_ROOT'].'/const.php');
include_once(ROOT."/models/FilmModel.php");
include_once(ROOT."/controllers/globalFunctions.php");
//include_once(ROOT."/models/favorite.php");

class mainController extends globalFunctions
{
    //private $model;

    public function __construct ()
    {
        $this->model = new FilmModel ();
    }
    // функция обновляет или добавляет оценку для рейтинга фильма
    public function actionRating($filmid, $userid, $mark)
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

    //формирует главную страницу
    public function actionMain( $currentPage = 1)
    {
        //адрес для перехода между страницами (пустой для главной страницы)
        $this->linkHref="";
        $count = $this->model->getFilmsCount();
        $pages = $this->getPages($count,FILMS_ON_PAGE, $currentPage);
        $movies = $this->selectFilmsOnPage($currentPage);
        foreach ($movies as $film)
        {
            $film['description'] = nl2br($film['description']);
        }
        $randFilm = $this->model->getRandomPoster();
        if(isset($_SESSION['id']))//если выполнен вход
        {
            //получаем id фильмов которые занесены в избранное для данного пользователя
            $favoritesId = $this->model->getFavoritesFilmId($_SESSION['id']);
        }

        include ROOT.'/views/main.php';
        return true;
    }
    public function selectFilmsOnPage($currentPage, $where = ['id' => ''])
    {
        $start = ($currentPage-1) *FILMS_ON_PAGE;
        $end = FILMS_ON_PAGE;
        return $this->model->getFilmsOnPage($start,$end,$where);
    }

    //формирует страницу с фильмами которые содержат жанр genre (genre = название жанра транслитом)
    public function actionGenre($genre,$currentPage=1)
    {
        $this->linkHref = "genre/".$genre.'/';

        //получаем русский вариант жанра
        $genre = GENRE_LIST[$genre];
        $count = $this->model->getFilmsCount(['genre' => $genre]);
        $pages = $this->getPages($count,FILMS_ON_PAGE, $currentPage);

        $movies = $this->selectFilmsOnPage($currentPage, ['genre'=>$genre]);
        foreach ($movies as $film)
        {
            $film['description'] = nl2br($film['description']);
        }
        $randFilm = $this->model->getRandomPoster();

        if(isset($_SESSION['id']))//если выполнен вход
        {
            //получаем id фильмов которые занесены в избранное для данного пользователя
            $favoritesId = $this->model->getFavoritesFilmId($_SESSION['id']);
        }


        include ROOT.'/views/main.php';

    }
    //при выполнении POST переадресация через .htsccess не проходит
    //и в адресной строке останется не верный адрес, функция заменяет адрес на search/
    public function searchFilmByName($currentPage=1)
    {
        session_start();
        //в $_SESSION['search'] заносится критерий поиска (название фильма) для сохранения
        $_SESSION['search']=$_POST['search'];
        header('Location: /search/');//активирует функцию actionSearch
    }
    //выполняет поиск фильмов по указаному имени (имя хранится в $_SESSION['search'])
    public function actionSearch($currentPage=1)
    {
        $name=$_SESSION['search'];
        $this->linkHref='search/';
        $count = $this->model->getFilmsCount(['name' => $name]);
        $pages = $this->getPages($count,FILMS_ON_PAGE, $currentPage);
        $movies = $this->selectFilmsOnPage($currentPage, ['name'=>$name]);

        foreach ($movies as $film)
        {
            $film['description'] = nl2br($film['description']);
        }

        $randFilm = $this->model->getRandomPoster();
        if(isset($_SESSION['id']))//если выполнен вход
        {
            $favoritesId = $this->model->getFavoritesFilmId($_SESSION['id']);
        }
        //адрес для перехода между страницами с фильмами

        include ROOT.'/views/main.php';
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
        //$filmData["genre"]= explode(',', $filmData["genre"]);
        $filmData['series'] = $this->model->getSeries($id);
        $filmData['totalSeries'] = count($filmData[series]);
        //var_dump($filmData['series']);
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
        $filmData['series'] = $this->model->getSeries($id);

        $filmData['totalSeries'] = count($filmData['series']);
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
        $newVideo[] = $this->getSource($_POST['video']);
        $newVideoName[] = $_POST['videoName'];
        unset($_POST['videoName']);
        unset($_POST['video']);
        //загружаем изображения на сервер
        $_POST['poster'] = $this->upload('poster',ROOT."/views/images/",$nextId.'_1');
        $_POST['screen1'] = $this->upload('screen1',ROOT."/views/images/",$nextId.'_2');
        $_POST['screen2'] = $this->upload('screen2',ROOT."/views/images/",$nextId.'_3');
        $_POST['screen3'] = $this->upload('screen3',ROOT."/views/images/",$nextId.'_4');


        $_POST['genre'] = implode (' ',$_POST['genre']);
        unset($_POST['addFilm']);
        //var_dump($_POST);
        $filmId = $this->model->addFilm($_POST);
        $this->model->addSeries($filmId,$newVideo,$newVideoName);
        header('Location: /film/'.$filmId.'/');
    }
    //удаляет фильм
    public function actionFilmDelete($id)
    {
        //удаляем все что ссылается на этот фильм в БД
        $this->model->deleteRating($id);
        $this->model->deleteComments($id);
        $this->model->deleteFavoriteWhereFilm($id);
        $this->model->deleteAllSeries($id);
        //и удаляем сам фильм
        $this->model->deleteFilm($id);
        header('Location: /');
    }
    public function deleteSeries()
    {
        $this ->model->deleteSeries($_POST['seriesId']);
        header('location: /edit/'.$_POST['filmId']);
    }
    //обновляет данные о фильме в БД
    public function editFilm()
    {

        $id = $_POST['filmId'];
        //Обрабатываем новые серии
        if(isset($_POST['addvideo']))
        {
            //заносим серии в другие переменные поскольку обрабатываются они другим запросом
            $newVideo = $_POST['addvideo'];
            $newVideoName = $_POST['namevideo'];
            //и удаляем со старой
            unset($_POST['addvideo']);
            unset($_POST['namevideo']);
            //достаем ссылку на видео для каждой серии
            foreach ($newVideo as &$video)
            {
                $video = htmlspecialchars($video);
                $video = $this->getSource($video);
            }
        }

        unset($_POST['filmId']);
        unset($_POST['saveChange']);
        //обрабатываем обновленную информацию о серии
        if(!empty($_POST['video']) && !empty($_POST['videoName']))
        {
            //получаем новую ссылку на видео
            $editSeries = $this->getSource($_POST['video']);
            //новое название серии
            $editSeriesName = $_POST['videoName'];
            // и id серии
            $editSeriesId = $_POST['seriesId'];

        }
        unset($_POST['video']);
        unset($_POST['videoName']);
        unset($_POST['seriesId']);


        //загружаем файлы на сервер
        $this->prepareDataForEdit('poster',ROOT."/views/images/",$id.'_1' );
        $this->prepareDataForEdit('screen1',ROOT."/views/images/",$id.'_2' );
        $this->prepareDataForEdit('screen2',ROOT."/views/images/",$id.'_3' );
        $this->prepareDataForEdit('screen3',ROOT."/views/images/",$id.'_4' );

        $_POST['genre'] = implode (',',$_POST['genre']);

        $this->model->updateFilm($_POST, $id);
        //добавляем новые серии
        if(isset($newVideo))
        {
            $this->model->addSeries($id,$newVideo,$newVideoName);
        }
        //обновляем старую
        if(isset($editSeriesName))
        {
            $this->model->updateSeries($editSeriesId,$editSeriesName,$editSeries);
        }

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
	//если пользователь удаляет серию
	elseif(isset($_POST['deleteSeries']))
	{
		$mainController = new mainController();
		$mainController->deleteSeries();
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
