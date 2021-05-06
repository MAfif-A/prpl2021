<?php 
class database{
	var $host = "localhost";
	var $email = "root";
	var $password = "";
	var $database = "sign";
	var $koneksi;
 
	function __construct(){
		$this->koneksi = mysqli_connect($this->host, $this->email, $this->password,$this->database);
	}
 
 
	function register($password,$email)
	{	
		$insert = mysqli_query($this->koneksi,"insert into user values ('''$password','$email')");
		return $insert;
	}
 
	function login($email,$password,$remember)
	{
		$query = mysqli_query($this->koneksi,"select * from user where email='$email'");
		$data_user = $query->fetch_array();
		if(password_verify($password,$data_user['password']))
		{
			
			if($remember)
			{
				setcookie('email', $email, time() + (60 * 60 * 24 * 5), '/');
			}
			$_SESSION['email'] = $email;
			$_SESSION['is_login'] = TRUE;
			return TRUE;
		}
	}
 
	function relogin($email)
	{
		$query = mysqli_query($this->koneksi,"select * from user where email='$email'");
		$data_user = $query->fetch_array();
		$_SESSION['email'] = $email;
		$_SESSION['is_login'] = TRUE;
	}
} 
 
 
?>