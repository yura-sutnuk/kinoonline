<?php

include ($_SERVER['DOCUMENT_ROOT'].'/const.php');
include ROOT.'/models/userModel.php';

  class userController
  {
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
	
	public function registration($param=array())
	{
	  $pattern = '~[a-zA-z0-9-_]{3,14}~';	  
	  if(!preg_match($pattern,$_POST['login']))
	  {
	    echo 'login must contain 3-14 symbols (a-Z, 0-9, -_)';
		//var_dump($_POST['login']);
		//var_dump(preg_match($pattern,$_POST['login']));
		return;
	  }
	 
	  $userModel = new userModel(new PDOConnect());
	  if($userModel->loginExist($_POST['login']) )
	  {
	    echo 'login already exist';
		return;
	  }
 
	   $userModel->addNewUser(array('login'=>$_POST['login'],'password'=> $_POST['password'],'email'=> $_POST['email']));
	   
	   $this->enter($param);
     
	}
	
	public function enter($param=array())
	{
	  $userModel = new UserModel(new PDOConnect());
	  $userData = $userModel->userEnter($_POST['login']);
	  if(!empty($userData) && $_POST['password']==$userData['password'])
	  {  
		session_start();
	     $_SESSION['id'] = $userData['id'];
	     $_SESSION['login'] = $userData ['login'];
		 $path = 'http://kinoonline';
		 foreach($param as $partPath)
		 $path .= $partPath;
		 var_dump($_SERVER['HTTP_REFERER']);
	     header("Location: http://kinoonline");		
	  }
	    echo 'error in login or password';
		return;
	}

	public function addNewUserToBD()
	{
	  $userModel = new userModel(new PDOConnect());	  
	  $userModel->addNewUser(array('login'=>$_SESSION['login'],'password'=> $_SESSION['password'],'email'=> $_SESSION['email']));

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