<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
		<div class="container-fluid">
		<form name="myForm" autocomplete="off" enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>Welcome/signup">
			<input type="text" name="username" class="form-control" placeholder="Username">
			<input type="email" name="email" class="form-control" placeholder="E-Mail">
			<input type="password" name="password" class="form-control" placeholder="Password">
			<button type="submit">Submit</button>
		</form>
		</div>
		
</body>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/bootstrap.min.js"></script>
</html>