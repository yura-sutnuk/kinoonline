<?php 

	return array(
			'([a-z0-9]+/)*exit' => 		'user/exit/$1',
			
			
			'addFavorite' => 			'favorites/addFavorite',
			'deleteFavorite'=>			'favorites/deleteFavorites',
			'favorites' => 				'favorites/GetFavorites',
			'changeRating' =>			'main/rating',
			'loginExist' => 			'user/loginExist',
			'tryEnter' => 				'user/CheckPassAndLogin',
			"addmovie" => 				"main/add",
			'([a-z0-9]+/){0,}enter' => 	'user/enterForm/$1/',
			
			'search' => 				'main/search',
			'([a-z]+/)*film'=>			'main/film',
			'([a-z]+/)*edit'=> 			'main/filmEdit',
			'delete'=> 					'main/filmDelete',
			'genre/([a-z]+)'=> 			'main/genre/$1',
			'([a-z]+/)*registration'=>	'user/registrationForm',
			'profile' =>				'user/profile',
			
			
			
			
			
			'([0-9]+)' => 				'main/main/$1',
			
			"(^$)" => "main/main",
			
	);