                  <div id='commentList'>
					 <center><h3> КОМЕНТАРИИ </h3></center>
					 
					 <?php foreach ($commentData as $comment):?>
					 <div class='commentBlock'>   
					   <div class='commentLeft'>
					     <a href='/profile/<?php echo $comment['id']?>/'><img src='/views/images/avatars/<?php echo $comment["avatar"]; ?>' width='100' height='100'></a>
					     <p><?php echo $comment['login']; ?> </p>
					     <p><?php echo $comment['date']; ?></p>
					   </div>
					   <div class='commentText'>
					     <p> <?php echo $comment['text'];?>	</p>
					   </div>
					   
					 </div>
					 <?php endforeach; ?>
	
                  </div>
				  
				  					<?php 
						if(isset($_SESSION['login'])):?>
						
						<center>  <form class='commentForm'  name='comment' method='POST' action='/controllers/mainController.php'>
							<table>
							  <tr>
							    <td>
								  <input type='hidden' name='id_film' value='<?php echo $id?>'>
								</td>
							  </tr>
							  <tr>
								<td >
								  <textarea name='text' rows='11' cols='60' class='text2' id ='commentTextarea'></textarea>
								</td>
							  </tr>
							  <tr>
								<td align='center'>
								  <input type='submit' name='sendComent' value='Отправить' class='Button'>
								</td>
							  </tr>
							</table>
						  </form>
						</center>
						 <?php else: ?>
						
						  <p class='commentForm'>Коментарии доступны только для зарегестрированых пользователей</p>
						
						 <?php endif;?>