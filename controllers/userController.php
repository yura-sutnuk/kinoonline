<?php

include_once ($_SERVER['DOCUMENT_ROOT'].'/const.php');
include_once ROOT.'/models/userModel.php';
include_once ROOT.'/controllers/globalFunctions.php';

  class userController extends globalFunctions
  {
	private $model;
	public function __construct()
	{
		$this->model= new userModel();
	}
	//проверяет существование логина
	public function actionLoginExist($login)
	{
	//отправляет ответ сервера JavaScriptу
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
	//выполняет выход пользователя
	public function actionExit($param='')
	{
		session_unset();
		session_destroy();
		setcookie(session_name(),'',time());
		//после выхода возвращаем пользователя откуда он пришел
		$path =  $_SERVER['HTTP_REFERER'];
		header("Location:".$path);		
	}
	//формирует страницу профиля
	public function actionProfile($id)
	{	
		//получаем данные полей указаные масивом из таблицы users
		$userData = $this->model->getFieldsValueById(array('avatar','login','registerDate','email'),$id);
		//если юзера нет
		if(empty($userData))
		{	//выдаем 404 страницу
			include ROOT.'/views/page404.php';
			return;
		}
		//получаем не обязательные данные юзера из таблицы userData
		$userExtra = $this->model->getFieldsValueById(array('*'),$id,'userData' );	
		include ROOT.'/views/profile.php';	  
		return true;
	}
	//сохраняет изменения профиля
	public function profileSave()
	{	
		$email = $_POST['email'];
		unset($_POST['email']);
		unset($_POST['profileSave']);
		//есть ли запись с данными юзера в таблице userData
		$exist = $this->model->getFieldsValueById(array('id'),$_POST['id'],'userData');
		//если нет
		if(empty($exist))
		{
			//добавляем данные
			$this->model->addNewUserData($_POST);
		}
		else
		{	//иначе обновляем
			$this->model->updateUserData($_POST);
		}

		$this->model->updateUserData(array('email'=>$email,'id'=>$_POST['id']),'users');

		header('Location: /profile/'.$_POST['id'].'/');
	}
	//заносит новый аватар на сервер и БД
	public function avatarChange()
	{
		$newAvatar = $this->upload('newAvatar',ROOT."/views/images/avatars/",$_POST['id']);
		$this->model->updateUserData(array('avatar' => $newAvatar,'id' => $_POST['id']),'users');
	    header("Location:".$_SERVER['HTTP_REFERER']);	
	}
	//добавляет нового пользователя в БД и выполняет вход
	public function registration()
	{
		//добавили юзера
		$id = $this->model->addNewUser(array('login'=>$_POST['login'],'password'=> hash('sha256',$_POST['password']),'email'=> $_POST['email'])); 
		//и выполнили вход
		$this->enter($id,$_POST['login']);
	}
	//проверяет правильность пароля и логина
	public function actionCheckPassAndLogin($login,$password)
	{
		$userData = $this->model->userEnter($login);
		//если все ОК
		if(!empty($userData) && hash('sha256',$password)===$userData['password'])
		{
			//выполняем вход
			$this->enter($userData['id'],$userData['login']);
		}
		else
		{
			//иначе отправляем JavaScriptу 0 (false) 
			echo '0';
		}
	}
	//ввыполняет вход
	public function enter($id,$login)
	{

		session_start();
		//запоминаем id и login юзера
	    $_SESSION['id'] = $id;
	    $_SESSION['login'] = $login;
		//возвращаем юзера откуда пришел
		$path =  dirname($_SERVER['HTTP_REFERER']);
	    header("Location:".$path.'\\');		

	}
  }
  

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
	else if(isset($_POST['profileSave']))//сохранение профиля
	{
	  $obj = new userController();
	  $obj->profileSave();
	}
	else if(isset($_FILES['newAvatar']))//изменение аватара
	{
		$obj = new userController();
		$obj->avatarChange();
	}
	
	
	
 // }