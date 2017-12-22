<?php

include_once ($_SERVER['DOCUMENT_ROOT'].'/const.php');
include_once(ROOT."/models/favoritesModel.php");

class favoritesController 
{
	private $model;
	
	public function __construct ()
	{
		$this->model = new favoritesModel ();
	}
	
	public function actionAddFavorite($userId,$filmId)
	{
		$this->model->addFavorite($userId,$filmId);
	}
	public function actionDeleteFavorites($userId,$filmId)
	{
		$this->model->deleteFavorite($userId,$filmId);
	}
	//готовит данные и формирует html страницу
	public function actionGetFavorites($userId,$currentPage=1)
	{
		//"избранное" не доступно если не выполнен вход
		if(!isset($_SESSION['id']))//если не выполнен вход
		{
			include ROOT.'/views/page404.php';
			return;
		}
		//расчитать максимальное количество страниц и выбрать фильмы для текущей страницы
		$result = $this->formPageFavorites($currentPage,'getFavorites',$_SESSION['id']);
		$movies = $result[0];
		$pageCount = $result[1];
		//favoritesId - масив id всех фильмов что занесены в избранное
		//используется для проверки того находится ли фильм в списке избранного
		$favoritesId = $this->model->getFavoritesFilmId($_SESSION['id']);
		$randFilm = $this->model->getRandomPoster();
		//адрес для перехода между страницами
		$linkHref="favorites/".$userId.'/';
		include_once(ROOT.'/views/main.php');
	
	}
	/*
	currentPage - текущая страница
	fun - функция которую надо вызвать для выборки необходимых фильмов
	userId - используется в fun в условии WHERE
	
	функция вернет масив где:
	первый элемент - масив фильмов для текущей страницы
	второй элемент - общее число страниц
	*/
	public function formPageFavorites($currentPage,$fun,$userId)
	{
		$count = $this->model->getFavoritesCount($userId);    
		$pageCount = ceil($count/FILMS_ON_PAGE);
		$start = ($currentPage-1) *FILMS_ON_PAGE;
		$end = FILMS_ON_PAGE;
		$result = $this->model->$fun($start,$end,$userId);
		$movies = [];
		
		foreach ($result as $film)
		{
			$film['genre'] = explode(',', $film['genre']);	//разделяем жанры
			$film['avgRating']=$this->model->getAVGRating($film['id']);// получаем средний рейтинг
			$film['description']=nl2br($film['description']);// заменяем перенос строки на <br>
			$movies[]=$film;
		}
		return array($movies, $pageCount);
	}
		
}

