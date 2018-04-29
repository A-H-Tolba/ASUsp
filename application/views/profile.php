	<div style="height: 45%"></div>
	<h1 style="text-align: center;">Welcome <?php echo $session['email'] ?></h1>
	<form action="<?php echo base_url(); ?>Welcome/search" method="post">
	<input type="text" name="username" placeholder="search_by_userName">
	<input type="submit" name="submit" value="Search">
</form>
</body>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/bootstrap.min.js"></script>
</html>