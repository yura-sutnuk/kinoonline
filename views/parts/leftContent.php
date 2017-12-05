<div id="zhanr">
					<ul class="column">
					<?php 
					  $genreArray = array_slice(GENRE_LIST,0,count(GENRE_LIST)/2) ;
					foreach ($genreArray as $key => $value)
					      {  
					       echo "<li><a href='/genre/".$key."'>".$value." </a></li>";
					      }
						?>
					</ul>
										
					<ul class="column">
						<?php					
						  $genreArray = array_slice(GENRE_LIST,count(GENRE_LIST)/2,count(GENRE_LIST)/2) ;
					      foreach ($genreArray as $key => $value)
					      {  
					        echo "<li><a href='/genre/".$key."'>".$value." </a></li>";
					      }
						?>
					</ul>
				</div>
				
				
				<div id="randomFilm">
				
				<h3 align="center"> Случайный фильм </h3><br>
				<a href="film/<?php echo $randFilm['id'] ?>"> <img width="200" height="300" src="/views/images/<?php echo $randFilm['poster']; ?>"> </a>
				<p> </p>
				<p align="center"><?php echo $randFilm['name']; ?></p>
				</div>