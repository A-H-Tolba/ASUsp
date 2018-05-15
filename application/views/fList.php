<h1  style="text-align: center;">Friend List</h1>
<center><form  action="<?php echo base_url(); ?>Welcome/ad_search" method="post">
	<input type="text" name="username" placeholder="search_by_userName">
	<input type="submit" name="submit" value="Search">
</form></center>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
	<?php
		echo "<table border='1' align='center'>
		<tr>
		<th>username</th>
		<th>Picture</th>
		</tr>";
	?>
<?php foreach ($friends as $post) { 
			
				if((int)$post->id){
						echo "<tr>";
						echo "<td>" .'<a href="'.base_url().'Welcome/getFriend/'.$post->id.'">'. $post->username . "</a></td>";
						echo "<td>" . $post->pic . "</td>";
						echo "</tr>";
					}
 } ?>
<?php
echo "</table>";
$con=mysqli_connect("localhost","root","","asusp");
// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

mysqli_close($con);
?>
</body>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/bootstrap.min.js"></script>
</html>