<?php
	
	include_once(ROOT."/components/DB.php");
	
	class FilmModel
	{
		private $connect;
		
		public function __construct(IConnection $IConnect)
		{
			$this->connect = $IConnect;
		}
	
		public function getFilmsList($fields=null, $limit=10)		
		{	
			if($fields==null)		
			{
				$query = "SELECT * FROM films ORDER BY date DESC";			
			}
			else
			{
				$query= 'SELECT';
				foreach($fields as $field )
				{
				$query .= $field.' ';
				}
				$query .= " FROM films ORDER BY date";
			}
			if($limit!=0)
			{
				$query .= " LIMIT ".$limit;
			}
			
				$result = $this->connect->MyQuery($query);
				return $result;		
		}
		public function deleteFilm($id)
		{
			$query = "DELETE FROM films WHERE id='".$id."'";
			//var_dump($query);
			$this->connect->MyQuery($query);
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
			
			return $result=$this->connect->MyQuery($query1.$query2.')');
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
			return $this->connect->MyQuery($query);
		}
		
		public function getCommentData($filmId)
		{
		$query = "SELECT comments.text, comments.date, users.login, users.avatar FROM comments, users ";
		$query .= "WHERE comments.id_film = ".$filmId." AND users.id=comments.id_user";
		return $this->connect->MyQuery($query);
		
		}
		
		
		public function getFilmById($id)
		{
			$query = "SELECT * FROM films WHERE id=$id";
			$result = $this->connect->MyQuery($query);
			return $result;
		}
		public function getFilmByGenre($genre)
		{
			$query = "SELECT * FROM films WHERE genre LIKE '".$genre."%'";
			$result = $this->connect->MyQuery($query);
			return $result;
		}
		public function getRandomPoster()
		{
			$query = 'SELECT poster,name,id FROM films WHERE id = '.$this->getRandomId();
			return $this->connect->MyQuery($query)[0];
		} 
		public function getFieldValue($field, $id)
		{
			$query = 'SELECT '.$field.' FROM films WHERE id=\''.$id.'\'';
			return $this->connect->MyQuery($query)[0];
		}
		private function getRandomId()
		{
			$query = 'SELECT id FROM films';
			$result =[];
			$result = $this->connect -> MyQuery($query);
			$result = $result[mt_rand(0,count($result)-1)]['id'];
			return $result;
		}
		
		
		
	}