<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php foreach($friendInfo as $friend):?>
<img id="pp" src="<?php echo base_url()."/uploads/".$friend['pic']; ?>"/>
<h2 class="text-center">Welcome to <?php echo $friend['fname']." ".$friend['lname'] ?> Profile</h2>
        <?php endforeach; ?>

</body>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/bootstrap.min.js"></script>
</html>