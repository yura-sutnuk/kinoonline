<?php 

	return array(
			"add" => "main/add",
			'([a-z0-9]+/){0,}enter' => 'user/enterForm/$1/',
			'([a-z0-9]+/)*exit' => 'user/exit/$1/$2',
			'([a-z]+/)*film'=> 'main/film',
			'([a-z]+/)*edit'=> 'main/filmEdit',
			'delete'=> 'main/filmDelete',
			'genre/([a-z]+)'=> 'main/genre/$1',
			'([a-z]+/)*registration'=>'user/registrationForm',
			'profile' =>'user/profile',
			
			
			
			
			
			"^$" => "main/main",
			
	);