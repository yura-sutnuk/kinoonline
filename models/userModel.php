<?php 

  include_once(ROOT."/components/DB.php");
	
	class userModel
	{
		private $connect;
		
		public function __construct(IConnection $IConnect)
		{
			$this->connect = $IConnect;
		}

		public function loginExist($login)
		{
		  $query = 'SELECT id FROM users WHERE login="'.$login.'"';
		  echo $query;
		  
		  $result = $this->connect->MyQuery($query);
		  var_dump(empty($result));
		  if(empty($result))
		  {
		    return false;
		  }
		  return true;
		}
		
		public function addNewUser($userData)
		{
		  $query1='INSERT INTO users (';
			$query2=') VALUES (';
			
			$size = count($userData);
			for($i=0;$i<$size-1;$i++)
			{	
				$query1 .= key($userData).',';
				$query2 .= '\''.current($userData).'\',';
				next($userData );
			}
	
			$query1 .= key($userData);
			$query2 .= '\''.current($userData).'\'';
						//echo'<br>';
			//var_dump($query1.$query2.')');
			return $result=$this->connect->MyQuery($query1.$query2.')');
		}
		
		public function userEnter($login)
		{
		  $query = "SELECT * FROM users WHERE login='".$login."'";
		  return $this->connect->MyQuery($query)[0];
		}
		
	}
	