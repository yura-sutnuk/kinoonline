var bool = true;

function checkData()
{
	bool=true;
	
	checkField(document.addFilm.year.value,empty,document.getElementById('errorYear'));
	if(bool)
	{
		checkField(document.addFilm.year.value,NotNumber,document.getElementById('errorYear'),'Это поле должно содержать только цифры');
	}
	checkField(document.addFilm.name.value,empty,document.getElementById('errorName'));
	checkField(document.addFilm.genre.value,empty,document.getElementById('errorGenre'),'Выберите минимум 1 жанр');
	checkField(document.addFilm.country.value,empty,document.getElementById('errorCountry'));
	checkField(document.addFilm.producer.value,empty,document.getElementById('errorProducer'));
	checkField(document.addFilm.video.value,empty,document.getElementById('errorVideo'));
	checkField(document.addFilm.poster.value,empty,document.getElementById('errorPoster'));
	checkField(document.addFilm.screen1.value,empty,document.getElementById('errorScreen1'));
	checkField(document.addFilm.screen2.value,empty,document.getElementById('errorScreen2'));
	checkField(document.addFilm.screen3.value,empty,document.getElementById('errorScreen3'));
	
	if(bool)
	{
		document.addFilm.submit();
	}
}
function empty(value)
{
	return value=='';
}
function NotNumber(value)
{
	return  isNaN(value)
}

function checkField(value,fun,errorField,Text='Это поле должно быть заполненым')
{
	 if(fun(value))
	{
		errorField.innerHTML = '<p class="error">'+Text +'</p>';
		bool=false;
	}
	else
	{
		errorField.innerHTML = ' ';
	}
}

function validLogin(obj)
{
	var reg =/^[a-zA-Z0-9_-]{3,14}$/ ; 
	//alert(!reg.test(obj.value));
	return !reg.test(obj.value);
}
function loginExist(obj)
{
	var req = new XMLHttpRequest();
	req.open('POST','/loginExist/'+obj.value, false);
	req.send();
	//alert(req.responseText);
	return req.responseText==true;

}
function validEmail(obj)
{
	var reg =/^([a-z0-9_\.-]+)@([a-z0-9_\.-]+)\.([a-z\.]{2,6})$/ ; 
	return !reg.test(obj.value);
}
function validPass(pass)
{
//alert((pass[0]==pass[1])&& (pass[0]!=''));
	return (pass[0]!=pass[1]) || (pass[0]=='');
}

function checkRegistration(obj)
{
	bool=true;
	checkField(obj.login,validLogin,document.getElementById('errorLogin'),"Допустимо от 3 до 14 символов a-zA-Z0-9_-");
	if(bool)
	{
		checkField(obj.login,loginExist,document.getElementById('errorLogin'),"Логин уже занят");
	}
		
	var pass1 = document.getElementById('pass1');
	var pass2 = document.getElementById('pass2');
	var pass = document.getElementById ('errorPass1');
	checkField([pass1.value,pass2.value],validPass,pass,'пароли не совпадают');	
	var pass = document.getElementById ('errorPass2');
	checkField([pass1.value,pass2.value],validPass,pass,'пароли не совпадают');
	
	checkField(obj.email,validEmail,document.getElementById('errorEmail'),'неверный адрес електронной почты');
	if(bool)
	{
		Submit(obj);
	}

}

function checkEnter(obj)
{
	var req = new XMLHttpRequest();
	req.open('POST','/tryEnter/'+obj.login.value+'/'+obj.password.value,false);
	req.send();
	if(req.responseText==false)
	{
		document.getElementById('errorEnter').innerHTML = '<p class="error"> Ошибка в логине или пароле </p>'
	}
	else
	{
		//window.location = req.responseText;
		history.go(-1);
	}
}