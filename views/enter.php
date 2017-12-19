<html>
	<head>
		<title> KINOONLINE </title>
		<link rel="stylesheet" type="text/css" href="/views/style.css">
		<!--<link rel="stylesheet" type="text/css" href="/views/userStyle.css">-->
		<script  type="text/javascript" src='/views/check.js'></script>
	</head>
	
	<body>
		<?php include 'parts/top.php';?>
		
		<div id="content" >
			<?php include ROOT.'/views/parts/leftContent.php';?>
			<div id='right'>
				<h2 style='margin:10; margin-left:120'> Welcome </h2>
				<div class='userContainer'>
				<center> <h2>  </h2> </center>
				<form action='/controllers/userController.php' method='POST' class='userForm' name='enterForm'>
					<input type='hidden' name='enterId'>
					<input type='text' name='login' class='Text extra floatLeft clearLeft' placeholder='Логин' >
					<div class='floatLeft' id='errorEnter'></div>
					<input type='password' name='password' class='Text extra floatLeft clearLeft' placeholder='Пароль'>
					<!--<input type="submit" name="enter" value="Войти" class="Button" style='padding:10 20; margin-left:120'>-->
					<span class='Button floatLeft' style='margin-left:120; clear:both' onClick='checkEnter(enterForm);'><a >Войти</a></span>
		
				  </form>
				</div>
			</div>
			
		</div>
		
		
	</body>
</html>



