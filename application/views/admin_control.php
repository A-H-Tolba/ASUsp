<h1  style="text-align: center;">Admin Control Panel</h1>
<center><form  action="<?php echo base_url(); ?>Welcome/ad_search" method="post">
	<input type="text" name="username" placeholder="search_by_userName">
	<input type="submit" name="submit" value="Search">
</form></center>
<center><form  action='<?php echo base_url(); ?>Welcome/delete' method='post'>
<?php
$con=mysqli_connect("localhost","root","","asusp");
// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$result = mysqli_query($con,"SELECT * FROM users");

echo "<h3 align='center'>Current Users</h3>	
<table border='1' align='center'>
<tr>
<th>id</th>
<th>username</th>
<th>email</th>
<th>password</th>
</tr>";

while($row = mysqli_fetch_array($result))
{
	if((int)$row['id'] != 0){
		echo "<tr>";
		echo "<td>" . $row['id'] . "</td>";
		echo "<td>" . $row['username'] . "</td>";
		echo "<td>" . $row['email'] . "</td>";
		echo "<td>" . $row['password'] . "</td>";
		echo "</tr>";
	}
}
echo "</table>";
$result = mysqli_query($con,"SELECT * FROM users");

echo "<br><p align='center'>
Select User to delete :
<input type='text' name='delid' list='userdel'>
<datalist id='userdel'>
  <option value=''>Select...</option>";
  while($row = mysqli_fetch_array($result))
{
  echo "<option value=".$row['id'].">".$row['id'] ."</option>";
 }
echo "</datalist>
</p>
<input type='submit' name='delete' value='delete'>";

mysqli_close($con);
?>
</form></center>