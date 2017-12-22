<div class='rating' id='rating<?php echo $filmData['id'];?>'>
					
	<?php for($i=0;$i<5;$i++):?>
		<?php if($i<$filmData['avgRating']):?>
			<img <?php if(isset($_SESSION['id'])) {echo 'onClick=changeRating('.  $filmData['id'].','.$_SESSION['id'].','. ($i+1) .')';}?>  style='display:inline; cursor: pointer' src='/views/images/rate1.png'>
		<?php else:?>
			<img <?php if(isset($_SESSION['id'])) echo 'onClick=changeRating('.  $filmData['id'].','.$_SESSION['id'].','. ($i+1) .')';?>  style='display:inline; cursor: pointer' src='/views/images/rate2.png'>
		<?php endif; ?>
	<?php endfor;?>
							
</div>