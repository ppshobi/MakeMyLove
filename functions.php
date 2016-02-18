<?php
// include_once('/includes/dbconn.php');
 ?>
<?php
function mysqlexec($sql){
	$host="localhost"; // Host name
	$username="root"; // Mysql username
	$password=""; // Mysql password
	$db_name="matrimony"; // Database name

// Connect to server and select databse.
	$conn=mysqli_connect("$host", "$username", "$password")or die("cannot connect");

	mysqli_select_db($conn,"$db_name")or die("cannot select DB");

	if($result = mysqli_query($conn, $sql)){
		return $result;
	}
	else{
		return false;
	}


}

function writepartnerprefs($id){
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$agemin=$_POST['agemin'];
		$agemax=$_POST['agemax'];
		$maritalstatus=$_POST['maritalstatus'];
		$bodytype=$_POST['bodytype'];
		$complexion=$_POST['colour'];
		$height=$_POST['height'];
		$diet=$_POST['diet'];
		$religion=$_POST['religion'];
		$caste=$_POST['caste'];
		$mothertounge=$_POST['mothertounge'];
		$education=$_POST['education'];
		$occupation=$_POST['occupation'];
		$country=$_POST['country'];
		$descr=$_POST['descr'];

		$sql = "UPDATE partnerprefs SET agemin = '$agemin', agemax='$agemax', maritalstatus='$maritalstatus', bodytype='$bodytype', complexion = '$complexion', height = '$height', diet = '$diet', religion='$religion', caste = '$caste', mothertounge = '$mothertounge', education='$education', descr = '$descr', occupation = '$occupation', country = '$country' WHERE custId = '$id'";

		$result = mysqlexec($sql);
		if ($result) {
			echo "Successfully updated Partner Preference";
		}
		else{
			mysqli_errno();
		}

	}
}


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

	$sql = "INSERT INTO users (id, username, password, email, dateofbirth, gender) VALUES ('', '$uname', '$pass', '$email', '$dob', '$gender')";

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
$directoryURI = $_SERVER['REQUEST_URI'];
$path = parse_url($directoryURI, PHP_URL_PATH);
$components = explode('/', $path);
$url = $components[2];
if($url=="login.php"){return true;}
else{
		if(!isset($_SESSION['username'])){
	 		header("location:login.php");
		}
		else{
			return true;
		}
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
	  //creating a slot for partner prefernce table for prefs details with cust id
	  $sql2="INSERT INTO partnerprefs (id, custId) VALUES('', '$id')";
	  mysqli_query($conn,$sql2);
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

$sql="SELECT id FROM photos WHERE cust_id = '$id'";
$result = mysqlexec($sql);

//code part to check weather a photo already exists
if(mysqli_num_rows($result) == 0) {
     // no photo for curret user, do stuff...
		$sql="INSERT INTO photos (id, cust_id, pic1, pic2, pic3, pic4) VALUES ('', '$id', '$pic1' ,'$pic2', '$pic3','$pic4')";
		// Writes the information to the database
		mysqlexec($sql);

		
} else {
    // There is a photo for customer so update table
    $sql="UPDATE photos SET pic1 = '$pic1', pic2 = '$pic2', pic3 = '$pic3', pic4 = '$pic4' WHERE cust_id=$id";
		// Writes the information to the database
		mysqlexec($sql);
}

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

}//end uploadphoto function

?>