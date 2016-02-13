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

//function for upload photo

function uploadphoto($id){
	$target = "profile/". $id ."/";
if (!file_exists($target)) {
    mkdir($target, 0777, true);
}
//specifying target for each file
$target1 = $target . basename( $_FILES['pic1']['name']);
$target2 = $target . basename( $_FILES['pic2']['name']);
$target3 = $target . basename( $_FILES['pic3']['name']);
$target4 = $target . basename( $_FILES['pic4']['name']);


// This gets all the other information from the form
$pic1=($_FILES['pic1']['name']);
$pic2=($_FILES['pic2']['name']);
$pic3=($_FILES['pic3']['name']);
$pic4=($_FILES['pic4']['name']);



// Connects to your Database
require_once("/includes/dbconn.php");
$sql="INSERT INTO photos (id, cust_id, pic1, pic2, pic3, pic4) VALUES ('', '$id', '$pic1' ,'$pic2', '$pic3','$pic4')";
// Writes the information to the database
mysqli_query($conn,$sql) ;

// Writes the photo to the server
if(move_uploaded_file($_FILES['pic1']['tmp_name'], $target1)&&move_uploaded_file($_FILES['pic2']['tmp_name'], $target2)&&move_uploaded_file($_FILES['pic3']['tmp_name'], $target3)&&move_uploaded_file($_FILES['pic4']['tmp_name'], $target4))
{

// Tells you if its all ok
echo "The files has been uploaded, and your information has been added to the directory";
}
else {

// Gives and error if its not
echo "Sorry, there was a problem uploading your file.";
}
}

?>