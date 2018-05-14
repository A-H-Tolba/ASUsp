<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php foreach ($users as $post) { ?>
			<a href="<?php echo base_url(); ?>Welcome/account?<?php echo $post->id ?>"><h1 style="text-align: center;">
				<?php echo $post->fname." ".$post->lname; ?>'s profile</h1></a>
	<?php } ?><br>
	<a href="<?php echo base_url(); ?>Welcome/pending_requests?c=<?php echo $post->id ?>"><h1 style="text-align: center;">
				Add Friend</h1></a>
	}?>
</body>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/bootstrap.min.js"></script>
</html>





 
 
<a href="{{route(friend.add',['username'=>$user->username])}}" class="btn btn-primary">Add as friend </a>
