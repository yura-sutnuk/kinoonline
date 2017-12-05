<?php

	include_once(ROOT."/components/DB.php");
	
	class commentModel
	{
		private $connect;
		
		public function __construct(IConnection $IConnect)
		{
			$this->connect = $IConnect;
		}
		
		public function insertComment($id_user, $id_film, $text)
		{
		  $query = "INSERT INTO comments (id_user, id_film, text, date) VALUES ('".$id_user.'\',\''.$id_film.'\',\''.$text.'\',now())';
		  echo $query;
		  $this->connect->MyQuery($query);
		}
		/*public function selectAllCommentToFilm($film_id)
		{
		  $query = "SELECT * FROM comments WHERE id_film='".$film_id."'";
		  return $this->connect->MyQuery($query)[0];
		}*/
		
	}