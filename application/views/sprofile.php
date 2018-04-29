<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php foreach ($users as $post) { ?>
			<h1 style="text-align: center;"><?php echo $post->username; ?>'s profile</h1>
	<?php } ?>
</body>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/bootstrap.min.js"></script>
</html>