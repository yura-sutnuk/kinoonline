		
        <div id="top" >
			<a href='/'><img src='/views/images/logo.png'></a>
			<div id='topRight'>
				<?php if(!isset($_SESSION['login'])):?>
				   
					 <a href='enter' class='paddingHorizontal'> вход </a> | <a href='/registration' class='paddingHorizontal'> зарегистрироваться </a>
				  
				  <?php else: ?>
				  
					<a href='exit' class='paddingHorizontal'> выход </a>     <span class='paddingHorizontal user' onMouseOut='hideMenu()' onMouseOver = 'showMenu()'><?php echo $_SESSION['login'];?>
					<div id="menu" >
						<ul id='menuColumn' >
							<li><a href='/profile/<?php echo $_SESSION['id'].'/';?>'>Профайл</a></li>
							<li><a href='/favorites/<?php echo $_SESSION['id'].'/';?>'>Избранное</a></li>
							<?php if($_SESSION['login']=='Admin'):?>
								<li><a href='/addmovie/'>Добавить фильм</a></li>
							<?php endif;?>
						</ul>
					</div>
					</span>
				  <?php endif;?>	
				<form name='searchForm' action='/controllers/mainController.php' method='POST' style="display:inline">
					<input style='color:black;' type="text" name="search" value="" placeholder='Search' />
					<a onClick='Submit(searchForm)'> Найти </a>
				</form>
			</div>
		</div>
		
		