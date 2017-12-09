
        <div id="top" align="right" >
	    <?php if(!isset($_SESSION['login']))
			  {  
			    echo "<a href='enter' class='paddingHorizontal'> вход </a> | <a href='/registration' class='paddingHorizontal'> зарегестрироваться </a>";
			  }
			  else
			  {
			    echo "<a href='exit' class='paddingHorizontal'> выход </a>     <a class='paddingHorizontal' href='/profile/".$_SESSION['id']."'>".$_SESSION['login']."</a>";
			  }
	    ?>
			  <input type="text" name="search" value="Search"/> 
		</div>