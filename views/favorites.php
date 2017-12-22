<html>
	<head>
		<title> KINOONLINE </title>
		<link rel="stylesheet" type="text/css" href="/views/style.css">
		<script  type="text/javascript" src='/views/script.js'></script>
	</head>
	
	<body>
        <?php include 'parts/top.php';?>
		
		<div id="content">
		<ul>
			<?php foreach($favorites as $favor):?>
				<li><a  href = '/film/<?php echo $favor['id']?>/' > <?php echo $favor['name'] ?> </a></li>
				
			<?php endforeach; ?>
			</ul>
		</div>
		
		
		
		
	</body>
</html>