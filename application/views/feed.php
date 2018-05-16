<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<form id="wpost" action="<?php echo base_url(); ?>Welcome/create_post" method="post" >
  <textarea name="body" rows="5"></textarea>
  <button type="submit">Post</button>
</form>
<?php 
	function getColor($num)
	{
		if($num != '1')
		{
			return '#000000';
		}
		else
		{
			return '#0000FF';
		}
	}

	function getValue($num)
	{
		if($num != '1')
		{
			return 'like';
		}
		else
		{
			return 'liked';
		}
	}
?>

<?php foreach(array_reverse($posts) as $post):?>
	    
	<div id="rpost"><p><?php echo nl2br($post['post']);?></div>
	<p style="text-align: center;"><?php echo nl2br($post['comments']);?></p>
	<!-- <button id = "commentBtn" onclick="return addComment()">Comment</button> -->
		<div id="commentDiv" style="text-align: center;">
		<?php $liked = $post['likes_num']; 
			echo "<h4 style = 'color:white;'>".$liked." People like this</h4>";
			echo "<br><br>";
		?>
		<input type="button" style="color: <?=getColor($liked)?>;" value = "<?=getValue($liked)?>" id="likeBtn" onclick="window.location='<?php echo site_url("Welcome/Like/".$post['id']);?>'" class="btn btn-md btn-default"></input>
		<br>
		<br>
		<?php echo form_open('Welcome/addComment/'.$post['id']); ?>
		<input type="text" name = "comment" placeholder="add comment" >
		<input type="submit" name="submit" value="Comment">
		</form>
	</div></p>
		
<br/> 
        <?php endforeach; ?>

<!--
<?php /*foreach(array_reverse($fPosts) as $post):?>
        
        <div id="rpost"><p><?php echo nl2br($post['content']);?></div>
		<p style="text-align: center;"><?php echo nl2br($post['comments']);?></p> -->
	<!-- <button id = "commentBtn" onclick="return addComment()">Comment</button> --><!--
		<div id="commentDiv" style="text-align: center;">
		<?php $liked = $post['likes']; 
			
		?>
		<input type="button" style="color: <?=getColor($liked)?>;" value = "<?=getValue($liked)?>" id="likeBtn" onclick="window.location='<?php echo site_url("Welcome/Like/".$post['id'].'/'.$post['table']);?>'" class="btn btn-md btn-default"></input>
		<br>
		<br>
		<?php echo form_open('Welcome/addComment/'.$post['id'].'/'.$post['table']); ?>
		<input type="text" name = "comment" placeholder="add comment" >
		<input type="submit" name="submit" value="Comment">
		</form>
	</div></p>

<br/> 
        <?php endforeach; */?>-->
</body>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/bootstrap.min.js"></script>
</html>
