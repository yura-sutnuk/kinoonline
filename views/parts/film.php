
	<a align='left' class='name' href="/film/<?php echo $filmData['id'].'/'?>" > <?php echo $filmData['name'];?> </a>
	
	
						
	<div class='poster'>
		<a href="/film/<?php echo $filmData['id'].'/'?>">
			<img  width="200" height="300" src="<?php echo '/views/images/'.$filmData['poster'];  ?>">
		</a>
		
		
			<span  class='favorites' >
			<a <?php if(!isset ($_SESSION['id'])) {echo 'href="/registration"';} ?> class='favoritesLink' id = 'favorite<?php echo $filmData['id']?>' >
				<?php if (isset($favoritesId)):?>
					<?php if(in_array($filmData['id'],$favoritesId)):?>
						<span  onClick='deleteFavorite(<?php echo $filmData['id'].','.$_SESSION['id']?>);' > Удалить из избранного </span>
					<?php else:?>
						<span  onClick='addFavorite(<?php echo $filmData['id'].','.$_SESSION['id']?>);'> Добавить в избранное </span>
					<?php endif; ?>
				<?php else: ?>Добавить в избранное
				<?php endif ?>
			</a>
			</span>
		
		
	</div>					

	<div class='describe'>
		<?php include ROOT.'/views/parts/rating.php';?>
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
	<?php if(isset($_SESSION['login']) && $_SESSION['login']=='Admin'):?>
		<a href="/edit/<?php echo $filmData['id'].'/'?>" class="floatLeft clearLeft">Редактировать</a>
		<a href="/delete/<?php echo $filmData['id'].'/'?>" class="floatLeft marginLeft">Удалить</a>
	<?php endif; ?>









