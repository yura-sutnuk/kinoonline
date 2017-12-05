                  <div id='commentList'>
					 <center><h3> КОМЕНТАРИИ </h3></center>
					 
					 <?php foreach ($commentData as $comment):?>
					 <div class='commentBlock'>   
					   <div class='commentLeft'>
					     <img src='/views/images/avatars/<?php echo $comment["avatar"]; ?>' width='100' height='100'>
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
						if(isset($_SESSION['login']))
						{echo "
						  <form class='commentForm'  name='comment' method='POST' action='/controllers/mainController.php'>
							<table>
							  <tr>
							    <td>
								  <input type='hidden' name='id_film' value='".$id."'>
								</td>
							  </tr>
							  <tr>
								<td >
								  <textarea name='text' rows='11' cols='60' class='text'></textarea>
								</td>
							  </tr>
							  <tr>
								<td align='center'>
								  <input type='submit' name='sendComent' value='Отправить' class='commentButton'>
								</td>
							  </tr>
							</table>
						  </form>";
						}
						 else
						{
						 echo  "<p class='commentForm'>Коментарии доступны только для зарегестрированых пользователей</p>";
						}
					?>