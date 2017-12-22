<?php

//основной класс модели, содержит функции необходимые для каждой модели
class model
{
	protected $connect;
	
	public function __construct()
	{
		$seting = include_once(ROOT.'/components/DBSeting.php');
		try
		{
			$this->connect = new PDO("mysql:host={$seting['host']};dbname={$seting['database']}", $seting['user'], $seting['password'],array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
		}
		catch(Exception $ex)
		{
			die('Error: '.$ex->getMessage().'<br>');
			
		}
	}
	//выполняет запрос к БД и получает данные (для SELECT)
	public  function MyQuery(string $query,$fetchColumn=false)
	{
		$result = $this->connect->query($query);
		$result->setFetchMode(PDO::FETCH_ASSOC);
		if(!$fetchColumn)//выбираем все данные в виде двумерного масива
		{
			return $result->fetchAll();
		}
		else //выбираем данные по одной колонке (используеться только для получения $favoritesId в контроллерах)
		{
			return $result->fetchAll(PDO::FETCH_COLUMN, 0);
		}
	}
	
	public function deleteComments($id_film)
	{
		$query = 'DELETE FROM comments WHERE id_film ="'.$id_film.'"';
		$this->MyQuery($query);
	}
	private function getRandomId()
	{
			$query = 'SELECT id FROM films';
			$result =[];
			//выбираем все фильмы
			$result = $this -> MyQuery($query);
			//выбираем рандомный id 
			$result = $result[mt_rand(0,count($result)-1)]['id'];
			return $result;
	}
	public function getRandomPoster()
	{
			$query = 'SELECT poster,name,id FROM films WHERE id = '.$this->getRandomId();
			return $this->MyQuery($query)[0];
	} 
}