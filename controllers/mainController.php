<?php
include_once(ROOT."/models/BDModel.php");

	class mainController
	{
		
		public function actionMain()
		{	
			$modelObj = new BDModel(new PDOConnect());
			$filmsList = $modelObj->getFilmsList();
			$randFilm = $modelObj->getRandomPoster();
			//var_dump ($randFilm);
			
			
			include ROOT.'/views/main.php';

			return true;
		}
		
	}