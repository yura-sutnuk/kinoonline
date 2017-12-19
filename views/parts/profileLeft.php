	
			<div id='profileLeft'>
				<center><h3 class='profileHeader'>Аватар</h3></center>
				<form action='/controllers/userController.php' method='POST' name='ava' enctype="multipart/form-data">
					<input name='newAvatar' type='file' class='hiddenElement' onChange='changeAvatar(newAvatar)' accept="image/*,image/jpeg">
					<img <?php if(isset($_SESSION['id']) && $_SESSION['id']==$id) echo "onClick='fileSelect(newAvatar);'"?> src="/views/images/avatars/<?php echo $userData['avatar']; ?>" class='profileAvatar' width='200' height='200'>
					
					<input type='hidden' name='id' value='<?php echo $id ?>' >
				</form>
				<center><p class='profileText'>Логин: <span class='paddingHorizontal'><?php echo $userData['login']; ?></span> </p></center>
				<center><p class='profileText'>Зарегестрирован: <span class='paddingHorizontal'><?php echo $userData['registerDate'];?> </span></p></center>		
				<p class='profileText'>Данная страница формирует ваш профиль который может видеть любой пользователь поэтому не советуем указывать слишком личную информацию.</p>
				
			</div>