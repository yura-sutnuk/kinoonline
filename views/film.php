<html>
	<head>
		<title> KINOONLINE </title>
		<link rel="stylesheet" type="text/css" href="/views/style.css">
	</head>
	
	<body>
		<?php include 'parts/top.php';?>
		
		<div id="content">
		
			<div id="left">
              <?php include 'parts/leftContent.php';?>
			</div>

			<div id="right">

				<div class='film' >
					<div >
						<h3> <?php echo $filmData['name']; ?> </h3>
						<img width="200" height="300" src="<?php echo '/views/images/'.$filmData['poster'];  ?>">
						<p>Год выпуска: <?php echo $filmData['year']; ?></p>
						<p>Жанр: <?php foreach($filmData['genre'] as $genre)
										{
											echo $genre;
											echo ' ';
										}
										?></p>
						<p>Страна:<?php echo $filmData['country']; ?></p>
						<p>Режиссер:<?php echo $filmData['producer']; ?></p>
						<p>В ролях:<?php echo $filmData['cast']; ?> </p>
						<br>
						<p> <?php echo $filmData['description']; ?></p>
					</div>
					<fieldset id='screens'>
						<legend>Скриншоты</legend>
						<img src="<?php echo '/views/images/'.$filmData['screen1'];  ?>" width="190" height="114" >
						<img src="<?php echo '/views/images/'.$filmData['screen2'];  ?>" width="190" height="114">
						<img src="<?php echo '/views/images/'.$filmData['screen3'];  ?>" width="190" height="114">
					</fieldset>
					
					<div id='video'>
					<iframe src="<?php echo $filmData['video'];?>" width="632" height="305" frameborder="0" style="z-index:2147483647;"></iframe>
					</div>
					
					<?php include 'parts/commentBlock.php'; ?>
					
				</div>

			</div>
		</div>
		
		
	</body>
</html>