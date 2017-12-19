<html>
	<head>
		<title> KINOONLINE </title>
		<link rel="stylesheet" type="text/css" href="/views/style.css">
		<link rel="stylesheet" type="text/css" href="/views/profileStyle.css">
		<script type='text/javascript' src='/views/script.js'></script>
	</head>
	
	<body>
		<?php include 'parts/top.php';?>
		
		<div id="content" >
			<?php include ROOT.'/views/parts/profileLeft.php';?>
			<?php if(isset($_SESSION['id']) && $_SESSION['id']==$id) include ROOT.'/views/parts/myProfileRight.php';
				  else include ROOT.'/views/parts/profileRight.php';
				 ?>
		</div>
		
		
	</body>
</html>



