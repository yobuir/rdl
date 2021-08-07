<?php include"header.php";?>
<?php 
	if (!isset($_SESSION['login'])) {
		header('location:index.php');
	}
?>
<?php
  $message="";
  $id=$_GET['U'];
    if (isset($_POST['send'])) { 
      $fname=$_POST['fname'];
      $lname=$_POST['lname'];
      $Gender=$_POST['Gender'];  
      $dob=$_POST['dob'];
      $exdate=$_POST['date']; 
      $phone_number=$_POST['phone_number']; 
      $idlength=strlen($phone_number);
       $year=date('Y');
      $useryear=date('Y', strtotime($dob));
       $validyear=$year-$useryear;
       if ($fname=='' or $lname=='' or $Gender==''or $dob==''or $exdate==''or $phone_number=='') {
               $message= "<div class='alert alert-danger'> <i class='fa fa-info-circle'></i> Fill all fields</div>";
                     
              }else{
              	if ($validyear < 18) {
                    			$message="<div class='alert alert-danger'><i class='fa fa-info-circle'></i>Allowed Candidate are those with more than 18 years </div>";
                    			$_SESSION['message_request']=$message;
                    		}else{
	              	$selectall=mysqli_query($conn, "SELECT * FROM candidate where candidatanationalid='$id'")or die($con->error);
	                  $myfecthall=mysqli_fetch_array($selectall);

	                  if ($idlength!=10) {
	                   	$message="<div class='alert alert-danger'>
	                   	<i class='fa fa-info-circle'></i> 
	                   	enter valid phone number 12 numbers</div>";
	                  }else{  
	                    		$sg=mysqli_query($conn, "UPDATE candidate SET firstname='$fname',lastname='$lname',gender='$Gender',dob='$dob',examdate='$exdate',phonenumber='$phone_number' WHERE candidatanationalid='$id'");
	                    		if ($sg) {
	                    			$message="<div class='alert alert-success'><i class='fa fa-info-circle'></i> Candidate Updated successful</div>";
	                    		} else{
	                    			$message="<div class='alert alert-danger'> <i class='fa fa-info-circle'></i> ".$conn->error."</div>";
	                    		}

	                    	 
	                	}
	            	}
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
	<style type="text/css">
	table th{
			color: rgba(245, 6, 170,0.90)
		}
		table tr{
			border-bottom:1px solid rgba(245, 6, 170,0.90)
		}
		a:hover{
			border-top: 1px solid white;
		}
		.home{
			border-top: 1px solid white;
		}

	</style>

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
		<a href="candidatelist.php" class="font-weight-bold text-decoration-none" style="
		color: rgba(245, 6, 170, 1); 

		"><i class="fa fa-arrow-alt-circle-left" title="back to login" style="font-size: 20px"></i><span>Back </span>
                        </a>
		</div>

		<div class="col-lg-6 ml-5">
			<form class="row ml-5 sticky-top" method="POST">
					<div class="col-lg-12  sticky-top" style="
						background-color:rgb(245, 6, 170);
						color: white;
						padding: 10px;
					">
						Update Candidate <strong>with ID#<?php echo$_GET['U']?></strong>
					</div>

					<?php
						$id=$_GET['U'];
					$selectall=mysqli_query($conn, "SELECT * FROM candidate where candidatanationalid='$id' ")or die($con->error);
					if (mysqli_num_rows($selectall)>0) {
							$myfecthall=mysqli_fetch_array($selectall);
						?>

					<div class="col-lg-12">
						<label>Candidate national id</label>
						<input type="number" name="candidate_national_id" class="form-control" disabled value="<?php echo$_GET['U']?>">
						<small class="text-danger"><i class='fa fa-info-circle'></i> National id can't be changed</small>
					</div>
					<div class="col-lg-12 mt-3">
						<label>First Name</label>
						<input type="text" name="fname" value="<?php echo($myfecthall['firstname'])?>" class="form-control" >
					</div>
					<div class="col-lg-12 mt-3">
						<label>Last Name</label>
						<input type="text" name="lname" value="<?php echo($myfecthall['lastname'])?>" class="form-control">
					</div>
					<div class="col-lg-12 mt-3">
						<label>Gender</label><br>
						<?php if ($myfecthall['gender']=='female') {?>
							<input type="radio" name="Gender" value="female" checked>Female
						<input type="radio" value="male" name="Gender" >Male
						<?php
					}else{ ?>
						<input type="radio" name="Gender" value="female" >Female
						<input type="radio" value="male" name="Gender" checked>Male
					<?php }
						 ?>
						
					</div>
					<div class="col-lg-12 mt-3">
						<label>Date of birth</label>
						<input type="date" name="dob" value="<?php echo($myfecthall['dob'])?>" class="form-control">
					</div>
					<div class="col-lg-12 mt-3">
						<label>Exam Date</label>
						<input type="date" value="<?php echo($myfecthall['examdate'])?>" name="date" class="form-control">
					</div>
					<div class="col-lg-12 mt-3">
						<label>Phone number</label>
						<input type="number" value="<?php echo($myfecthall['phonenumber'])?>" name="phone_number" class="form-control">
					</div>
					<div class="col-lg-12 mt-3" > 
						<button class="btn btn-sm" name="send" type="submit" style="
						background-color:rgba(245, 6, 170,1);
						color: white;
						padding: 10px;
					">
							Confirm
						</button>
					</div>

				<?php }else{?>
					<div class='col-lg-12 alert alert-danger'><i class='fa fa-info-circle'></i> No candidate found</div>
				<?php }?>

				</form>
		</div>
	</div>
</div>
				