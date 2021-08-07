	<?php
	session_start();
include "conn.php"; 
$message="";
	 	$adminid=$_GET['unique_id'];
	        $select=mysqli_query($conn, "SELECT * FROM user where adminid='$adminid'");
			$fetched=mysqli_fetch_array($select);
	 	if (isset($_POST['delete'])) {
	 		$adminid=$fetched['adminid'];
		$delte=mysqli_query($conn,"DELETE FROM user where adminid='$adminid'");
		if ($delte) {
			 $message= "<div class='alert alert-success'> <i class='fa fa-info-circle'></i> User deleted</div>";
		}else{
			 $message= "<div class='alert alert-danger'> <i class='fa fa-info-circle'></i>".$conn->error."</div>";

		}
		} ?>
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
<body>
	<div class="container">
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

		<div class="col-lg-6 ml-5">
			<div class="row ml-5 sticky-top" method="POST">
					<div class="col-lg-12  sticky-top" style="
						background-color:rgb(245, 6, 170);
						color: white;
						padding: 10px;
					">
						Delete User <strong>#</strong>
					</div>
					<?php
						if (mysqli_num_rows($select)>0) {?>
							<form method="POST" class="col-lg-12 mt-3">
						 		<button class="btn btn-sm " name="delete" type="submit" style="
						 		border:solid 1px rgba(245, 6, 170, 0.70);
									color: rgba(245, 6, 170, 0.70);">Delete</button>
									<a href="users.php" class="float-right">Back</a>
						 	</form>
							<?php 
						}else{?>
							<div class='alert alert-danger col-lg-12'> <i class='fa fa-info-circle'></i> No user found <a href="users.php">Back to list</a></div>
							<?php
						}
					?>
					 	
					</div>
				</div>
			</div>
		</div>

</body>
</html>
