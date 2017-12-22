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
					<?php include 'parts/film.php';?>
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