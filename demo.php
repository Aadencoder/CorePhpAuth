<!DOCTYPE html>
<html>
<head>
	<title>Registration Form</title>

	<!--Bootstrap css-->
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<!--Costum css-->
	<link rel="stylesheet" type="text/css" href="css/style.css"> 

</head>
<body>
<div class="container ">
	<div class="title">
		<h2>Zimboo</h2>
		<h3><mark>Registation Form</mark></h3>
	</div>

	<!--Form-->
	<form>
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group">
					<label class="sr-only" for="fname">First Name</label>
					<input type="text" name="fname" class="form-control" placeholder="Firt Name">
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
			<input type="email" name="email" class="form-control" placeholder="Email address">
		</div>
		<div class="form-group">
			<label class="sr-only" for="pass">Password</label>
			<!--adding popover-->
			 <a href="#"  data-toggle="popover" data-trigger="hover" data-content="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
				<input type="password" name="pass" class="form-control" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}">
			 </a>	
		</div>
		<div class="form-group">
			<label class="sr-only" for="cpass">Confirm Password</label>
			<input type="password" name="cpass" class="form-control" placeholder="Re-type password">
		</div>

		<!--Radio button-->
		<div class="radio">
			<label>Gender</label>
			<label class="radio-inline"><input type="radio" name="gender">Male</label>
			<label class="radio-inline"><input type="radio" name="gender">Female</label>
			<label class="radio-inline"><input type="radio" name="gender">Others</label>
		</div>

		<!--checkbox-->
		<div class="checkbox">
			<label>Choose Activity</label>
			<label><input type="checkbox" name="activity" value="1">Busienss</label>
			<label><input type="checkbox" name="activity" value="2">Professional</label>
			<label><input type="checkbox" name="activity" value="3"></label>
		</div>

		<!--Select option-->
		<div class="form-group">
			<label>Select Country</label>
			<select class="form-control" name="country">
				<option>Nepal</option>
				<option>India</option>
				<option>China</option>
			</select>
		</div>

		<div class="form-group">
			<label  for="dob">Date of birth</label>
			<input type="date" name="dob" class="form-control" placeholder="Date of birth">
		</div>
		<div class="form-group">
		  <label class="sr-only" for="propic">Profile Picture</label>
		  <input type="file" name="img" class="btn btn-default" accept="image/*">
		</div>
		<input type="submit" name="submit" class="btn btn-default">
	</form>	
</div>

<!--jquery  cdn-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<!--Bootstrap js-->
<script src="js/bootstrap.js"></script>
 <script>
      $(document).ready(function(){
          $('[data-toggle="popover"]').popover(); 
      });
      </script>
</body>
</html>