
<?php

// This is the directory where images will be saved
$id=$_GET['id'];
if (!file_exists('profile/$id')) {
    mkdir('profile/$id', 0777, true);
}
$target = "profile/$id/";
$target = $target . basename( $_FILES['photo']['name']);

// This gets all the other information from the form
$name=$_POST['nameMember'];
$bandMember=$_POST['bandMember'];
$pic=($_FILES['photo']['name']);



// Connects to your Database
require_once("/includes/dbconn.php");
$sql="INSERT INTO photos (id,cust_id,pic) VALUES ('', '1', '$pic')";
// Writes the information to the database
mysqli_query($conn,$sql) ;

// Writes the photo to the server
if(move_uploaded_file($_FILES['photo']['tmp_name'], $target))
{

// Tells you if its all ok
echo "The file ". basename( $_FILES['photo']['name']). " has been uploaded, and your information has been added to the directory";
}
else {

// Gives and error if its not
echo "Sorry, there was a problem uploading your file.";
}
?> 