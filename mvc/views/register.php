<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script language="javascript" type="text/javascript" src="../scripts/process.js"></script>
</head>
<body>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>?controller=register&action=add">
	<table>
		<tr>
			<td>First name:</td>
			<td><input type="text" name="f_name" id="f_name" /></td>
		</tr>
		<tr>
			<td>Last name</td>
			<td><input type="text" name="l_name" id="l_name" /></td>
		</tr>
		<tr>
			<td>Email</td>
			<td><input type="text" name="email" id="email" /></td>
		</tr>
		<tr>
			<td>Password</td>
			<td><input type="password" name="pass" id="pass" /></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" name="btn_submit" value="Submit"/></td>
		</tr>
		<tr>
			<td colspan="2"><?php if (isset($_POST["btn_submit"])) echo $message;?></td>
		</tr>
	</table>
</form>
</body>
</html>