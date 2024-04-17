<?php
$facebook= get_setting('Facebook');
$twitter = get_setting('Twitter');
$soundCloud = get_setting('SoundCloud');
$pinterest= get_setting('Pinterest');
$instagram = get_setting('Instagram');
$vimeo = get_setting('Vimeo');
$youtube = get_option('Youtube'); 
 ?>
 
<?php if($facebook!="#") { ?><a href="<?php echo $facebook;?>" target="_blank"><i class="fa fa-facebook"></i></a><?php } ?>
<?php if($twitter!="#") { ?><a href="<?php echo $twitter;?>" target="_blank"><i class="fa fa-twitter"></i></a><?php } ?>
<?php if($soundCloud!="#") { ?><a href="<?php echo $soundCloud;?>" target="_blank"><i class="fa fa-soundcloud" aria-hidden="true"></i></a><?php } ?>
<?php if($pinterest!="#") { ?><a href="<?php echo $pinterest;?>" target="_blank"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a><?php } ?>
<?php if($instagram!="#") { ?><a href="<?php echo $instagram;?>" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a><?php } ?>
<?php if($vimeo!="#") { ?><a href="<?php echo $vimeo;?>" target="_blank"><i class="fa fa-vimeo" aria-hidden="true"></i></a><?php } ?>
<?php if($youtube!="#") { ?><a href="<?php echo $youtube;?>" target="_blank"><i class="fa fa-youtube" aria-hidden="true"></i></a><?php } ?>