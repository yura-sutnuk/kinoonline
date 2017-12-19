<?php 

  //include_once(ROOT."/components/DB.php");
  include_once(ROOT.'/models/model.php');
	
	class userModel extends model
	{
//private $connect;
		
	/*	public function __construct(IConnection $IConnect)
		{
			$this->connect = $IConnect;
		}*/
		private function lastInsertID()
		{
			$query = 'SELECT LAST_INSERT_ID() as id FROM users';
			$this->MyQuery($query)[0]['id'];
		}

		public function loginExist($login)
		{
		  $query = 'SELECT id FROM users WHERE login="'.$login.'"';
		 // echo $query;
		  
		  $result = $this->MyQuery($query);
		  
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
			for($i=0;$i<$size;$i++)
			{	
				$query1 .= key($userData).',';
				$query2 .= '\''.current($userData).'\',';
				next($userData );
			}
	
			$query1 .= 'registerDate ';
			$query2 .= 'now()';
						//echo'<br>';
			//var_dump($query1.$query2.')');
			$this->MyQuery($query1.$query2.')');
			
			return $this->lastInsertID();
		}
		public function addNewUserData($data)
		{
			$query1='INSERT INTO userData (';
			$query2=') VALUES (';
			
			$size = count($data);
			for($i=0;$i<$size-1;$i++)
			{	
				$query1 .= key($data).',';
				$query2 .= '\''.current($data).'\',';
				next($data );
			}
	
			$query1 .= key($data);
			$query2 .= '"'.current($data).'"';
						//echo'<br>';
			//var_dump($query1.$query2.')');
			return $result=$this->MyQuery($query1.$query2.')');
		}
		public function updateUserData($data, $table='userData')
		{
		//var_dump($data);
			$query1='UPDATE '.$table.' SET ';
			//$query2=') VALUES (';
			
			$size = count($data);
			for($i=0;$i<$size-1;$i++)
			{	
				$query1 .= key($data).'=';
				$query1 .= '\''.current($data).'\',';
				next($data );
			}
	
			$query1 .= key($data).'=\''.current($data).'\' WHERE id=\''.$data['id'].'\'';
			//$query2 .= 
						//echo'<br>';
			//var_dump($query1);
			return $result=$this->MyQuery($query1);
		}
		
		
		public function userEnter($login)
		{
		  $query = "SELECT * FROM users WHERE login='".$login."'";
		 // var_dump($query);
		  return $this->MyQuery($query)[0];
		}
		
		public function getFieldsValueById($fields, $id, $table='users')
		{
			$query = 'SELECT ';
			$size = count($fields);
			for($i=0; $i<$size-1; $i++)
			{
				$query .= current($fields) .', ';
				next($fields);
			}
			$query .= current($fields) . ' FROM '.$table.' WHERE id="'.$id.'"';
			//var_dump($query);
			return $this->MyQuery($query)[0];
		}
		
		
	}
	