	<h1 style="text-align: center;">Welcome <?php echo $session['email'] ?></h1>
	<h1 style="text-align: center;">Welcome <?php echo $session['user_id'] ?></h1>

	<!-- <h2 class = "text-center">Post one </h2>
<h3 class = "text-center">
	Hello This is a new post<br><br>
	<button id="likeBtn" onclick="return like()">like</button>
	<button id = "commentBtn" onclick="return addComment()">Comment</button>
	<div id="commentDiv" style = "display:none;">
		<br>
		<input type="text" placeholder="add comment">
		<button>Post</button>
	</div>
</h3> -->
<?php foreach($posts as $post):?>
        
        <h2 style="text-align: center;"> <?php echo $post['title'];?> </h2>
		<h2 style="text-align: center;"> <?php echo $post['body'];?> </h2>
		<h2 style="text-align: center;"> <?php echo $post['created'];?> </h2>
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