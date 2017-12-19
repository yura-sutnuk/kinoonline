		
        <div id="top" >
			<a href='/'><img src='/views/images/logo.png'></a>
			<div id='topRight'>
				<?php if(!isset($_SESSION['login'])):?>
				   
					 <a href='enter' class='paddingHorizontal'> вход </a> | <a href='/registration' class='paddingHorizontal'> зарегистрироваться </a>
				  
				  <?php else: ?>
				  
					 <a href='exit' class='paddingHorizontal'> выход </a>     <a class='paddingHorizontal' href='/profile/<?php echo $_SESSION['id'].'/';?>'><?php echo $_SESSION['login'];?></a>
				  
				  <?php endif;?>	
				<form name='searchForm' action='/controllers/mainController.php' method='POST' style="display:inline">
					<input class='' type="text" name="search" value="" placeholder='Search' />
					<a onClick='Submit(searchForm)'> Найти </a>
				</form>
			</div>
		</div>
		
		