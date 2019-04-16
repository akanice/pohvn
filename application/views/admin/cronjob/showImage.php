<?php

$this->load->helper('directory'); //load directory helper

$dir = "assets/uploads"; // Your Path to folder

$map = directory_map($dir, 1); /* This function reads the directory path specified in the first parameter and builds an array representation of it and all its contained files. */
// print_r($map);die();

foreach ($map as $k){
	if (pathinfo($k, PATHINFO_EXTENSION) == 'jpg' or pathinfo($k, PATHINFO_EXTENSION) == 'png' or pathinfo($k, PATHINFO_EXTENSION) == 'jpeg') { ?>
	<img src="<?php echo base_url($dir)."/".$k;?>"  height="200"   alt="">
<?php } else {  ?> 
	<p><?php echo base_url($dir)."/".$k;?></p>
<?php } } ?>