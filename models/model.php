<?php

class model
{
	protected $connect;
	
	public function __construct()
	{
		$seting = include_once(ROOT.'/components/DBSeting.php');
		$this->connect = new PDO("mysql:host={$seting['host']};dbname={$seting['database']}", $seting['user'], $seting['password'],array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	}
	public  function MyQuery(string $query)
		{
		  // var_dump($query);
			//$query = $this->PDOlink->quote($query);
			//var_dump($query);
			$result = $this->connect->query($query);
			//var_dump( $this->PDOlink);
		
			//if(is_array($result))
			$result->setFetchMode(PDO::FETCH_ASSOC);
			return $result->fetchAll();
			
		}
	
	public function deleteComments($id_film)
	{
		$query = 'DELETE FROM comments WHERE id_film ="'.$id_film.'"';
		$this->connect->MyQuery($query);
	}
	private function getRandomId()
	{
			$query = 'SELECT id FROM films';
			$result =[];
			$result = $this -> MyQuery($query);
			$result = $result[mt_rand(0,count($result)-1)]['id'];
			return $result;
	}
	public function getRandomPoster()
	{
			$query = 'SELECT poster,name,id FROM films WHERE id = '.$this->getRandomId();
			return $this->MyQuery($query)[0];
	} 
}