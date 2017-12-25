<div id='video'>
						<div>
							<?php if($filmData['totalSeries']>5):?>
								<div id='prev' style='float:left' onClick='move(1)'><img src = '/views/images/left.jpg' alt='left'> </div>
							<?php endif;?>
							<div class='seriesList'>
								<ul name='series' style='width:600;display:inline' > 
								
										<li style='position:absolute;left: 0px' onClick='load("<?php echo $filmData['series'][0]['src'].'",'.$filmData['series'][0]['id']?>,this)' id='<?php echo $filmData['series'][0]['id']?>' class='Series active'><?php echo $filmData['series'][0]['name'] ?></li>
									<?php $size = count($filmData['series']);
										for($i=1;$i<$size;$i++):?>
										<li style='position:absolute;left: <?php echo $i*90?>px' onClick='load("<?php echo $filmData['series'][$i]['src'].'",'.$filmData['series'][$i]['id']?>,this)' id='<?php echo $filmData['series'][$i]['id']?>' class='Series'><?php echo $filmData['series'][$i]['name'] ?></li>			
									<?php endfor; ?>
								</ul>
							</div>
							<?php if($filmData['totalSeries']>5):?>
								<div id='next' style='float:left' onClick='move(-1)'><img src = '/views/images/right.jpg' alt='right'></div>
							<?php endif;?>
						</div>
						<iframe id='frame' src="<?php echo $filmData['series'][0]['src'];?>" width="632" height="305" frameborder="0" style="z-index:2147483647;" allowfullscreen></iframe>
					
					</div>