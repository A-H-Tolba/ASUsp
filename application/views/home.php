<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
		<div id="frm" class="prof">
			<form name="myForm" autocomplete="off" enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>Welcome/signup">
			<input type="text" name="fname" class="form-control name" placeholder="First name" />
			<input type="text" name="lname" class="form-control name" placeholder="Last name" />
			<input type="email" name="email" class="form-control" placeholder="E-Mail" />
			<input type="password" name="password" class="form-control" placeholder="Password" />
			<input type="password" name="password" class="form-control" placeholder="Re-enter password" />
			<label>Please upload a profile picture (optional)</label>
			<input type="file" name="userfile" size="20" />
			<button type="submit" class="btn btn-success">Submit</button>
		</form>
		</div>
		<!--<div class="container-fluid">
		<form name="myForm" autocomplete="off" enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>Welcome/signup">
			<input type="text" name="username" class="form-control" placeholder="Username">
			<input type="email" name="email" class="form-control" placeholder="E-Mail">
			<input type="password" name="password" class="form-control" placeholder="Password">
			<button type="submit">Submit</button>
		</form>
		</div>-->
		<!--<h3>Admin control Login</h3>
		<div class="container-fluid">
		<form name="admin_ctrl" autocomplete="off" enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>Welcome/ad_login">
			<input type="email" name="ad_email" class="form-control" placeholder="E-Mail">
			<input type="password" name="ad_password" class="form-control" placeholder="Password">
			<button type="submit">Login</button>
		</form>
		</div>-->
		
</body>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/bootstrap.min.js"></script>
</html>