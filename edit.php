<?php 
include "include/connection.php";



if(isset($_POST['register'])){
	$id = test_input($_POST['id']);
	$firstname = test_input($_POST['fname']);
	$lastname = test_input($_POST['lname']);
	$email = test_input($_POST['email']);
	$country = test_input($_POST['country']);
	$gender = test_input($_POST['gender']);
	$activity = implode(',', $_POST['activity']);
	$dob = test_input($_POST['dob']);
	$oldpassword = test_input($_POST['old_password']);
	$new_password = test_input($_POST['new_password']);
	
	//Profile pic  upload
	 $propic = $_FILES['propic']['name'];
     $tmp_dir = $_FILES['propic']['tmp_name'];
     $imgSize = $_FILES['propic']['size'];

     $target_dir = "uploads/".$firstname."/profile/";
	 $target_file = $target_dir . basename($_FILES["propic"]["name"]);
	 $uploadOk = 1;
	 $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

	 $check = getimagesize($_FILES["propic"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
	// Check if file already exists
	if (file_exists($target_file)) {
	    echo "Sorry, file already exists.";
	    $uploadOk = 0;
	}
	// Check file size
	if ($_FILES["propic"]["size"] > 500000) {
	    echo "Sorry, your file is too large.";
	    $uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
	    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	    $uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
	    echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} else {
		 mkdir($target_dir, 0777, true);
	    if (move_uploaded_file($_FILES["propic"]["tmp_name"], $target_file)) {
	        echo "The file ". basename( $_FILES["propic"]["name"]). " has been uploaded.";
            //Loop through each file
              for($i=0; $i<count($_FILES['album']['name']); $i++) {
                //Get the temp file path
                $tmpFilePath = $_FILES['album']['tmp_name'][$i];

                //Make sure we have a filepath
                if($tmpFilePath != ""){
            
                  //save the filename
                  $album_name = $_FILES['album']['name'][$i];
                  $validextensions = array("jpeg", "jpg", "png");
                  //save the url and the file
                  $albumfolder = "uploads/".$firstname."/album/";
                  $album = $albumfolder."album/";
                  //explode file name from dot(.) 
                  $ext = explode('.', basename($_FILES['album']['name'][$i])); 
                  //store extensions in the variable
        		  $file_extension = end($ext); 
        		   //Approx. 10mb files can be uploaded.
        		  if (($_FILES["album"]["size"][$i] < 10000000) && in_array($file_extension, $validextensions)) {
                  mkdir($albumfolder, 0777, true);
                  $filePath = $albumfolder.$_FILES['album']['name'][$i];

                  //Upload the file into the temp dir
                  move_uploaded_file($tmpFilePath, $filePath);
                  }	else {
              	echo "invalid image format.";

              }
                }
              }



              
	// Adding password hash php 5.5.6 function
	$hashed_password = password_hash($new_password, PASSWORD_DEFAULT); 

	//Check email already exit in databse
	$check_email = $conn->query("SELECT * FROM user WHERE email = '$email'");
	
	while($row=$check_email->fetch_assoc()) {
	//$db_password = $row['password'];
}
	$count=$check_email->num_rows;

	if($count==0){

	  //checking password and retype password	
	  //if($hashed_password === $db_password){

		$update = "UPDATE user SET firstName='$firstname', lastName= '$lastname', email = '$email', password = '$hashed_password', gender = '$gender', country = '$country', activity = '$activity', propic= '$propic', photo_album = '$albumfolder' WHERE id = '$id'";
		if($conn->query($update) === TRUE){
			echo "Successfully registered !";
		} else {
			echo "Please Try again" . $conn->error;
		}

	  // } else {
	  //	echo "Password doesn't match. Please try again !";
	  //}
	
	}else {
		echo "You have alerady register with this email address. Please try forget password!";
	}
	 
	 } else {
	        echo "Sorry, there was an error uploading your file.";
	    }

}
}
function test_input($data){
	$data = trim($data);
	$data = stripcslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

?>