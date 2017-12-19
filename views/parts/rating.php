<div class='rating'>
					
	<?php for($i=0;$i<5;$i++):?>
		<?php if($i<$filmData['avgRating']):?>
			<a <?php if(isset($_SESSION['id'])) {echo 'onClick=changeRating('.  $filmData['id'].','.$_SESSION['id'].','. ($i+1) .')';}?>  style='display:inline; cursor: pointer'><img src='/views/images/rate1.png'></a>
		<?php else:?>
			<a <?php if(isset($_SESSION['id'])) echo 'onClick=changeRating('.  $filmData['id'].','.$_SESSION['id'].','. ($i+1) .')';?>  style='display:inline; cursor: pointer'><img src='/views/images/rate2.png'></a>
		<?php endif; ?>
	<?php endfor;?>
							
</div>