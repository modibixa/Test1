<?php
require_once '../model/connect.php';
$message = "";
if (isset($_POST["submit"])){
$email=$_POST['email'];
$pass=$_POST['pass'];

$sel="SELECT * FROM info WHERE email='$email' AND pass='$pass'";
//echo $sel;
$result = mysql_query($sel);
$num = mysql_num_rows($result);
//echo $num;
if ($num==1) $message= "Ban da dang nhap thanh cong";

else $message= "FAILED";
}
?>

<html>
<title> </title>
<body>
<form METHOD="POST" ACTION="<?php echo $_SERVER['PHP_SELF'];?>">
<table>

<tr><td>Username:</td>
    <td><input type="text" name="email"><td>
</tr>

<tr><td>Password:</td>
    <td><input type="text" name="pass"><td>
</tr>

<tr><td><input type="submit"  name="submit" value="submit"></td>
    <td><a href="dangky.php">Create an account</a><td>
</tr>

<tr>
			<td colspan="2"><?php if (isset($_POST["submit"])) echo $message;?></td>
		</tr>

</table>
</form>
</body>
</html>