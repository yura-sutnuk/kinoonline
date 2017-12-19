<?php

include ($_SERVER['DOCUMENT_ROOT'].'/const.php');
include ROOT.'/models/userModel.php';
include ROOT.'/controllers/globalFunctions.php';

  class userController extends globalFunctions
  {
	private $model;
	public function __construct()
	{
		$this->model= new userModel();//new PDOConnect()
	}
	public function actionLoginExist($login)
	{
		echo $this->model->loginExist($login);
		
	}
    public function actionRegistrationForm()
	{
	$randFilm = $this->model->getRandomPoster();
	  include ROOT.'/views/registration.php';
	  
	  return true;
	}
	public function actionEnterForm()
	{
	$randFilm = $this->model->getRandomPoster();
      include ROOT.'/views/enter.php';	  
	  return true;
	}
	public function actionExit($param='')
	{
	  session_unset();
      session_destroy();
	  setcookie(session_name(),'',time());
	 //// $path = 'http://kinoonline';
	 // foreach($param as $partPath)
	 // $path .= $partPath;
	 // var_dump($_SERVER['HTTP_REFERER']);
	  $path =  $_SERVER['HTTP_REFERER'];//dirname($_SERVER['HTTP_REFERER']);
	  //var_dump($param);
	 // var_dump($path);
	   header("Location:".$path);		
	  //header('Location:'.$path );
	}
	public function actionProfile($id)
	{
		$userData = $this->model->getFieldsValueById(array('avatar','login','registerDate','email'),$id);
		if(empty($userData))
		{
			include ROOT.'/views/page404.php';
			return;
		}
		$userExtra = $this->model->getFieldsValueById(array('*'),$id,'userData' );	
		include ROOT.'/views/profile.php';	  
		return true;
	}
	public function profileSave()
	{	
		$email = $_POST['email'];
		unset($_POST['email']);
		unset($_POST['profileSave']);
		
		$exist = $this->model->getFieldsValueById(array('id'),$_POST['id'],'userData');
		if(empty($exist))
		{
			$this->model->addNewUserData($_POST);
		}
		else
		{
			$this->model->updateUserData($_POST);
		}
		//if(!empty($email))
		//{
			$this->model->updateUserData(array('email'=>$email,'id'=>$_POST['id']),'users');
		//}
		header('Location: /profile/'.$_POST['id'].'/');
	}
	public function avatarChange()
	{
		//move_uploaded_file($_FILES['poster']['tmp_name'],ROOT."/views/images/")
		//echo 'eeeeeeeeeeeeeeeeeeeeeeee';
		$newAvatar = $this->upload('newAvatar',ROOT."/views/images/avatars/",$_POST['id']);
		$this->model->updateUserData(array('avatar' => $newAvatar,'id' => $_POST['id']),'users');
		//$path =  dirname($_SERVER['HTTP_REFERER']);
	    header("Location:".$_SERVER['HTTP_REFERER']);	
	}
	public function registration()
	{
	 /* $pattern = '~[a-zA-z0-9-_]{3,14}~';	  
	  if(!preg_match($pattern,$_POST['login']))
	  {
	    echo 'login must contain 3-14 symbols (a-Z, 0-9, -_)';
		return;
	  }*/
	 
	 // $userModel = new userModel($this->model);
	 /* if($this->model->loginExist($_POST['login']) )
	  {
	    echo 'login already exist';
		return;
	  }*/
		//echo 'password='.$_POST['password'];
		$id = $this->model->addNewUser(array('login'=>$_POST['login'],'password'=> hash('sha256',$_POST['password']),'email'=> $_POST['email'])); 
		$this->enter($id,$_POST['login']);
     
	}
	
	public function actionCheckPassAndLogin($login,$password)
	{
		$userData = $this->model->userEnter($login);
		//echo '1';
		if(!empty($userData) && hash('sha256',$password)===$userData['password'])
		{
		//echo '1';
			$this->enter($userData['id'],$userData['login']);
			$path =  dirname($_SERVER['HTTP_REFERER']).'/';
	    	echo $path;
			
		}
		else
		{
		//	echo '0';
		}
	}
	
	public function enter($id,$login)
	{
	 
	//  $userData = $this->model->userEnter($_POST['login']);
	//  $id = actionCheckPassAndLogin($login,$password);
	 // if($id!==false)
	 // {  
		session_start();
	    $_SESSION['id'] = $id;
	    $_SESSION['login'] = $login;
		//$path =  dirname($_SERVER['HTTP_REFERER']);
	    // header("Location:".$path.'\\');		
	//  }
	    //echo 'error in login or password';
		//return;
	}

	public function addNewUserToBD()
	{
	 // $userModel = new userModel(new PDOConnect());	  
	  $this->model->addNewUser(array('login'=>$_SESSION['login'],'password'=> $_SESSION['password'],'email'=> $_SESSION['email']));

	}
	
  }
  
  //if(isset($_POST) && !empty($_POST))
 //var_dump($_POST);
 // if(isset($_POST))
 // {
    /*foreach($_POST as $value)
	{
	  if(empty($value))
	  {
	    echo 'the fields is empty';
	    return;
	  }
	} */
	//var_dump($_POST);
	if(isset($_POST['registration']))// == 'Регистрация')
	{ //echo '3';
     $obj = new userController();
	 $obj->registration();	 
	}
	else if(isset($_POST['enterId']))//=='Войти'))
	{ //echo '2';
	  $obj = new userController();
	  $obj->enter($_POST['enterId'],$_POST['login']);
	}
	else if(isset($_POST['profileSave']))
	{
	  $obj = new userController();
	  $obj->profileSave();
	}
	else if(isset($_FILES['newAvatar']))
	{
		$obj = new userController();
		$obj->avatarChange();
	}
	
	
	
 // }