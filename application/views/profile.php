	<h1 style="text-align: center;">Welcome <?php echo $session['email'] ?></h1>

<form action="<?php echo base_url(); ?>Welcome/search" method="post">
	<input type="text" name="username" placeholder="search_by_userName">
	<input type="submit" name="submit" value="Search">
</form>
<hr>
<form action="<?php echo base_url(); ?>Welcome/create_post" method="post" >
	<h3>Add Post</h3>
  <input name="body">
  <button type="submit">Post</button>
</form>
<?php foreach($posts as $post):?>
        
        <h2 style="text-align: center;"> <?php echo $post['content'];?> 
		<h4 style="text-align: center;"><?php echo $post['comments'];?></h4>
	<!-- <button id = "commentBtn" onclick="return addComment()">Comment</button> -->
		<div id="commentDiv" style="text-align: center;">
		<?php $liked = $post['likes']; ?>
		<input type="button" style = "color:blue;" value = "Like" id="likeBtn" onclick="window.location='<?php echo site_url("Welcome/Like/".$post['id']);?>'" class="btn btn-md btn-default"></input>
		<br>
		<br>
		<?php echo form_open('Welcome/addComment/'.$post['id']); ?>
		<input type="text" name = "comment" placeholder="add comment" >
		<input type="submit" name="submit" value="Comment">
		</form>
	</div></h2>
		
	
</h3>
<br> 
        <?php endforeach; ?>
</body>
<script>
	function like()
	{
		window.location='<?php echo site_url("Welcome/Like/".$post['id']);?>'
		var liked= "<?php echo $liked; ?>";
		var z = document.getElementById("likeBtn");
		if(liked == '0')
		{
			z.style.color="black";
			z.content = "like";
		}
		else
		{
			z.style.color="blue";
			z.content = "liked";
		}
	}
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/bootstrap.min.js"></script>
</html>



