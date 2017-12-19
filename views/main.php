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
				<?php foreach ($movies as $filmData):?>
				<div class="film">
				
					<a align='left' class='name' href="/film/<?php echo $filmData['id'].'/'?>" > <?php echo $filmData['name'];?> </a>
					
					<?php include ROOT.'/views/parts/rating.php';?>
					
					<a href="/film/<?php echo $filmData['id'].'/'?>"><img class='poster' width="200" height="300" src="<?php echo '/views/images/'.$filmData['poster'];  ?>"></a>
					
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
				<?php endforeach;?>
				
				<?php include ROOT.'/views/parts/pages.php';?>
			</div>
			
			
		</div>
		
		
		
		
	</body>
</html>