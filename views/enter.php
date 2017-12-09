<html>
	<head>
		<title> KINOONLINE </title>
		<link rel="stylesheet" type="text/css" href="/views/style.css">
		<link rel="stylesheet" type="text/css" href="/views/userStyle.css">
	</head>
	
	<body>
		<?php include 'parts/top.php';?>
		
		<div id="content" >
			<div class='userContainer'>
			  <form action='/controllers/userController.php' method='POST' class='userForm">
				<table class='userTable'>
				  <tr >
					<td align='right' >Логин</td>
					<td><input type='text' name='login' class='text' </td>
				  </tr>	
				  <tr >
					<td align='right'>Пароль</td>
					<td><input type='text' name='password' class='text' </td>
				  </tr>	
				  <tr>
					<td colspan='2' align='center'>
					  <input type="submit" name="enter" value="Войти" class="button">
					 
					</td>
				  </tr>
				</table>
				
			  </form>
			</div>
		</div>
		
		
	</body>
</html>



