<?php

	include_once ROOT.'/models/base/favorite.php';
	
	class FilmModel extends favorite 
	{	
		public function insertComment($id_user, $id_film, $text)
		{	
		  $query = 'INSERT INTO comments (id_user, id_film, text, date) VALUES ("'.$id_user.'","'.$id_film.'","'.$text.'",now())';
		  $this->MyQuery($query);
		}
		//получаем коментарии всех юзеров для данного фильма
		public function getCommentData($filmId)
		{
		$query = "SELECT comments.text, comments.date, users.login, users.avatar, users.id FROM comments, users ";
		$query .= "WHERE comments.id_film = '".$filmId."' AND users.id=comments.id_user";
		return $this->MyQuery($query);
		
		}
		//получает следующий id фильма
		public function getNextId()
		{
			$query = "SELECT AUTO_INCREMENT as AI FROM information_schema.TABLES WHERE TABLE_NAME = 'films'";
			return $this->MyQuery($query)[0]['AI'];
		}
		//получаем число фильмов удовлетворяющих условию $where (если не задано условие то всех фильмов)
		public function getFilmsCount($where=array())
		{
			$query = 'select count(*) as count from films';
			if(!empty($where))
			{
				$query .= ' WHERE '.key($where).' LIKE "%'.current($where).'%"';
			}
			return $this->MyQuery($query)[0]['count'];
		}
		public function getFilmsOnPage($start,$end)
		{
			$query = 'SELECT * FROM films ORDER BY date DESC LIMIT '.$start.', '.$end;
			return $this->MyQuery($query);
		}

		public function deleteFilm($id)
		{
			$query = "DELETE FROM films WHERE id='".$id."'";
			$this->MyQuery($query);
		}
		public function addFilm($arr)
		{
	
			$query1='INSERT INTO films(';
			$query2=') VALUES (';
					
			$size = count($arr);
			for($i=0;$i<$size-1;$i++)
			{	
				$query1 .= key($arr).',';
				$query2 .= '\''.current($arr).'\',';
				next($arr );
			}
	
			$query1 .= key($arr);
			$query2 .= '\''.current($arr).'\'';
			
			return $result=$this->MyQuery($query1.$query2.')');
		}
		
		public function updateFilm($arr, $id)
		{
			$query = 'UPDATE films SET ';
			$size = count ($arr);
			for($i=0; $i<$size-1; $i++)
			{
				$query .= key($arr).' ="'.current($arr).'", ';
				next($arr);
			}
			$query .= key($arr).' ="'.current($arr).'" WHERE id= "'.$id.'"';
			var_dump($query);
			return $this->MyQuery($query);
		}

		public function getFilmById($id)
		{
			$query = "SELECT * FROM films WHERE id='".$id."'";
			$result = $this->MyQuery($query);
			return $result;
		}
		public function getFilmByGenre($start,$end,$genre)
		{
			$query = 'SELECT * FROM films WHERE genre LIKE "%'.$genre.'%" ORDER BY date DESC LIMIT '.$start.','.$end;
			$result = $this->MyQuery($query);
			return $result;
		}
		public function getFilmsByName ($start,$end,$name)
		{
			$query='SELECT * FROM films WHERE name LIKE "%'.$name.'%" ORDER BY date DESC LIMIT '.$start.','.$end;
			return $this->MyQuery($query);
		}

	}