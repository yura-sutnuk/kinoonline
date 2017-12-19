<?php
	
	//include_once(ROOT."/components/DB.php");
	include_once ROOT.'/models/model.php';
	
	class FilmModel extends model
	{
		//private $connect;
		
		/*public function __construct(IConnection $IConnect)
		{
			$this->connect = $IConnect;
		}*/
		
		public function insertComment($id_user, $id_film, $text)
		{	
			echo $id_film;
		  $query = 'INSERT INTO comments (id_user, id_film, text, date) VALUES ("'.$id_user.'","'.$id_film.'","'.$text.'",now())';
		  echo $query;
		  $this->MyQuery($query);
		}
		
				public function getNextId()
		{
			$query = "SELECT AUTO_INCREMENT as AI FROM information_schema.TABLES WHERE TABLE_NAME = 'films'";
			return $this->MyQuery($query)[0]['AI'];
		}
		public function getAVGRating($id)
		{
			
			$query = 'SELECT avg(r.rating) as avgRating FROM rating r
					WHERE r.filmid="'.$id.'"';
					//var_dump($this->connect->MyQuery($query));
			return (!empty ($this->MyQuery($query)[0]['avgRating']))? $this->MyQuery($query)[0]['avgRating']: 0  ;
		}
		public function insertRating($filmid,$userid,$rating)
		{
			$query = 'INSERT INTO rating (filmid,userid,rating) VALUES ("'.$filmid.'","'.$userid.'","'.$rating.'")';
			$this->MyQuery($query);
		}
		public function updateRating($filmid,$userid,$rating)
		{
			$query = 'UPDATE rating SET rating="'.$rating.'" WHERE userid="'.$userid.'" AND filmid="'.$filmid.'"';
			$this->MyQuery($query);
		}
		public function getRating($userid,$filmid)
		{
			$query ='SELECT count(*) as count FROM rating WHERE userid="'.$userid.'" AND filmid="'.$filmid.'"';
			return $this->MyQuery($query)[0]['count'];
		}
		public function deleteRating($filmid)
		{
			$query = 'DELETE FROM rating WHERE filmid="'.$filmid.'"';
			$this->MyQuery($query);
		}
		
	


		
		public function getFilmsCount($where=array())
		{
			$query = 'select count(*) as count from films';
			if(!empty($where))
			{
				$query .= ' WHERE "'.key($where).'" LIKE "%'.current($where).'%"';
			}
			//var_dump($query);
			return $this->MyQuery($query)[0]['count'];
		}
		public function getFilmsOnPage($start,$end)
		{
			$query = 'SELECT * FROM films ORDER BY date DESC LIMIT '.$start.', '.$end;
		//	var_dump($query);
			return $this->MyQuery($query);
		}
		/*public function getFilmsList()		
		{		
				$query = "SELECT * FROM films ORDER BY date DESC";			
				$result = $this->MyQuery($query);
				return $result;	
		}*/

		public function deleteFilm($id)
		{
			$query = "DELETE FROM films WHERE id='".$id."'";
			//var_dump($query);
			$this->MyQuery($query);
		}
		public function addFilm($arr)
		{
	
			$query1='INSERT INTO films(';
			$query2=') VALUES (';
					
			$size = count($arr);
			for($i=0;$i<$size-1;$i++)
			{	
				$query1 .= '"'.key($arr).'",';
				$query2 .= '\''.current($arr).'\',';
				next($arr );
			}
	
			$query1 .= '"'.key($arr).'"';
			$query2 .= '\''.current($arr).'\'';
			
			return $result=$this->MyQuery($query1.$query2.')');
		}
		
		public function updateFilm($arr, $id)
		{
			$query = 'UPDATE films SET ';
			$size = count ($arr);
			for($i=0; $i<$size-1; $i++)
			{
				$query .= '"'.key($arr).'" ="'.current($arr).'", ';
				next($arr);
			}
			$query .= '"'.key($arr).'" ="'.current($arr).'" WHERE id= "'.$id.'"';
			return $this->MyQuery($query);
		}
		
		public function getCommentData($filmId)
		{
		$query = "SELECT comments.text, comments.date, users.login, users.avatar, users.id FROM comments, users ";
		$query .= "WHERE comments.id_film = '".$filmId."' AND users.id=comments.id_user";
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
			//var_dump($query);
			$result = $this->MyQuery($query);
			return $result;
		}
		public function getFilmsByName ($start,$end,$name)
		{
			$query='SELECT * FROM films WHERE name LIKE "%'.$name.'%" ORDER BY date DESC LIMIT '.$start.','.$end;
			//var_dump($query);
			return $this->MyQuery($query);
		}
/*
		public function getFieldValue($field, $where=[])
		{
			$query = "SELECT ".$field." FROM films";
			if(!empty($where))
			{
				foreach($where as $key=>$value)
				$query .= "WHERE ".$key."='".$value."',";
			}
			$query=substr($query,0,-1);
			var_dump($query);
			return $this->connect->MyQuery($query)[0];
		}*/

		/*public function getFieldsWhere($fields,$where=[])
		{
			$query = "SELECT ";
			
			foreach($fields as $field)
			{
				$query .= $this->connect->quote($field).',';
			}
			rtrim($query,',');
			
			if(!empty($where))
			{
				$query .= ' WHERE ';
				foreach($where as $field=>$value)
				{
					$query .= $this->connect->quote($field).'='.$this->connect->quote($value).',';
				}
				rtrim($query,',');
			}
			
			var_dump($query);
			$this->connect->query($query);
		}*/
		
		
	}