<?php 
include "include/connection.php";

//selecting data from database
      $user_data = "SELECT * FROM user";
      $result = $conn->query($user_data);
      while($row = $result->fetch_assoc()) {
        $id = $row['id'];
        $username = $row['firstName'];
        $lastname = $row['lastName'];
        $email = $row['email'];
        $gender = $row['gender'];
        $activity = explode(',', $row['activity']);  
        $country = $row['country'];
        $dob = $row['dob'];
        $profile_pic  = $row['propic'];
        $album = $row['photo_album'];
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
      document.getElementById("old-pic").style.display = "none";
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
    <form method="post" action="edit.php" enctype="multipart/form-data">
       <div class="row">
         <div class="col-sm-6">
            <div class="form-group">
              <label class="sr-only" for="fname">First Name</label>
              <input type="text" name="fname" class="form-control" value="<?php echo $username; ?>">
            </div>
         </div>
         <div class="col-sm-6">
           <div class="form-group">
            <label class="sr-only" for="lname">Last Name</label>
            <input type="text" name="lname" class="form-control" value="<?php echo $lastname; ?>">
          </div>
         </div>
       </div>
      <div class="form-group">
        <label class="sr-only" for="email">Email</label>
        <input type="email" name="email" class="form-control" value="<?php echo $email; ?>">
      </div>
      <div class="form-group">
        <label class="sr-only" for="old_Password">Old password</label>
        <a href="#"  data-toggle="popover" data-trigger="hover" data-content="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"><input type="password" name="old_password" class="form-control" placeholder="Old password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"></a>
       </div>
       <div class="form-group">
         <label class="sr-only" for="new-password">New password</label>
         <input type="password" name="new_password" class="form-control" placeholder="new password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}">
       </div>
       <div class="radio">
         <label>Gender</label>
         <label class="radio-inline"><input type="radio" name="gender" value="male" <?php if($gender == 'male'){echo 'checked';}?>>Male</label>
         <label class="radio-inline"><input type="radio" name="gender" value="female" <?php if($gender == 'female'){echo 'checked';}?>>Female</label>
         <label class="radio-inline"><input type="radio" name="gender" value="other" <?php if($gender == 'other'){echo 'checked';}?>>Others</label>
       </div>
       <div class="checkbox">
         <label>Activity</label>
         <label><input type="checkbox" name="activity[]" value="Business" <?php if(in_array('Business', $activity)){ echo "checked";} ?>>Business</label>
         <label><input type="checkbox" name="activity[]" value="Proffessional" <?php if(in_array('Proffessional', $activity)){ echo "checked";} ?>>Proffessional</label>
         <label><input type="checkbox" name="activity[]" value="General" <?php if(in_array('General', $activity)){ echo "checked";} ?>>General</label>
       </div>
       <div class="form-group">
        <label for="dob">Date of Birth</label>
        <input type="date" name="dob" class="form-control" value="<?php echo $dob; ?>">
       </div>
       <div class="form-group">
         <label for="country">Select Country :</label>
         <select class="form-control" name="country">
           <option <?php if (!empty($country) && $country == 'Nepal')  echo 'selected = "selected"'; ?>>Nepal</option>
           <option <?php if (!empty($country) && $country == 'India')  echo 'selected = "selected"'; ?>>India</option>
           <option <?php if (!empty($country) && $country == 'China')  echo 'selected = "selected"'; ?>>China</option>
         </select>
       </div>
       <div class="form-group">
         <label for="propic">Upload profile picture</label>
         <input type="file" name="propic" id="upload_file"  onchange="preview_image();" accept="image/*"><?php echo $profile_pic; ?>
         <br>
         <div id="image_preview">
            <div id="old-pic">
           <img src="uploads/<?php echo $username; ?>/profile/<?php echo $profile_pic; ?>" class="img-circle img-responsive">
           </div>
         </div>
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
         <input type="text" name="id" class="hidden" value="<?php echo $id; ?>">
       <input type="submit" name="register" class="btn btn-default">
    </form> 
  </div>
   
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.js"></script>
    <script>
      $(document).ready(function(){
          $('[data-toggle="popover"]').popover(); 
      });
      </script>
  </body>
</html>