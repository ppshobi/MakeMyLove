<?php
function register(){
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$uname=$_POST['name'];
	$pass=$_POST['pass'];
	$email=$_POST['email'];
	$day=$_POST['day'];
	$month=$_POST['month'];
	$year=$_POST['year'];
	$dob=$day ."-".$month."-" ."$year" ;
	$gender=$_POST['gender'];
	require_once("/includes/dbconn.php");

	$sql = "INSERT INTO users (id, username, password, email, dateofbirth, gender) VALUES ('', '$uname', '$pass', '$email', $dob, '$gender')";

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


function processprofile_form($id){
   
	$fname=$_POST['fname'];
	$lname=$_POST['lname'];
	$email=$_POST['email'];
	$sex=$_POST['sex'];
	
		$day=$_POST['day'];
		$month=$_POST['month'];
		$year=$_POST['year'];
		$dob=$day ."-" . $month . "-" .$year ;
	
	$religion=$_POST['religion'];
	$caste = $_POST['caste'];
	$sub_caste=$_POST['subcaste'];
	$age=$_POST['age'];
	
	require_once("/includes/dbconn.php");
	 $sql = "INSERT INTO customer (id, email, age, sex, religion, caste, subcaste) VALUES ('', '$email', '$age', '$sex', '$religion', '$caste', '$sub_caste')";

	if (mysqli_query($conn,$sql)) {
	  echo "Successfully Updated profile";
	  echo "<a href=\"userhome.php\">";
	  echo "Back to home";
	  echo "</a>";
	} else {
	  echo "Error: " . $sql . "<br>" . $conn->error;
	}
}
?>