<html>
	<head>
		<title> KINOONLINE </title>
		<link rel="stylesheet" type="text/css" href="/views/style.css">
		<script src='/views/check.js' > </script>
		
		<script  type="text/javascript" src='/views/script.js'></script>
		<!--<link rel="stylesheet" type="text/css" href="/views/userStyle.css">-->
	</head>
	
	<body>
		<?php include 'parts/top.php';?>
		
		<div id="content" >
		
			<?php include ROOT.'/views/parts/leftContent.php';?>
			<div id='right'>
				<h2 style='margin:10; margin-left:90'> Регистрация </h2>
				<form action='/controllers/userController.php' method='POST' name='registr' class='userForm'>
					<input type='hidden' name='registration' value='' >
					
					<!--<p class='userP'>Логин</p>-->
					<input type='text' name='login' class='Text extra floatLeft clearLeft' placeholder='Логин'>
					<div class='floatLeft' id='errorLogin'> </div>
					<!--<p class='userP'>Пароль</p>-->
					<input type='password' name='password' id='pass1' class='Text extra floatLeft clearLeft' placeholder='Пароль'>
					<div class='floatLeft' id='errorPass1'> </div>
					<!--<p class='userP'>Повторите пароль</p> -->
					<input type='password' name='password' id='pass2' class='Text extra floatLeft clearLeft' placeholder='Повторите пароль'>
					<div class='floatLeft' id='errorPass2'> </div>
					<!--<p class='userP'>E-mail</p> -->
					<input type='email' name='email' class='Text extra floatLeft clearLeft' placeholder='Email' > 
						<div class='floatLeft' id='errorEmail'></div>
					<span class='Button floatLeft' style='margin-left:100; clear:both; ' onClick='checkRegistration(registr);'><a >Регистрация</a></span>
					 

				
			  </form>
		  </div>
		</div>
		
		
	</body>
</html>



