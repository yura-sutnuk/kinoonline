<html>
	<head>
		<title> KINOONLINE </title>
		<link rel="stylesheet" type="text/css" href="/views/style.css">
		<script  type="text/javascript" src='/views/script.js'></script>
	</head>
	
	<body>
		<?php include 'parts/top.php';?>
		
		<div id="content">
		
			<div id="left">
              <?php include 'parts/leftContent.php';?>
			</div>

			<div id="right">

				<div class='film' >
				  <form action = '/controllers/mainController.php' method ='POST' enctype="multipart/form-data">
					<input type='hidden' name='filmId' value='<?php echo $id ?>'>
						
					<img width="200" height="300" src="<?php echo '/views/images/'.$filmData['poster'];  ?>">
					<p> Название:<input type='text' name='name' value='<?php echo $filmData['name'];?>' class='text'> </p>
					<p>Год выпуска:<input type='text' name='year' value='<?php echo $filmData['year'];?>' class='text'> </p>
					<p>Жанр: <select  name='genre[]' size = '7' multiple>
                                    <?php foreach(GENRE_LIST as $genre)
									{	
										$bool = false;
										foreach($filmData['genre'] as $selectedGenre)
										{
											
											if($genre==$selectedGenre)
											{
											 echo "<option style='color:black' value=". $selectedGenre." selected>".$selectedGenre;
											 $bool = true;
											 break;
											
											}
											
										}
										if(!$bool)
										{
										echo "<option style='color:black' value=". $genre." >".$genre;
										}
									 
									}?>
								</select> </p>
					
					<!--<p>Жанр: <input type='text' name='genre' value='<?php// echo $filmData['genre'];?>' class='text'></p>-->
					<p>Страна:<input type='text' name='country' value='<?php echo $filmData['country'];?>' class='text'></p>
					<p>Режиссер:<input type='text' name='producer' value='<?php echo $filmData['producer'];?>' class='text'></p>
					<p>В ролях:<input type='text' name='cast' value='<?php echo $filmData['cast'];?>' class='text'> </p>
					<br>
					<p><textarea rows='5' cols='40' class='text' name ='description'><?php echo $filmData['description']; ?> </textarea></p>
					
					<input type='button' name='poster' class='editButton clearLeft' value='Изменить постер' onClick='editPoster();'>
					<input type='button' name='poster' class='editButton' value='Изменить скриншоты' onClick='editScreenshot();'>
					<input type='button' name='poster' class='editButton' value='Изменить видео' onClick='editFilm();'>
					
					<table border="0" cellpadding="5" cellspacing="5" id='editField'>
					
					
					</table>
					
					<input type='submit' name='saveChange' class='button floatLeft clearLeft' value='Сохранить'>
				  </form>
					
				  <fieldset id='screens'>
					<legend>Скриншоты</legend>
					<img src="<?php echo '/views/images/'.$filmData['screen1'];  ?>" width="190" height="114" >
					<img src="<?php echo '/views/images/'.$filmData['screen2'];  ?>" width="190" height="114">
					<img src="<?php echo '/views/images/'.$filmData['screen3'];  ?>" width="190" height="114">
				  </fieldset>
					
				  <div id='video'>
				  <iframe src="<?php echo $filmData['video'];?>" width="632" height="305" frameborder="0" style="z-index:2147483647;"></iframe>
				  </div>
					
					
					
				</div>

			</div>
		</div>
		
		
	</body>
</html>