<?php
require_once 'models/connect.php';
class Register_Model 
{
	public $con;
	public function  __construct() 
	{
		$this->con=mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		if (mysqli_connect_errno())
		{
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
	}
	public function getListRegisters() 
	{
		$query="SELECT * FROM info";
		$result = mysqli_query($this->con,$query);
		return $result;
	}
	
	public function getRegister($id) 
	{ 
		require_once 'models/connect.php';
		$query="SELECT * FROM info where id='$id'";
		$result = mysqli_query($con,$query);
		return $result;
	} 
	static function checkEmail($email)
	{
		$email=mysql_real_escape_string(trim($email));
		$query="SELECT * FROM info WHERE email='$email'";
		$result=mysql_query($query) or die("check email.".mysql_error());
		$num=mysql_num_rows($result);
		return $num;
	}
	static function addNewUser( $f_name,$l_name,$email,$pass)
	{
		require_once 'models/connect.php';
		$f_name=mysql_real_escape_string(trim($f_name));
		$l_name=mysql_real_escape_string(trim($l_name));
		$email=mysql_real_escape_string(trim($email));
		$pass=mysql_real_escape_string(trim($pass));
		$query="INSERT INTO info(f_name,l_name,email,pass)
		VALUE ('$f_name','$l_name', '$email','$pass')";
		//$results=mysql_query($query) or die("addNewUser :".mysql_error());
		mysqli_query($con,$query);
		return $results;
	}
}  
?>
