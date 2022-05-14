<?php
class Login
{
	public function __construct()
	{
	}
	public function register($user,$pass)
	{
			####################################################
			$servername='localhost';
			$dbusername='root';
			$dbpassword='';
			$dbname='chris_hacked_database';
			####################################################
			$conn=new mysqli($servername,$dbusername,$dbpassword,$dbname);
			if ($conn->connect_error) die($conn->connect_error);
			####################################################
			$query="SELECT * from login";
			$result = $conn->query($query);
			if(!$result) die($conn->error);
			####################################################
			$rows=$result->num_rows;
			
			//Relevant item we are seeking data_seek//
			//MYSQLI_NUM = Array items will use a numerical index key. MYSQLI_ASSOC = Array items will use the column name as an index key. An index is a performance optimisation feature that enables data to be accessed faster.fetch_array — Fetch a result row as an associative array, a numeric array, or both//
			for($i=0;$i<$rows;++$i)
			{
				$result->data_seek($i);
				$row=$result->fetch_array(MYSQLI_ASSOC);
				if($row['userid'] == $user)
				{	
					$result->close();
					$conn->close();
					return false;
 				}
			}
			####################################################
			$pass = password_hash($pass, PASSWORD_DEFAULT);
			#$user = mysqli_real_escape_string($conn, $user);
			####################################################
			$query="insert into login values('$user','$pass')";
			$result = $conn->query($query);
			if(!$result) die($conn->error);
			####################################################
			$conn->close();
			return true;
	}
	public function login($user,$pass)
	{
		####################################################
		$servername='localhost';
		$dbusername='root';
		$dbpassword='';
		$dbname='chris_hacked_database';
		####################################################
		$conn=new mysqli($servername,$dbusername,$dbpassword,$dbname);
		if ($conn->connect_error) die($conn->connect_error);
		
		####################################################
		$query="SELECT * from login";
		
		$result = $conn->query($query);
		if(!$result) die($conn->error);
		####################################################
		$rows=$result->num_rows;
		for($i=0;$i<$rows;++$i)
		{
			$result->data_seek($i);
			$row=$result->fetch_array(MYSQLI_ASSOC);
			$userid=	$row['userid'];
			$password=	$row['password'];
			####################### Victor
			if(($user == $userid) && (password_verify($pass, $password)))
			{
				echo 'Password Valid';
				return true;
				break;
			}
			else {
				echo 'Invalid Password';
			}
			####################### /Victor
		}
		####################################################
		$result->close();
		$conn->close();
		return false;
	}
}
?>
