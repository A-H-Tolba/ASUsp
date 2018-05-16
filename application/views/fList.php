<h1  style="text-align: center;">Friend List</h1>
<!-- <center><form  action="<?php echo base_url(); ?>Welcome/ad_search" method="post">
	<input type="text" name="username" placeholder="search_by_userName">
	<input type="submit" name="submit" value="Search">
</form></center> -->
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php for ($i=0; $i <sizeof($friends); $i+=3) {
		echo '<br><a href="'.base_url().'Welcome/getFriend/'.$friends[$i].'">'.'<h2 style="text-align: center;">'. $friends[$i+1].'</h2>' .'</a>'.'<img id="pp" src="'.base_url().'/uploads/'.$friends[$i+2].'" />';
					
 } ?>

</body>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/bootstrap.min.js"></script>
</html>