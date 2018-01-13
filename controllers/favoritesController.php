<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/const.php');
include_once(ROOT . "/models/favoritesModel.php");
include_once(ROOT."/controllers/globalFunctions.php");

class favoritesController extends globalFunctions
{
   // private $model;

    public function __construct()
    {
        $this->model = new favoritesModel();
    }

    public function actionAddFavorite($userId, $filmId)
    {
        $this->model->addFavorite($userId, $filmId);
    }

    public function actionDeleteFavorites($userId, $filmId)
    {
        $this->model->deleteFavorite($userId, $filmId);
    }

    //готовит данные и формирует html страницу
    public function actionGetFavorites($userId, $currentPage = 1)
    {
        //"избранное" не доступно если не выполнен вход
        if (!isset($_SESSION['id']))//если не выполнен вход
        {
            include ROOT . '/views/page404.php';
            return;
        }
        $this->linkHref = "favorites/" . $userId . '/';
        $count = $this->model->getFavoritesCount($_SESSION['id']);
        $pages = $this->getPages($count,FILMS_ON_PAGE, $currentPage);
        $movies = $this->selectFilmsOnPage($currentPage, $_SESSION['id']);
        foreach ($movies as $film)
        {
            $film['description'] = nl2br($film['description']);
        }

        $favoritesId = $this->model->getFavoritesFilmId($_SESSION['id']);
        $randFilm = $this->model->getRandomPoster();

        include_once(ROOT . '/views/main.php');

    }
    public function selectFilmsOnPage($currentPage, $userId)
    {
        $start = ($currentPage-1) *FILMS_ON_PAGE;
        $end = FILMS_ON_PAGE;
        return $this->model->getFavorites($start,$end,$userId);
    }

    /*
    currentPage - текущая страница
    fun - функция которую надо вызвать для выборки необходимых фильмов
    userId - используется в fun в условии WHERE

    функция вернет масив где:
    первый элемент - масив фильмов для текущей страницы
    второй элемент - общее число страниц
    */
    public function formPageFavorites($currentPage, $fun, $userId)
    {
        $count = $this->model->getFavoritesCount($userId);
        $pageCount = ceil($count / FILMS_ON_PAGE);
        $start = ($currentPage - 1) * FILMS_ON_PAGE;
        $end = FILMS_ON_PAGE;
        $result = $this->model->$fun($start, $end, $userId);
        $movies = [];

        foreach ($result as $film) {
            $film['genre'] = explode(',', $film['genre']);    //разделяем жанры
            $film['avgRating'] = $this->model->getAVGRating($film['id']);// получаем средний рейтинг
            $film['description'] = nl2br($film['description']);// заменяем перенос строки на <br>
            $movies[] = $film;
        }
        return array($movies, $pageCount);
    }

}

