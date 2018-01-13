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

					<?php include 'parts/film.php';?>

				</div>
				<?php endforeach;?>
				<div id="pages" align="center">
                    <?php echo $pages ?>
                </div>

			</div>


		</div>




	</body>
</html>