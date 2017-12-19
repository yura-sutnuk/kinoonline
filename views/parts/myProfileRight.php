<div id="profileRight">
				<form action='/controllers/userController.php' method='POST' enctype="multipart/form-data" name='form'>
					<h3 class='profileHeader'>Профайл</h3>
					<table border='0' cellspacing='5' cellpadding='5' class='profileTable'>
						<tr>
							<td align='right'>Имя:</td>
							<td><input type='text' name='name' class="text" value='<?php echo $userExtra['name'];?>'></td>
						</tr>
						<tr>
							<td align='right'>Фамилия:</td>
							<td><input type='text' name='surname' class="text" value='<?php echo $userExtra['surname'];?>'></td>
						</tr>
						<tr>
							<td align='right'>Место жительства: </td>
							<td><input type='text' name='location' class="text" value='<?php echo $userExtra['location'];?>'></td>
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
							<td><input type='text' name='email' class="text" value='<?php echo $userData['email'];?>'></td>
						</tr>
						<tr>
							<td align='right'>VK id:</td>
							<td><input type='text' name='vkId' class='text' value='<?php echo $userExtra['vkid'];?>'></td>
						</tr>
						<tr>
							<td align='right'>Skype login:</td>
							<td><input type='text' name='skype' class='text' value='<?php echo $userExtra['skype'];?>'></td>
						</tr>
					</table>
					
					<input type='hidden' name='profileSave' value='1'>
					<input type='hidden' name='id' value='<?php echo $id ?>'>
					<center><a class='link ' href="#" onClick='Submit(form);'> Сохранить </a></center>
				</form>
				
			</div>