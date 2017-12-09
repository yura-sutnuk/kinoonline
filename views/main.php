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
				<?php foreach ($filmsList as $films):?>
				<div class="film">
				
					<a href="film/<?php echo $films['id'].'/'?>"><h3> <?php echo $films['name']; ?> </h3></a>
					<a href="film/<?php echo $films['id'].'/'?>"><img width="200" height="300" src="<?php echo '/views/images/'.$films['poster'];  ?>"></a>
					
					<?php if(isset($_SESSION['login']) && $_SESSION['login']=='Admin'):?>
					<a href="/edit/<?php echo $films['id'].'/'?>" class="floatLeft clearLeft">Редактировать</a>
					<a href="/delete/<?php echo $films['id'].'/'?>" class="floatLeft marginLeft">Удалить</a>
					<?php endif; ?>
					
					<p>Год выпуска: <?php echo $films['year']; ?></p>
					<p>Жанр: <?php foreach($films['genre'] as $genre)
										{
											echo $genre;
											echo ' ';
										}
										?></p>
					<p>Страна:<?php echo $films['country']; ?></p>
					<p>Режиссер:<?php echo $films['producer']; ?></p>
					<p>В ролях:<?php echo $films['cast']; ?> </p>
					<br>
					<p> <?php echo $films['description']; ?></p>
				
					
				</div>
				<?php endforeach; ?>
			</div>
		</div>
		
		
	</body>
</html>