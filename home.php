<?php include "templates/header.php"; ?>
  <div class="container">
  	<h2>Zimbo</h2>
    <div class="row">
      <a class="btn btn-default pull-right" href="logout.php?logout">Logout</a>
     
    </div>	
  	<br>
  	<div class="jumbotran">
  		<h4>Welcome <?php echo $username; ?></h4>
  		<div class="row">
  			<div class="col-sm-2">
  				<img src="uploads/<?php echo $username; ?>/profile/<?php echo $profile_pic; ?>" class="img-circle img-responsive">
  			</div>
  			<div class="col-sm-10">
  				<?php echo "hello..".$email;?>
  				<div class="row">
  				<?php
  				$dir_open = opendir($dirname);
                while($filename = readdir($dir_open)){
                    if($filename != "." && $filename != ".."){
                    	$loc=$dirname.$filename;
                ?>
  					<div class="col-sm-3">
  						<img src="<?php echo $loc; ?>" class="img-thumbnail" width="200px" height="150px" >
  					</div>
  					<?php
					}
				}
  		        ?>
  				</div>
  				
  			</div>
  		</div>
  	</div>
  	<?php 
  	
  	

  	?>
  </div>
  
<?php include "templates/footer.php"; ?>