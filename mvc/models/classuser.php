<?PHP
require_once 'connect.php';
class User
{ static function checkEmail($email)
	{
		$email=mysql_real_escape_string(trim($email));
		$query="SELECT * FROM info WHERE email='$email'";
		$result=mysql_query($query) or die("check email.".mysql_error());
		$num=mysql_num_rows($result);
		return $num;
	}
	static function addNewUser( $f_name,$l_name,$email,$pass)
	{
		$f_name=mysql_real_escape_string(trim($f_name));
		$l_name=mysql_real_escape_string(trim($l_name));
		$email=mysql_real_escape_string(trim($email));
		$pass=mysql_real_escape_string(trim($pass));
		$query="INSERT INTO info(f_name,l_name,email,pass)
		VALUE ('$f_name','$l_name', '$email','$pass')";
		$results=mysql_query($query) or die("addNewUser :".mysql_error());
		return $results;
	}
}

?>

