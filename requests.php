<?php include"header.php";?>
<?php 
  $message="";
  $unique_id=$_SESSION['unique_id']; ?>
  						<?php

						if (isset($_POST['import'])) { 
							$selectall=mysqli_query($conn, "SELECT * FROM candidateapply")or die($conn->error);
							if ($selectall) {
								if (mysqli_num_rows($selectall)<0) {
									$message="<div class='alert alert-danger'> <i class='fa fa-info-circle'></i> No candidate to import</div>";
								}else{
								while($myfecthall=mysqli_fetch_array($selectall)){
									$candidatanationalid=$myfecthall['candidatanationalid'];
									$firstname=$myfecthall['firstname'];
									$lastname=$myfecthall['lastname'];
									$gender=$myfecthall['gender'];
									$dob=$myfecthall['dob'];
									$examdate=$myfecthall['examdate'];
									$examcat=$myfecthall['examcat'];
									$phonenumber=$myfecthall['phonenumber'];

									$selectallcand=mysqli_query($conn, "SELECT * FROM candidate where candidatanationalid ='$candidatanationalid' ")or die($conn->error);
									$myfecthallcand=mysqli_fetch_array($selectallcand);

								if ($myfecthallcand['candidatanationalid']==$candidatanationalid) {
									 $message="<div class='alert alert-danger'> <i class='fa fa-info-circle'></i> 
										candidate import error Candidate aleardy exist</div>";
								}else{
									$INSERT=mysqli_query($conn,"INSERT INTO candidate VALUES('$candidatanationalid','$firstname','$lastname','$gender','$dob','$examdate','$examcat','$phonenumber','$unique_id')");
									if ($INSERT) {
										$dele=mysqli_query($conn, "DELETE FROM candidateapply");

										if ($dele) {
											header('location:requestlist.php');
										}else{
											$message="<div class='alert alert-danger'> <i class='fa fa-info-circle'></i> ".$conn->error."</div>";
										}
										
									}else{
										$message="<div class='alert alert-danger'> <i class='fa fa-info-circle'></i> ".$conn->error."</div>";
									}
								}

									}
								}
							}else{
								echo($conn->error);
							}
						}
				?>
				<?php
					  $message="";
					  if (isset($_POST['delete'])) {    
					        $sg=mysqli_query($conn, "DELETE FROM candidateapply");
					        
					                 if ($sg) {
					                    $message="<div class='alert alert-success'><i class='fa fa-info-circle'></i> Candidate deleted successful</div>";
					                  } else{
					                    $message="<div class='alert alert-danger'> <i class='fa fa-info-circle'></i> ".$conn->error."</div>";
					                    		} 
					            }
					?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>RDL _ Rwanda driving license</title>  
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
	<script type="text/javascript" src="js/all.min.js"></script>
	<script type="text/javascript" src="js/all.js"></script>

	<script type="text/javascript" src="js/fontawesome.js"></script>
	<script type="text/javascript" src="js/fontawesome.js"></script>
	<script type="text/javascript" src="vendor/jquery-3.2.1.min.js"></script> 
	<script type="text/javascript" src="vendor/jquery-ui.min.js"></script> 
	 

	<link rel="stylesheet" type="text/css" href="js/fontawesome.css">
	<link rel="stylesheet" type="text/css" href="js/all.css">
	<link rel="stylesheet" type="text/css" href="js/all.mini.css">
	<link rel="stylesheet" type="text/css" href="js/fontawesome.min.css">
	 
</head>
<style type="text/css">
	.request{
		background-color: rgba(245, 6, 170, 1);
		color: white;
		padding: 2px;
	}
</style>
<body>
	<div class="container-fluid ">
		<div class="row justify-content-center">
		<div class="col-lg-3" 	style="

			margin: 0;
			position: absolute;
			top: 20%;
			left: 4%;
			overflow: hidden;
			-ms-transform: translateY(-50%);
			transform: translateY(-50%);

		">
			<?php echo$message?>
		</div>
		
		<div class="col-lg-3" 
		style="
			margin: 0;
			position: absolute;
			top: 40%;
			left: 4%;
			overflow: hidden;
			-ms-transform: translateY(-50%);
			transform: translateY(-50%);

		">
		<a href="requestlist.php" class="font-weight-bold text-decoration-none" style="
		color: rgba(245, 6, 170, 1); 

		"><i class="fa fa-arrow-alt-circle-left" title="back to dashboard" style="font-size: 20px"></i><span>Back </span>
         </a> 

		</div> 	
			<div class="col-lg-5 border">
				<div class="row">
					<div class="col-lg-12 sticky-top" style="
						background-color:rgb(245, 6, 170);
						color: white;
						padding: 10px;
					">
						Confirm Requests  
					</div>
					<div class="col-lg-12 p-3">
						<p>Import All Request to Candidate table</p>
						You have <?php
							$selectall=mysqli_query($conn, "SELECT count(candidatanationalid) AS total FROM candidateapply")or die($conn->error); 
								$request=mysqli_fetch_array($selectall);
							echo"<span class='request'>". $request['total']."</span> Requests";

							
							?>

						<div class="col-lg-12 ">
							<hr>
							<form method="POST" class="">
								<button class="btn" type="submit" name="import" style="
									background-color: rgba(245, 6, 170, 1);
									color: white;">
						 				Import All
						 		</button>
						 	</form>
						 	<form method="POST">
						 		 
						 	</form>
						</div>
						
					</div>
				</div>
			</div>		
		</div>
	</div>
</body>
</html>