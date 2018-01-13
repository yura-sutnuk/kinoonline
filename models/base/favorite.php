<?php
		
	include_once ROOT.'/models/base/rating.php';
	//содержит функции для работы с избранным необходимые в mainController и FilmModel
	abstract class favorite extends rating
	{
		public function getFavoritesFilmId($userId)
		{
			$query = 'SELECT filmId as id FROM favorites WHERE userId="'.$userId.'"';
			return $this->MyQuery($query,PDO::FETCH_COLUMN);
		}
		public function deleteFavoriteWhereFilm($filmId)
		{
			$query = 'DELETE FROM favorites WHERE filmId="'.$filmId.'"';
			$this->MyQuery($query);
		}


	}