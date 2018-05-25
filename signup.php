<?php


 $username = $_POST['username'];
 $password = $_POST['password'];
$email=$_POST['email'];

$host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'crearmonde';

if(!empty($username) && !empty($password) && !empty($email) ){
$conn = new mysqli($host, $db_user, $db_pass, $db_name);
$query = "INSERT INTO profile VALUES ('','".$email."','".$username."','".$password."')";
$result = $conn->query($query);
}
else{
	header('Location:signupform.php');
}

if($result){
 header('Location: loginform.php');
}else{
echo "Data insertion failed";
}


?>