	<h1 style="text-align: center;">Welcome <?php echo $session['email'] ?></h1>

	
<?php foreach($posts as $post):?>
        
        <h2 style="text-align: center;"> <?php echo $post['content'];?> 
		<h4 style="text-align: center;"><?php echo $post['comments'];?></h4>
	<!-- <button id = "commentBtn" onclick="return addComment()">Comment</button> -->
		<div id="commentDiv" style="text-align: center;">
		<button id="likeBtn" onclick="return like()" class="btn btn-md btn-default">like</button>
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

	
	<form action="<?php echo base_url(); ?>Welcome/search" method="post">
	<input type="text" name="username" placeholder="search_by_userName">
	<input type="submit" name="submit" value="Search">
</form>
</body>
<script>
	function addComment()
	{
		var y = document.getElementById("commentDiv");
		if(y.style.display=="none")
		{
			y.style.display = "block";
		}
		else
		{
			y.style.display = "none";
		}

		
	}
	function like()
	{
		var z = document.getElementById("likeBtn");
		if(z.style.color=="blue")
		{
			z.style.color="black";
		}
		else
		{
			z.style.color="blue";
		}
	}
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/bootstrap.min.js"></script>
</html>