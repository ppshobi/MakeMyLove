<?php
function register(){
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$uname=$_POST['name'];
	$pass=$_POST['pass'];
	$email=$_POST['email'];
	$day=$_POST['day'];
	$month=$_POST['month'];
	$year=$_POST['year'];
	$dob='2016-10-10';
	$gender=$_POST['gender'];
	require_once("/includes/dbconn.php");

	$sql = "INSERT INTO users (id, username, password, email, dateofbirth, gender) VALUES ('', '$uname', '$pass', '$email', CURDATE(), '$gender')";

	if (mysqli_query($conn,$sql)) {
	  echo "Successfully Registered";
	  echo "<a href=\"login.php\">";
	  echo "Login to your account";
	  echo "</a>";
	} else {
	  echo "Error: " . $sql . "<br>" . $conn->error;
	}
}
}

function isloggedin(){
	if(!isset($_SESSION['username'])){
 		header("location:login.php");
	}
}

?>