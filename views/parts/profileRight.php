<div id="profileRight">
				<form action='/controllers/userController.php' method='POST' enctype="multipart/form-data" name='form'>
					<h3 class='profileHeader'>Профайл</h3>
					<table border='0' cellspacing='5' cellpadding='5' class='profileTable'>
						<tr>
							<td align='right'>Имя:</td>
							<td><span><?php echo !empty($userExtra['name']) ? $userExtra['name'] : 'Не указано' ?></span></td>
						</tr>
						<tr>
							<td align='right'>Фамилия:</td>
							<td><span><?php echo !empty($userExtra['surname']) ? $userExtra['surname'] : 'Не указано'?></span></td>
						</tr>
						<tr>
							<td align='right'>Место жительства: </td>
							<td><span><?php echo !empty($userExtra['location']) ? $userExtra['location'] : 'Не указано'?></span></td>
						</tr>
						<tr>
							<td align='right'>Пол:</td>
							<td><input type='radio' name='sex' value='man' <?php if($userExtra['sex']=='man') echo 'checked'?> >Мужчина <input type='radio' name='sex' value='female' <?php if($userExtra['sex']=='female') echo 'checked'?>>Женщина</td>
						</tr>
					</table>
					<h3 class='profileHeader'>Контакты</h3>
					<table border='0' cellspacing='5' cellpadding='5' class='profileTable'>
						<tr>
							<td align='right'>Email:</td>
							<td width='171'><span><?php  echo !empty($userData['email']) ? $userData['email'] : 'Не указано';?></span></td>
						</tr>
						<tr>
							<td align='right'>VK id:</td>
							<td><span><?php  echo !empty($userExtra['vkid']) ? $userExtra['vkid'] : 'Не указано';?></span></td>
						</tr>
						<tr>
							<td align='right'>Skype login:</td>
							<td><span><?php  echo !empty($userExtra['skype']) ? $userExtra['skype'] : 'Не указано';?></span></td>
						</tr>
					</table>
					
					<input type='hidden' name='profileSave' value='1'>
					<input type='hidden' name='id' value='<?php echo $id ?>'>
				
				</form>
				
			</div>