<html>
	<head>
		<title> KINOONLINE </title>
		<link rel="stylesheet" type="text/css" href="views/style.css">
	</head>
	
	<body>
		<?php echo __FILE__; ?>
		<div id="top" align="right" >
			  <a href="#" > вход </a> | <a href="#"> зарегестрироваться </a> <input type="text" name="search" value="Search"/> 
		</div>
		
		<div id="content" >
		
			<div>
				<form name="addFilm" method="POST" action="/controllers/addController.php">
					<table border="0" cellpadding="5" cellspacing="5">
						<tr >
							<td align="right">Название фильма</td> 
							<td><input class="text" type="text" name="name" maxlength="100" size="40"></td> 
						</tr>
						
						<tr>
							<td align="right">Год выпуска</td> 
							<td><input class="text" type="text" name="year" ></td> 
						</tr>
												<tr>
							<td align="right" ><font color="black">Жанр</font></td> 
							<td>
								<select  name='genre[]' size = '12' multiple>
									<option style='color:black' value='аниме'><font color='black'> аниме </font>
 									<option style='color:black' value='биография'>биография
									<option style='color:black' value='боевик'>боевик
									<option style='color:black' value='вестерн'>вестерн
									<option style='color:black' value='военный'>военный
									<option style='color:black' value='детектив'>детектив
									<option style='color:black' value='детский'>детский
									<option style='color:black' value='документальный'>документальный
									<option style='color:black' value='драма'>драма
									<option style='color:black' value='история'>история
									<option style='color:black' value='комедия'>комедия
									<option style='color:black' value='короткометражка'>короткометражка
									<option style='color:black' value='мелодрама'>мелодрама
									<option style='color:black' value='музыка'>музыка
									<option style='color:black' value='мультфильм'>мультфильм
									<option style='color:black' value='мюзикл'>мюзикл
									<option style='color:black' value='приключения'>приключения
									<option style='color:black' value='семейный'>семейный
									<option style='color:black' value='спорт'>спорт
									<option style='color:black' value='триллер'>триллер
									<option style='color:black' value='ужасы'>ужасы
									<option style='color:black' value='фантастика'>фантастика
									<option style='color:black' value='криминал'>криминал
									<option style='color:black' value='фэнтези'>фэнтези
								</select>
							</td> 
						</tr>
												<tr>
							<td align="right">Страна</td> 
							<td><input class="text" type="text" name="country" maxlength="20" value="<?php (isset($_POST['country']))?$_POST['country']:''?>"></td> 
						</tr>
												<tr>
							<td align="right">Режисер</td> 
							<td><input class="text" type="text" name="producer" maxlength="50"></td> 
						</tr>
												<tr>
							<td align="right">В ролях</td> 
							<td><input class="text" type="text" name="cast" ></td> 
						</tr>
												
						<tr>
							<td align="right">Видео</td> 
							<td><input type="text" class="text" name="video" ></td> 
						</tr>
						<tr>
							<td align="right">Постер</td> 
							<td><input type="text" class="text" name="poster" ></td> 
						</tr>
						<tr>
							<td align="right">Скриншот 1</td> 
							<td><input type="text" class="text" name="screen1" ></td> 
						</tr>
						<tr>
							<td align="right">Скриншот 2</td> 
							<td><input type="text" class="text" name="screen2" ></td> 
						</tr>
						<tr>
							<td align="right">Скриншот 3</td> 
							<td><input type="text" class="text" name="screen3" ></td> 
						</tr>
						<tr>
							<td align="right">Описание</td> 
							<td><textarea class="text" cols="50" rows="7" wrap="virtual" name="description"></textarea>       </td> 
						</tr>
						<tr>
							<td colspan="2" align="center">
								<input type="submit" name="submit" value="Добавить" class="button">
								<input type="reset" name="reset" value="Очистить" class="button">
								
					</table>
					
					  <br>
					  <br>
					  
					  <br>
					  <br>
					  <br>
				
				</form>
				
				<?php
/*
foreach($_POST as $key=>$value)
{


	if($value==null)
	{
		echo " Ошибка, заполните все поля формы";
		
		return;
	}
}

	if(!is_int(intval($_POST['year'])))
	{
		echo "дата выпуска должна быть числовым значением";
		
		return;
	}
	$name = (isset($_POST['name']))? $_POST['name'] : '';
	$year = (isset($_POST['year']))? $_POST['year'] : null;
	$genre = (isset($_POST['genre']))? $_POST['genre'] : '';
	$country = (isset($_POST['country']))? $_POST['country'] : '';
	$producer = (isset($_POST['producer']))? $_POST['producer'] : '';
	$cast = (isset($_POST['cast']))? $_POST['cast'] : '';
	$description = (isset($_POST['description']))? $_POST['description'] : '';
	$date = date("j-m-Y");

	$host = 'localhost'; // адрес сервера 
	$database = 'kinodb'; // имя базы данных
	$user = 'root'; // имя пользователя
	$password = ''; // пароль

// подключаемся к серверу
$link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка " . mysqli_error($link));
 
// выполняем операции с базой данных
$query ="INSERT INTO films(name,year,genre,country,producer,cast,description,date) VALUES ('$name',$year,'$genre','$country','$producer','$cast','$description',curdate()) ";

$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
if($result)
{
  echo "Добавление прошло успешно";
}

 
// закрываем подключение
mysqli_close($link);
	*/
?>
			</div>
		</div>
		
		
	</body>
</html>



