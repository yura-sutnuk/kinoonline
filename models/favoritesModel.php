<?php

include_once ROOT.'/models/base/favorite.php';
//include_once ROOT.'/models/model.php';

class favoritesModel extends favorite
{
    //добавить в избранное
    public function addFavorite($userId,$filmId)
    {
        $query = 'INSERT INTO favorites (userId,filmId) VALUES ("'.$userId.'","'.$filmId.'")';
        $this->MyQuery($query);

    }
    //удалить из избранного
    public function deleteFavorite($userId,$filmId)
    {
        $query = 'DELETE FROM favorites WHERE userId = "'.$userId.'" AND filmId ="'.$filmId.'"';
        $this->MyQuery($query);
    }
    //получить избранные фильмы
    public function getFavorites($start,$end,$userId)
    {
        $query = 'SELECT DISTINCT film.*, (SELECT AVG(rating) FROM rating WHERE filmId=film.id)  AS avgRating FROM favorites fav ,films film 
			WHERE fav.userId ="'.$userId.'" AND film.id=fav.filmId LIMIT '.$start.','.$end;
        return $this->MyQuery($query);
    }
    //получить сколько всего фильмов в избранном
    public function getFavoritesCount($userId)
    {
        $query = 'SELECT  count( DISTINCT filmId) as count FROM favorites WHERE userId = "'.$userId.'"';
        return $this->MyQuery($query)[0]['count'];
    }
}