<?php 
session_start();
require_once "include/connection.php";
include_once("gologin/config.php");
include_once("include/functions.php");

if(isset($_SESSION['userid'])!= ""){
  header("Location: home.php");
  exit;
}



//processing data from form
if(isset($_POST['login']))
{
  $email = test_input($_POST['email']);
  $password = test_input($_POST['password']);


  //hashing the login form password
  $hashed_password = password_hash($password, PASSWORD_DEFAULT); 


  //query to get data for checking the credential
  $get_user_data = "SELECT * FROM user WHERE email = '$email'";
  $result = $conn->query($get_user_data);
  $row = $result->fetch_assoc();
  $db_password = $row['password']; 
  
  $count = $result->num_rows;

if(password_verify($password, $row['password']) && $count == 1) 
  { 
    $_SESSION['userid'] = $row['id'];
    header("Location: home.php");
  }
  else
  {
    ?>
    <script type="text/javascript">
      alert("Login Credential Incorrect! Please try again.");
    </script>
    <?php
  }

}
//testing input
function test_input($data) {
  $data = trim($data);
  $data = stripcslashes($data);
  $data = htmlspecialchars($data);
  return $data;

}

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
  <div class="panel">
    <div class="panel-head">
      <h4>Login Form</h4>
    </div>
    <div class="panel-body">
      <form class="form-inline" method="post">
        <input type="text" name="email" class="form-control" placeholder="Username">
        <input type="password" name="password" class="form-control" placeholder="Password">
        <input type="submit" name="login" class="btn btn-default">
      </form>

      <a class="btn btn-default" href="register.php">Add new account</a>
      <?php 
      //print_r($_GET);die;

if(isset($_REQUEST['code'])){
  $gClient->authenticate();
  $_SESSION['token'] = $gClient->getAccessToken();
  header('Location: ' . filter_var($redirectUrl, FILTER_SANITIZE_URL));
}

if (isset($_SESSION['token'])) {
  $gClient->setAccessToken($_SESSION['token']);
}

if ($gClient->getAccessToken()) {
  $userProfile = $google_oauthV2->userinfo->get();
  //DB Insert
  $gUser = new Users();
  $gUser->checkUser('google',$userProfile['id'],$userProfile['given_name'],$userProfile['family_name'],$userProfile['email'],$userProfile['gender'],$userProfile['locale'],$userProfile['link'],$userProfile['picture']);
  $_SESSION['google_data'] = $userProfile; // Storing Google User Data in Session
  header("location: home.php");
  $_SESSION['token'] = $gClient->getAccessToken();
} else {
  $authUrl = $gClient->createAuthUrl();
}

if(isset($authUrl)) {
  echo '<a href="'.$authUrl.'"><img src="img/glogin.png" alt=""/></a>';

} else {
  echo '<a href="logout.php?logout">Logout</a>';
}?>
    </div>
  </div>
</div>
<?php include "templates/footer.php"; ?>