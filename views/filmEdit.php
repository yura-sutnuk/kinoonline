<html>
	<head>
		<title> KINOONLINE </title>
		<link rel="stylesheet" type="text/css" href="/views/style.css">
		
		<script  type="text/javascript" src='/views/script.js'></script>
		<script  type="text/javascript" src='/views/check.js'></script>
	</head>
	
	<body>
		<?php include 'parts/top.php';?>
		
		<div id="content">
		
			
              <?php include 'parts/leftContent.php';?>
			

			<div id="right">

				<div class='film' >
				  <form action = '/controllers/mainController.php' method ='POST' enctype="multipart/form-data" name="form">
					<input type='hidden' name='filmId' value='<?php echo $id ?>'>
						
					<img class='poster' width="200" height="300" src="<?php echo '/views/images/'.$filmData['poster'];  ?>">
					<table border="0" cellpadding="5" cellspacing="5">
						<tr>
							<td>Название:</td>
							<td><input type='text' name='name' value='<?php echo $filmData['name'];?>' class='Text'></td>
						</tr>
						<tr>
							<td>Год выпуска:</td>
							<td><input type='text' name='year' value='<?php echo $filmData['year'];?>' class='Text'> </td>
						</tr>
						<tr>
							<td>Жанр:</td>
							<td><select  name='genre[]' size = '7' multiple class='Text2'>
										<?php foreach(GENRE_LIST as $genre)
										{	
											$bool = false;
											foreach($filmData['genre'] as $selectedGenre)
											{
												
												if($genre==$selectedGenre)
												{
												 echo "<option style='color:#ccc' value=". $selectedGenre." selected>".$selectedGenre;
												 $bool = true;
												 break;
												
												}
												
											}
											if(!$bool)
											{
											echo "<option style='color:#ccc' value=". $genre." >".$genre;
											}
										 
										}?>
									</select> </td>
						</tr>
						<!--<p>Жанр: <input type='text' name='genre' value='<?php// echo $filmData['genre'];?>' class='text'></p>-->
						<tr>
							<td>Страна:</td>
							<td><input type='text' name='country' value='<?php echo $filmData['country'];?>' class='Text'></td>
						</tr>
						<tr>
							<td>Режиссер:</td>
							<td><input type='text' name='producer' value='<?php echo $filmData['producer'];?>' class='Text'></td>
						</tr>
						<tr>
							<td>В ролях:</td>
							<td><input type='text' name='cast' value='<?php echo $filmData['cast'];?>' class='Text'> </td>
						</tr>
					</table>
					<br>
					<p><center><textarea rows='7' cols='50' class='Text2' name ='description' wrap ='physical'><?php echo $filmData['description']; ?> </textarea></center></p>
					
					<input type='button' name='changePoster' class='Button clearLeft marginTop' value='Изменить постер' onClick='editPoster();'>
					<input type='button' name='changeScreens' class='Button marginTop' value='Изменить скриншоты' onClick='editScreenshot();'>
					<input type='button' name='changeVideo' class='Button marginTop' value='Изменить видео' onClick='editFilm();'>
					<input type='button' name='addVideo' class='Button marginTop' value='Добавить видео' onClick='addFilm();'>
					
					<table border="0" cellpadding="5" cellspacing="5" id='editField'>
					
					
					</table >
					<input type='hidden' name='saveChange'>
					<input type='button' onClick='checkVideoData(form);'  class='button marginTop'  value='Сохранить'>
				  </form>
					
				  <fieldset id='screens'>
					<legend>Скриншоты</legend>
					<img src="<?php echo '/views/images/'.$filmData['screen1'];  ?>" width="190" height="114" >
					<img src="<?php echo '/views/images/'.$filmData['screen2'];  ?>" width="190" height="114">
					<img src="<?php echo '/views/images/'.$filmData['screen3'];  ?>" width="190" height="114">
				  </fieldset>
					
				 <?php include 'parts/seriesAndVideo.php';?>
				  
				
					
					
					
				</div>

			</div>
		</div>
		
		
	</body>
</html>