<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!--
	<h1 style="text-align: center;">Welcome <?php //echo $session['email'] ?></h1>
-->
<form action="<?php echo base_url(); ?>Welcome/search" method="post">
	<input type="text" name="username" placeholder="search_by_userName">
	<input type="submit" name="submit" value="Search">
</form>
<hr>
<img id="pp" src="<?php echo base_url()."/uploads/".$session['pic']; ?>"/>
<p id="wp">Welcome to <?php echo $session['user_name']; ?>'s profile.</p>
<br/>
<p>Latest posts</p>
<?php foreach(array_reverse($myposts) as $post):?>
	    
	<div id="rpost"><p><?php echo nl2br($post['post']);?></div>
	<p style="text-align: center;"><?php echo nl2br($post['comments']);?></p>
	<!-- <button id = "commentBtn" onclick="return addComment()">Comment</button> -->
		<div id="commentDiv" style="text-align: center;">
		
		<?php echo form_open('Welcome/addComment/'.$post['id']); ?>
		<input type="text" name = "comment" placeholder="add comment" >
		<input type="submit" name="submit" value="Comment">
		</form>
	</div></p>
		
<br/> 
        <?php endforeach; ?>
</body>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/bootstrap.min.js"></script>
</html>



