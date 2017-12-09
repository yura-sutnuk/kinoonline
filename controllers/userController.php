<?php

include ($_SERVER['DOCUMENT_ROOT'].'/const.php');
include ROOT.'/models/userModel.php';

  class userController
  {
	private $model;
	public function __construct()
	{
		$this->model= new userModel(new PDOConnect());
	}
    public function actionRegistrationForm()
	{
	  include ROOT.'/views/registration.php';
	  
	  return true;
	}
	public function actionEnterForm()
	{
      include ROOT.'/views/enter.php';	  
	  return true;
	}
	public function actionExit($param='')
	{
	  session_unset();
      session_destroy();
	  setcookie(session_name(),'',time());
	  $path = 'http://kinoonline';
	  foreach($param as $partPath)
	  $path .= $partPath;
	  //var_dump($path);
	  header('Location:'.$path );
	}
	public function actionProfile($id)
	{
		$userData = $this->model->getFieldsValueById(array('avatar','login','registerDate'),$id);
		$userExtra = $this->model->getFieldsValueById(array('*'),$id,'userData' );
		var_dump($userData);
		var_dump($userExtra);
		
		include ROOT.'/views/profile.php';	  
	  return true;
	}
	
	public function registration()
	{
	  $pattern = '~[a-zA-z0-9-_]{3,14}~';	  
	  if(!preg_match($pattern,$_POST['login']))
	  {
	    echo 'login must contain 3-14 symbols (a-Z, 0-9, -_)';
		//var_dump($_POST['login']);
		//var_dump(preg_match($pattern,$_POST['login']));
		return;
	  }
	 
	 // $userModel = new userModel($this->model);
	  if($this->model->loginExist($_POST['login']) )
	  {
	    echo 'login already exist';
		return;
	  }
 
	   $this->model->addNewUser(array('login'=>$_POST['login'],'password'=> $_POST['password'],'email'=> $_POST['email']));
	   
	   $this->enter($param);
     
	}
	
	public function enter($param=array())
	{
	  //$userModel = new UserModel(new PDOConnect());
	  $userData = $this->model->userEnter($_POST['login']);
	  if(!empty($userData) && $_POST['password']==$userData['password'])
	  {  
		session_start();
	     $_SESSION['id'] = $userData['id'];
	     $_SESSION['login'] = $userData ['login'];
		// $path = 'http://kinoonline';
		// foreach($param as $partPath)
		 //$path .= $partPath;
		$path =  dirname($_SERVER['HTTP_REFERER']);
	     header("Location:".$path);		
	  }
	    echo 'error in login or password';
		return;
	}

	public function addNewUserToBD()
	{
	 // $userModel = new userModel(new PDOConnect());	  
	  $this->model->addNewUser(array('login'=>$_SESSION['login'],'password'=> $_SESSION['password'],'email'=> $_SESSION['email']));

	}
	
  }
  
  //if(isset($_POST) && !empty($_POST))
  if(isset($_POST))
  {
    foreach($_POST as $value)
	{
	  if(empty($value))
	  {
	    echo 'the fields is empty';
	    return;
	  }
	} 
	//var_dump($_POST);
	if(isset($_POST['registration']))// == 'Регистрация')
	{ //echo '3';
     $obj = new userController();
	 $obj->registration();	 
	}
	else if(isset($_POST['enter']))//=='Войти'))
	{ //echo '2';
	  $obj = new userController();
	  $obj->enter();
	}
  }