<html>
	<head>
		<title> KINOONLINE </title>
		<link rel="stylesheet" type="text/css" href="/views/style.css">
		<script  type="text/javascript" src='/views/script.js'></script>
	</head>
	
	<body>
		<?php include 'parts/top.php';?>
		
		<div id="content">
		
			
              <?php include 'parts/leftContent.php';?>
			

			<div id="right">

				<div class='film' >
					<div >
						<h3 class='name'> <?php echo $filmData['name']; ?> </h3>
						
						<?php include ROOT.'/views/parts/rating.php';?>
						
						<img  class='poster' width="200" height="300" src="<?php echo '/views/images/'.$filmData['poster'];  ?>">
						
						<?php if(isset($_SESSION['login']) && $_SESSION['login']=='Admin'):?>
						<a href="/edit/<?php echo $filmData['id'].'/'?>" class="floatLeft clearLeft">Редактировать</a>
						<a href="/delete/<?php echo $filmData['id'].'/'?>" class="floatLeft marginLeft">Удалить</a>
						<?php endif; ?>
					
					
						<p style='margin-top:10'>Год выпуска: <?php echo $filmData['year']; ?></p>
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
					<iframe src="<?php echo $filmData['video'];?>" width="632" height="305" frameborder="0" style="z-index:2147483647;" allowfullscreen></iframe>
					
					</div>
					
					<?php include 'parts/commentBlock.php'; ?>
					
				</div>

			</div>
		</div>
		
		
	</body>
</html>