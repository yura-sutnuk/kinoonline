<html>
	<head>
		<title> KINOONLINE </title>
		<link rel="stylesheet" type="text/css" href="views/style.css">
	</head>
	
	<body>
		<div id="top" align="right" >
			  <a href="#" > вход </a> | <a href="#"> зарегестрироваться </a> <input type="text" name="search" value="Search"/> 
		</div>
		
		<div id="content">
		
			<div id="left">
				<div id="zhanr">
					<ul class="column">
						<li><a href="#">аниме </a></li>
						<li><a href="#">биография </a></li>
						<li><a href="#">боевик </a></li>
						<li><a href="#">вестерн </a></li>
						<li><a href="#">военный </a></li>
						<li><a href="#">детектив </a></li>
						<li><a href="#">детский </a></li>
						<li><a href="#">документальный </a></li>
						<li><a href="#">драма</a></li>
						<li><a href="#">история </a></li>
						<li><a href="#">комедия </a></li>
						<li><a href="#">короткометражка </a></li>

					</ul>
										
					<ul class="column">
						<li><a href="#">мелодрама </a></li>
						<li><a href="#">музыка </a></li>
						<li><a href="#">мультфильм </a></li>
						<li><a href="#">мюзикл </a></li>
						<li><a href="#">приключения </a></li>
						<li><a href="#">семейный </a></li>
						<li><a href="#">спорт </a></li>
						<li><a href="#">триллер </a></li>
						<li><a href="#">ужасы</a></li>
						<li><a href="#">фантастика </a></li>
						<li><a href="#">фэнтези </a></li>
						<li><a href="#">криминал </a></li>
						
					</ul>
				</div>
				
				
				<div id="randomFilm">
				
				<h3 align="center"> Случайный фильм </h3><br>
				<a href="#"> <img width="200" height="300" src="views/images/<?php echo $randFilm['poster']; ?>"> </a>
				<p> </p>
				<p align="center"><?php echo $randFilm['name']; ?></p>
				</div>
				
			</div>

			<div id="right">
				<?php foreach ($filmsList as $films):?>
				<div class="film">
				
					<a href="#"><h3> <?php echo $films['name']; ?> </h3></a>
					<a href="#"><img width="200" height="300" src="<?php echo 'views/images/'.$films['poster'];  ?>"></a>
					<p>Год выпуска: <?php echo $films['year']; ?></p>
					<p>Жанр: <?php echo $films['genre']; ?></p>
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