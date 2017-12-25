<html>
	<head>
		<title> KINOONLINE </title>
		<link rel="stylesheet" type="text/css" href="/views/style.css">
		<link rel="stylesheet" type="text/css" href="/views/a.css">
				<script  type="text/javascript" src='/views/script.js'></script>
		<script  type="text/javascript" src='/views/check.js'></script>

	</head>
	
	<body>
		<script type="text/javascript">
</script>
		<?php include 'parts/top.php';?>
		
		<div id="content" >
		
			<div >
				<form name="addFilm" method="POST" action="/controllers/mainController.php" enctype="multipart/form-data">
					<table border="0" cellpadding="5" cellspacing="5">
						<tr >
							<td align="right">Название фильма</td> 
							<td><input class="Text extra" type="text" name="name" maxlength="100" size="40"></td> 
							<td id='errorName'>

							</td>
						</tr>
						
						<tr>
							<td align="right">Год выпуска</td> 
							<td><input class="Text extra" type="text" name="year" ></td> 
							<td id='errorYear'>

							</td>
						</tr>
						<tr>
							<td align="right" ><font color="black">Жанр</font></td> 
							<td>
								<select id='genre' name='genre[]' size = '12' multiple class='Text2'>
                                    <?php foreach(GENRE_LIST as $genre)
									{
									  echo "<option  style='color:#ccc' value=". $genre.">".$genre;
									}?>
								</select>
							</td> 
							<td id='errorGenre'>

							</td>
						</tr>
						<tr>
							<td align="right">Страна</td> 
							<td><input class="Text extra" type="text" name="country" maxlength="20" value="<?php (isset($_POST['country']))?$_POST['country']:''?>"></td> 
							<td id='errorCountry'>

							</td>
						</tr>
						<tr>
							<td align="right">Режисер</td> 
							<td><input class="Text extra" type="text" name="producer" maxlength="50"></td>
							<td id='errorProducer'>

							</td>
						</tr>
						<tr>
							<td align="right">В ролях</td> 
							<td><input class="Text extra" type="text" name="cast" ></td> 
							<td id='errorCast'>

							</td>
						</tr>
												
						<tr>
							<td align="right">Видео</td> 
							<td><input type="text" class="Text extra" name="video" ></td> 
							<td id='errorVideo'>

							</td>
						</tr>
						<tr>
							<td align="right">Название Видео</td> 
							<td><input type="text" class="Text extra" name="videoName" ></td> 
							<td id='errorVideoName'>

							</td>
						</tr>
						<tr>
							<td align="right">Постер (*.jpeg)</td> 
							<td><input type="file" class='hiddenElement' onChange='selected(poster,posterValue);'  name="poster" accept="image/*,image/jpeg"  >
								<span class='Button' onClick='fileSelect(addFilm.poster)'><a >Загрузить файл</a></span>
								<span id='posterValue' style='margin-left:10px'> Файл не выбран </span></td> 
							<td id='errorPoster'>

							</td>
						</tr>
						<tr>
							<td align="right">Скриншот 1(*.jpeg)</td> 
							<td><input type="file" class='hiddenElement' onChange="selected(screen1,screen1Value);"  name="screen1" accept="image/*,image/jpeg" >
							<span class='Button' onClick='fileSelect(addFilm.screen1);'><a >Загрузить файл</a></span>
								<span id='screen1Value' style='margin-left:10px'> Файл не выбран </span></td> 
							<td id='errorScreen1'>

							</td>
						</tr>
						<tr>
							<td align="right">Скриншот 2(*.jpeg)</td> 
							<td><input type="file" class='hiddenElement' onChange='selected(screen2,screen2Value);'   name="screen2" accept="image/*,image/jpeg">
							<span class='Button' onClick='fileSelect(addFilm.screen2);'><a >Загрузить файл</a></span>
								<span id='screen2Value' style='margin-left:10px'> Файл не выбран </span></td> 
							<td id='errorScreen2'>

							</td>
						</tr>
						<tr>
							<td align="right">Скриншот 3(*.jpeg)</td> 
							<td><input type="file" class='hiddenElement' onChange='selected(screen3,screen3Value);'   name="screen3" accept="image/*,image/jpeg">
							<span class='Button' onClick='fileSelect(addFilm.screen3);'><a >Загрузить файл</a></span>
								<span id='screen3Value' style='margin-left:10px'> Файл не выбран </span></td> 
							<td id='errorScreen3'>

							</td>
						</tr>
						<tr>
							<td align="right">Описание</td> 
							<td><textarea class="Text2" cols="50" rows="7" wrap="physical" name="description"></textarea></td> 
							<td id='errorDescription'>

							</td>
						</tr>
						<tr>
							<td colspan="2" align="center">
								<input type='hidden' name='addFilm' value='Добавить' >
								<input type="button" name="addFilm" value="Добавить" class='Button' onClick='checkData();'>
								<input type="reset" name="reset" value="Очистить" class='Button'>
							</td>
						</tr>
								
					</table>
					
					  <br>
					  <br>
					  
					  <br>
					  <br>
					  <br>
				
				</form>
				
			</div>
		</div>
		
		
	</body>
</html>



