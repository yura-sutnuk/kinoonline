<?php		

	interface IConnection
	{
		public function __construct();
		public function MyQuery(string $query);

	}
	
	
	class SQLConnect implements IConnection
	{
		private $SQLlink;
		public  function __construct()
		{
			$seting = include_once('DBSeting.php');
			
			// подключаемся к серверу
			$this->SQLlink = mysqli_connect($seting['host'], $seting['user'], $seting['password'], $seting['database']); 
				
				//return $this->SQLlink;
		}
		
		public  function MyQuery(string $query)
		{
			return mysqli_query($this->SQLlink, $query);
		}
		
	}
	
	class PDOConnect implements IConnection
	{
		private $PDOlink;
		public  function __construct()
		{
			$seting = include_once('DBSeting.php');
			
			$this->PDOlink = new PDO("mysql:host={$seting['host']};dbname={$seting['database']}", $seting['user'], $seting['password'],array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
			//array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
			//return $this->PDOlink;
		}
		
		public  function MyQuery(string $query)
		{
			$result = $this->PDOlink->query($query);
		
			//if(is_array($result))
			$result->setFetchMode(PDO::FETCH_ASSOC);
			return $result->fetchAll();
			
		}
	}
	
	