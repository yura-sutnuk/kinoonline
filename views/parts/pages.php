<div id='pages'>
					<center >
						<?php if($currentPage!=1): ?>
							<?php if($currentPage-2==1):?>
								<a class='page' href ='/<?php echo $linkHref ; echo 1 ?>/' >1</a>	
							<?php endif;?>
							<?php if($currentPage-2>1):?>
								<a class='page' href ='/<?php echo $linkHref ; echo 1 ?>/' >1</a>
								<span> ... </span>
							<?php endif;?>
							<?php if($currentPage-2>1):?>
								<a class='page' href='/<?php echo $linkHref ; echo $currentPage-2 ?>/'><?php echo $currentPage-2 ?></a>
							<?php endif;?>
							
							<a class='page' href='/<?php echo $linkHref ; echo $currentPage-1 ?>/'><?php echo $currentPage-1 ?></a>
							<a class='page active' id='currentPage' href='/<?php echo $linkHref ; echo $currentPage ?>/'><?php echo $currentPage ?></a>
							<?php if($currentPage+1<=$pageCount):?>
								<a class='page' href='/<?php echo $linkHref; echo $currentPage+1 ?>/'><?php echo $currentPage+1 ?></a>
							<?php endif;?>
							<?php if($currentPage+2<=$pageCount):?>
								<a class='page' href='/<?php echo $linkHref; echo $currentPage+2 ?>/'><?php echo $currentPage+2 ?></a>
							<?php endif;?>
							<?php if($currentPage+2<$pageCount):?>
								<span>...</span>
								<a class='page' href='/<?php echo $linkHref ; echo $pageCount ?>/'><?php echo $pageCount ?></a>
							<?php endif;?>
						<?php else:?>
							<a class='page active' id='currentPage' href='/<?php echo $linkHref ; ?>1/'>1</a>
							<?php if($currentPage+1 <= $pageCount):?>	
								<a class='page' href='/<?php echo $linkHref; ?>2/'>2</a>
							<?php endif; ?>
								
							<?php if($currentPage+2 <= $pageCount):?>
								<a class='page' href='/<?php echo $linkHref ; ?>3/'>3</a>
							<?php endif;?>
							
							<?php  if($currentPage+2 < $pageCount):?>
								<span>...</span>
								<a class='page' href='/<?php echo $linkHref ; echo $pageCount ?>/'><?php echo $pageCount ?></a>
							<?php endif; ?>
							
						<?php endif; ?>
						
					</center>
				</div>