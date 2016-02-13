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


function processprofile_form($id,$dob){
    $rows = "";
    $values = "";

    foreach($_POST as $key => $value) {

        $rows = mysql_real_escape_string($key);
        $values = mysql_real_escape_string($value);
        $entry .= "[".$rows . "::".$values."]";

    }
    // clean up the array


    $entry = preg_replace('/^\[|\d+|\:\:\]/', '', $entry);

    $query = mysql_query("INSERT INTO `customer` (`id`, `email`, `age`, `gender`, `status`, `created_at`) VALUES (NULL, '".$form_id."', '".$entry."', '".$_SESSION['manager_id']."', '0', NOW())");

 }

?>