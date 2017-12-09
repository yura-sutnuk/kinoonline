var bool = true;

function checkData()
{
	
	checkField(document.addFilm.name.value,empty,document.getElementById('errorName'));
	//document.addFilm.year.value = document.addFilm.year.+value;
	checkField(document.addFilm.year.value,emptyAndNotNumber,document.getElementById('errorYear'),'Это поле должно быть заполненым и содержать только цифры');
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
function emptyAndNotNumber(value)
{
	return (value=='' || isNaN(value))
}

function checkField(value,fun,errorField,Text='Это поле должно быть заполненым')
{
	 if(fun(value))
	{
		errorField.innerHTML = '<div class="error"><p class="errorText">'+Text +'</p></div>';
		bool=false;
	}
	else
	{
		errorField.innerHTML = ' ';
	}
}