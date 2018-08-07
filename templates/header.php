<?php 
session_start();
include "./include/connection.php"; 

if(!isset($_SESSION['userid'])){
  header("Location: index.php");
}

$session_data = "SELECT * FROM user WHERE id = '".$_SESSION['userid']."'";
$result = $conn->query($session_data);
while($session_row = $result->fetch_assoc()){
  $username = $session_row['firstName'];
  $email = $session_row['email'];
  $profile_pic  = $session_row['propic'];
  $album = $session_row['photo_album'];
  $dirname = "uploads/$username/album/";      
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