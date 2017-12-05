
        <div id="top" align="right" >
	    <?php if(!isset($_SESSION['login']))
			  {  
			    echo "<a href='enter' > вход </a> | <a href='/registration'> зарегестрироваться </a>";
			  }
			  else
			  {
			    echo "<a href='exit' > выход </a>     ".$_SESSION['login'];
			  }
	    ?>
			  <input type="text" name="search" value="Search"/> 
		</div>