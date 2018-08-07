<?php 
include "include/connection.php";

if(isset($_SESSION['userid'])!= ""){
  header("Location : home.php");
  exit;
}

if(isset($_POST['register'])){
	$firstname = test_input($_POST['fname']);
	$lastname = test_input($_POST['lname']);
	$email = test_input($_POST['email']);
	$country = test_input($_POST['country']);
	$gender = test_input($_POST['gender']);
	$activity = implode(',', $_POST['activity']);
	$dob = test_input($_POST['dob']);
	$password = test_input($_POST['password']);
	$repassword = test_input($_POST['cpassword']);
	
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
	$hashed_password = password_hash($password, PASSWORD_DEFAULT); 

	//Check email already exit in databse
	$check_email = $conn->query("SELECT email FROM user WHERE email = '$email'");
	$count=$check_email->num_rows;

	if($count==0){

	  //checking password and retype password	
	  if($password==$repassword){

		$insert = "INSERT into user(firstname, lastname, email, password, country, gender, activity, dob, propic, photo_album) VALUES('$firstname', '$lastname', '$email', '$hashed_password', '$country', '$gender', '$activity', '$dob', '$propic', '$albumfolder')";
		if($conn->query($insert) === TRUE){
			?>
			<script type="text/javascript">
				alert("Successfully registered !!");	
			</script>
			<?php
			header("Location: index.php");
		} else {
			echo "Please Try again" . $conn->error;
		}

	  } else {
	  	echo "Password doesn't match. Please try again !";
	  }
	
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
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Zimboo</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!--COUSTOM CSS-->
    <link rel="stylesheet" type="text/css" href="css/style.css">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script>
    
    function preview_image() 
    {
     var total_file=document.getElementById("upload_file").files.length;
     for(var i=0;i<total_file;i++)
     {
      $('#image_preview').append("<img width='300px' height='300px' class='img-thumbnail' src='"+URL.createObjectURL(event.target.files[i])+"'><br>");
     }
    }
     function preview_album() 
    {
     var total_file=document.getElementById("album").files.length;
     for(var i=0;i<total_file;i++)
     {
      $('#preview_album').append("<img width='300px' height='300px' class='img-thumbnail' src='"+URL.createObjectURL(event.target.files[0])+"'><br>");
      $('#preview_album1').append("<img width='300px' height='300px' class='img-thumbnail' src='"+URL.createObjectURL(event.target.files[1])+"'><br>");
      $('#preview_album2').append("<img width='300px' height='300px' class='img-thumbnail' src='"+URL.createObjectURL(event.target.files[2])+"'><br>");
      $('#preview_album3').append("<img width='300px' height='300px' class='img-thumbnail' src='"+URL.createObjectURL(event.target.files[3])+"'><br>");
      $('#preview_album4').append("<img width='300px' height='300px' class='img-thumbnail' src='"+URL.createObjectURL(event.target.files[4])+"'><br>");
     }
    }
    </script>
  </head>
  <body>
  <div class="container">
    <h2 class="text-center"><mark>ZIMBOO</mark></h2>
    <h3 class="text-muted text-center">Memeber Registration Form</h3>
    <form method="post"  enctype="multipart/form-data">
       <div class="row">
         <div class="col-sm-6">
            <div class="form-group">
              <label class="sr-only" for="fname">First Name</label>
              <input type="text" name="fname" class="form-control" placeholder="First Name">
            </div>
         </div>
         <div class="col-sm-6">
           <div class="form-group">
            <label class="sr-only" for="lname">Last Name</label>
            <input type="text" name="lname" class="form-control" placeholder="Last Name">
          </div>
         </div>
       </div>
      <div class="form-group">
        <label class="sr-only" for="email">Email</label>
        <input type="email" name="email" class="form-control" placeholder="Email">
      </div>
      <div class="form-group">
        <label class="sr-only" for="password">Password</label>
        <a href="#"  data-toggle="popover" data-trigger="hover" data-content="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"><input type="password" name="password" class="form-control" placeholder="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"></a>
       </div>
       <div class="form-group">
         <label class="sr-only" for="confirm password">Password</label>
         <input type="password" name="cpassword" class="form-control" placeholder="re-password">
       </div>
       <div class="radio">
         <label>Gender</label>
         <label class="radio-inline"><input type="radio" name="gender" value="male">Male</label>
         <label class="radio-inline"><input type="radio" name="gender" value="female">Female</label>
         <label class="radio-inline"><input type="radio" name="gender" value="other">Others</label>
       </div>
       <div class="checkbox">
         <label>Activity</label>
         <label><input type="checkbox" name="activity[]" value="Business">Business</label>
         <label><input type="checkbox" name="activity[]" value="Proffessional">Proffessional</label>
         <label><input type="checkbox" name="activity[]" value="General">General</label>
       </div>
       <div class="form-group">
        <label for="dob">Date of Birth</label>
        <input type="date" name="dob" class="form-control">
       </div>
       <div class="form-group">
         <label for="country">Select Country :</label>
         <select class="form-control" name="country">
           <option>Nepal</option>
           <option>India</option>
           <option>China</option>
         </select>
       </div>
       <div class="form-group">
         <label for="propic">Upload profile picture</label>
         <input type="file" name="propic" id="upload_file" onchange="preview_image();" accept="image/*">
         <br>
         <div id="image_preview"></div>
       </div>
        <div class="form-group">
         <label for="propic">Upload album</label>
         <input type="file" id="album" name="album[]" onchange="preview_album();" accept="image/*" multiple/>
         <div class="row">
           <div class="col-sm-3">
              <span id="preview_album"></span>
           </div>
           <div class="col-sm-3">
              <span id="preview_album1"></span>
           </div>
           <div class="col-sm-3">
              <span id="preview_album2"></span>
           </div>
           <div class="col-sm-3">
              <span id="preview_album3"></span>
           </div>
          </div>
        </div>  
         
       <input type="submit" name="register" class="btn btn-default">
    </form> 
  </div>
   
<?php include "templates/footer.php"; ?>