<h1>View detail</h1>

<?php
while($row = mysqli_fetch_array($registerView))
{
	echo $row['f_name']. " ".$row['l_name'].'<br/>';
	echo $row['email'].'<br/>';
}
?>