<?php
	
	include_once(ROOT."/components/DB.php");
	
	class BDModel
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
		
		public function addFilm($arr)
		{
			$query1='INSERT INTO films(';
			$query2=') VALUES (';
			
			foreach($arr as $field => $value)
			{	
				if($field==='description')
				{
				$query1 .= $field;

					$query2 .= '\''.$value.'\'';
					break;
				}
				$query1 .= $field.',';
				$query2 .= '\''.$value.'\',';
			}
			
			var_dump($query1.$query2.')');
			return $result=$this->connect->MyQuery($query1.$query2.')');
		}
		
		
	/*	public function getFilmById($id)
		{
			$query = "SELECT * FROM films WHERE id=$id";
			$result = $this->connect->MyQuery($query);
			return $result;
		}*/
		public function getRandomPoster()
		{
			$query = 'SELECT poster,name FROM films WHERE id = '.$this->getRandomId();
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