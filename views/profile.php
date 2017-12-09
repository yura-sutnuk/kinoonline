<html>
	<head>
		<title> KINOONLINE </title>
		<link rel="stylesheet" type="text/css" href="/views/style.css">
		<link rel="stylesheet" type="text/css" href="/views/profileStyle.css">
	</head>
	
	<body>
		<?php include 'parts/top.php';?>
		
		<div id="content" >
			<div id='profileLeft'>
				<center><h3 class='profileHeader'>Аватар</h3></center>
				<img src="/views/images/avatars/<?php echo $userData['avatar']; ?>" class='profileAvatar' width='200' height='200'>
				<center><p class='profileText'>Логин: <span class='paddingHorizontal'><?php echo $userData['login']; ?></span> </p></center>
				<center><p class='profileText'>Зарегестрирован: <span class='paddingHorizontal'><?php echo $userData['registerDate'];?> </span></p></center>		
				<p class='profileText'>Данная страница формирует фаш профиль который может видеть любой зарегестрированный пользователь.</p>
				<br>
				<p class='profileText'>Если вы хотите завести друзей киноманов советуем серьезно отнестись к заполнению данной информации </p>
			</div>
			<div id="profileRight">
				<form action='' method='POST' enctype="multipart/form-data">
					<h3 class='profileHeader'>Профайл</h3>
					<table border='0' cellspacing='5' cellpadding='5' class='profileTable'>
						<tr>
							<td align='right'>Имя:</td>
							<td><input type='text' name='name' class="text" value='<?php echo(isset($userExtra['name']))?  $userExtr['name'] :   ''?> '></td>
						</tr>
						<tr>
							<td align='right'>Фамилия:</td>
							<td><input type='text' name='surname' class="text" value='<?php echo(isset($userExtra['surname']))?  $userExtr['surname'] :   ''?> '></td>
						</tr>
						<tr>
							<td align='right'>Место жительства: </td>
							<td><input type='text' name='location' class="text" value='<?php echo(isset($userExtra['location']))?  $userExtr['location'] :   ''?> '></td>
						</tr>
						<tr>
							<td align='right'>Пол:</td>
							<td><input type='radio' name='sex' value='man'>Мужчина <input type='radio' name='sex' value='female'>Женщина</td>
						</tr>
					</table>
					<h3 class='profileHeader'>Контакты</h3>
					<table border='0' cellspacing='5' cellpadding='5' class='profileTable'>
						<tr>
							<td align='right'>Email:</td>
							<td><input type='text' name='email' class="text" value='<?php echo(isset($userData['email']))?  $userData['email'] :   ''?> '></td>
						</tr>
						<tr>
							<td align='right'>VK id:</td>
							<td><input type='text' name='vkId' class='text' value='<?php echo(isset($userExtra['vkid']))?  $userExtr['name'] :   ''?> '></td>
						</tr>
						<tr>
							<td align='right'>Skype login:</td>
							<td><input type='text' name='skype' class='text' value='<?php echo(isset($userExtra['skype']))?  $userExtr['skype'] :   ''?> '></td>
						</tr>
					</table>
					
				</form>
			</div>
		</div>
		
		
	</body>
</html>



