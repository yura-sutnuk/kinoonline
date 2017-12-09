<html>
	<head>
		<title> KINOONLINE </title>
		<link rel="stylesheet" type="text/css" href="/views/style.css">
		<script  type="text/javascript" src='/views/1.js'></script>
	</head>
	
	<body>
		<script type="text/javascript">
</script>
		<?php include 'parts/top.php';?>
		
		<div id="content" >
		
			<div>
				<form name="addFilm" method="POST" action="/controllers/mainController.php" enctype="multipart/form-data">
					<table border="0" cellpadding="5" cellspacing="5">
						<tr >
							<td align="right">Название фильма</td> 
							<td><input class="text" type="text" name="name" maxlength="100" size="40"></td> 
							<td id='errorName'>

							</td>
						</tr>
						
						<tr>
							<td align="right">Год выпуска</td> 
							<td><input class="text" type="text" name="year" ></td> 
							<td id='errorYear'>

							</td>
						</tr>
						<tr>
							<td align="right" ><font color="black">Жанр</font></td> 
							<td>
								<select id='genre' name='genre[]' size = '12' multiple>
                                    <?php foreach(GENRE_LIST as $genre)
									{
									  echo "<option style='color:black' value=". $genre.">".$genre;
									}?>
								</select>
							</td> 
							<td id='errorGenre'>

							</td>
						</tr>
						<tr>
							<td align="right">Страна</td> 
							<td><input class="text" type="text" name="country" maxlength="20" value="<?php (isset($_POST['country']))?$_POST['country']:''?>"></td> 
							<td id='errorCountry'>

							</td>
						</tr>
						<tr>
							<td align="right">Режисер</td> 
							<td><input class="text" type="text" name="producer" maxlength="50"></td>
							<td id='errorProducer'>

							</td>
						</tr>
						<tr>
							<td align="right">В ролях</td> 
							<td><input class="text" type="text" name="cast" ></td> 
							<td id='errorCast'>

							</td>
						</tr>
												
						<tr>
							<td align="right">Видео</td> 
							<td><input type="text" class="text" name="video" ></td> 
							<td id='errorVideo'>

							</td>
						</tr>
						<tr>
							<td align="right">Постер (*.jpeg)</td> 
							<td><input type="file"  name="poster" accept="image/*,image/jpeg" ></td> 
							<td id='errorPoster'>

							</td>
						</tr>
						<tr>
							<td align="right">Скриншот 1(*.jpeg)</td> 
							<td><input type="file"  name="screen1" accept="image/*,image/jpeg" ></td> 
							<td id='errorScreen1'>

							</td>
						</tr>
						<tr>
							<td align="right">Скриншот 2(*.jpeg)</td> 
							<td><input type="file"  name="screen2" accept="image/*,image/jpeg"></td> 
							<td id='errorScreen2'>

							</td>
						</tr>
						<tr>
							<td align="right">Скриншот 3(*.jpeg)</td> 
							<td><input type="file"  name="screen3" accept="image/*,image/jpeg"></td> 
							<td id='errorScreen3'>

							</td>
						</tr>
						<tr>
							<td align="right">Описание</td> 
							<td><textarea class="text" cols="50" rows="7" wrap="virtual" name="description"></textarea></td> 
							<td id='errorDescription'>

							</td>
						</tr>
						<tr>
							<td colspan="2" align="center">
								<input type='hidden' name='addFilm' value='Добавить'>
								<input type="button" name="addFilm" value="Добавить" class="button" onClick='checkData();'>
								<input type="reset" name="reset" value="Очистить" class="button">
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



