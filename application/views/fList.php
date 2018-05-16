<h1  style="text-align: center;">Friend List</h1>
<!-- <center><form  action="<?php echo base_url(); ?>Welcome/ad_search" method="post">
	<input type="text" name="username" placeholder="search_by_userName">
	<input type="submit" name="submit" value="Search">
</form></center> -->
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php foreach ($friends as $friend) {
	# code...

		echo '<br><a href="'.base_url().'Welcome/getFriend/'.$friend['id'].'">'.'<h2 style="text-align: center;">'. $friend['username'].'</h2>' .'</a>'.'<img id="pp" src="'.base_url().'/uploads/'.$friend['pic'].'" />';
					
 } ?>

</body>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/bootstrap.min.js"></script>
</html>