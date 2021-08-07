<?php include"header.php";?>
<?php 
	if (!isset($_SESSION['login'])) {
		header('location:index.php');
	}
?>
<?php
$unique_id=$_SESSION['unique_id'];
  $message="";
    if (isset($_POST['send'])) {
      $candidate_national_id=$_POST['candidate_national_id']; 
      $fname=$_POST['fname'];
      $lname=$_POST['lname'];
      $Gender=$_POST['Gender'];  
      $dob=$_POST['dob'];
      $exdate=$_POST['date']; 
      $phone_number=$_POST['phone_number']; 
      $idlength=strlen($candidate_national_id);
      $phonelength=strlen($phone_number);
       $year=date('Y');
      $useryear=date('Y', strtotime($dob));
       $validyear=$year-$useryear;
       if ($candidate_national_id=='' or $fname=='' or $lname=='' or $Gender==''or $dob==''or $exdate==''or $phone_number=='') {
               $message= "<div class='alert alert-danger'><i class='fa fa-info-circle'></i> Fill all fields</div>";
                     
              }else{
              	#if (filter_input(INPUT_POST, "candidate_national_id", FILTER_VALIDATE_INT)) {
			    		#$message= "<div class='alert alert-danger'><i class='fa fa-info-circle'></i> Enter valid numbers for id</div> ";
					#} else {

					#if (!filter_input(INPUT_POST, "phone_number", FILTER_VALIDATE_INT)) {
			    		#$message= "<div class='alert alert-danger'><i class='fa fa-info-circle'></i> Enter valid numbers for phone</div> ";
					#}
			    	#else{
              	$selectall=mysqli_query($conn, "SELECT * FROM candidate where candidatanationalid='$candidate_national_id' or phonenumber='$phone_number'")or die($con->error);
                  $myfecthall=mysqli_fetch_array($selectall);

                  if ($idlength!=16) {
                   	$message="<div class='alert alert-danger'>
                   	<i class='fa fa-info-circle'></i> 
                   	enter valid candidate national id</div>";
                  }else{ 

                  	if ($phonelength!=10) {
                  		$message="<div class='alert alert-danger'>
                   					<i class='fa fa-info-circle'></i> 
                   				enter valid candidate phone_number</div>";
                  	}else{
                    if ($candidate_national_id!=$myfecthall['candidatanationalid']) {

                    	if ($exdate < date('d-m-Y')) {
                    		$message="<div class='alert alert-danger'>
                   					<i class='fa fa-info-circle'></i> 
                   				enter valid exam date</div>";
                    	}else{ 
                    		if ($validyear < 18) {
                    			$message="<div class='alert alert-danger'><i class='fa fa-info-circle'></i>Allowed Candidate are those with more than 18 years </div>";
                    			$_SESSION['message_request']=$message;
                    		}else{

                    	if ($phone_number!=$myfecthall['phonenumber']) {
                    		 
                    		$sg=mysqli_query($conn, "INSERT INTO candidate VALUES('$candidate_national_id','$fname','$lname','$Gender','$dob','$exdate','','$phone_number','$unique_id')");
                    		if ($sg) {
                    			$message="<div class='alert alert-success'><i class='fa fa-info-circle'></i> Candidate registered</div>";
                    		} else{
                    			$message="<div class='alert alert-danger'> <i class='fa fa-info-circle'></i> ".$conn->error."</div>";
                    		}

                    	}else{
                    		$message="<div class='alert alert-danger'><i class='fa fa-info-circle'></i> Phone number already exist</div>";
                    	}
                    }
                }

                    }else{
                    	$message="<div class='alert alert-danger'><i class='fa fa-info-circle'></i> National id already exist</div>";
                    }
                }
                }
              #}
          #}
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
		.Candidates{
			border-top: 1px solid white;
		}

	</style>

</head>
<body>
	<div class="container-fluid ">
		<div class="row sticky-top">
			<div class="col-lg-12 sticky-top p-3 text-right" style="
				background-color:rgba(245, 6, 170,1);

			">
			<form method="POST">
				<a href="dashboard.php" class="font-weight-bold text-decoration-none text-white mr-3"><i class="fa fa-home"></i> Home</a>
				<a href="candidate.php" class="Candidates font-weight-bold text-decoration-none text-white mr-3"><i class="fa fa-user-plus"></i> New Candidate</a>
					<a href="candidatelist.php" class=" font-weight-bold text-decoration-none text-white mr-3"><i class="fa fa-user-check"></i> Candidates</a>
					<a href="grades.php" class="font-weight-bold text-decoration-none text-white mr-3"><i class=" fa fa-graduation-cap"></i> Grades</a>
					<a href="sinup.php" class="font-weight-bold text-decoration-none text-white mr-3"><i class="fa fa-user-plus" ></i> New user</a>
							
						<?php 
							if (!isset($_SESSION['login'])) { 
							
						?>
						<a href="#">
							Login
						</a>
					<?php }else{?>
						<a href="profile.php" class=" border p-1 rounded font-weight-bold text-decoration-none text-white mr-3">
							<i class="fa fa-user mr-1" ></i><?php echo$_SESSION['login']?>
						</a>

					<?php }?> 


					<?php 
							if (!isset($_SESSION['login'])) { 
							
						?> 
					<?php }else{?>
						
							<button type="submit" name="logout" class="btn btn-sm float-right font-weight-bold">Logout</button>
							<?php 
								if (isset($_POST['logout'])) {
									session_destroy();
									header('location:index.php');
								}

							?>
						</form>
						

					<?php }?>
			</div>
		</div>
		<div class="row ">
			<div class="col-lg-5 " style="
					  		margin: 0;
  							position: absolute;
  							top: 30%;
  							left: 2%;
  							overflow: hidden;
  							-ms-transform: translateY(-50%);
  							transform: translateY(-50%);

							 
					"> 
				<h1 class="" style="color:rgba(245, 6, 170,0.90)">Rwanda Driving License</h1>
				<hr>
				<h5 class="text-muted">Register new candidate in system of Rwanda Driving License </h5>
				<a href="candidatelist.php" class="btn btn-sm font-weight-bold mt-3"
					style="

					 			border:solid 1px rgba(245, 6, 170, 0.70);
					 			color: rgba(245, 6, 170, 0.70);
					 			border-radius: 25px;
					 			padding-left: 20px;
					 			padding-right: 20px;
					 		"

				> View Candidate list</a>
				<p class="mt-3"><?php echo$message?></p>
			</div>	
			<div class="col-lg-6  float-right"
						style=" 
							margin: 0;
							border: 1px solid  rgba(245, 6, 170, 1);
  							position: absolute;
  							top: 65%;
  							right: 0%;
  							overflow: hidden;
  							-ms-transform: translateY(-50%);
  							transform: translateY(-50%);

						"	
			>
				<form class="row bg-white" method="POST">
					<div class="col-lg-12" style="
						background-color:rgb(245, 6, 170);
						color: white;
						padding: 10px;
					">
						New Candidate
					</div>
					<div class="col-lg-12">
						<label>Candidate national id</label>
						<input type="number" name="candidate_national_id" class="form-control">
						<small class="text-danger"><i class='fa fa-info-circle'></i> Make sure you entered correct National id and match with 16 numbers</small>
					</div>
					<div class="col-lg-12 mt-3">
						<label>First Name</label>
						<input type="text" name="fname" class="form-control">
					</div>
					<div class="col-lg-12 mt-3">
						<label>Last Name</label>
						<input type="text" name="lname" class="form-control">
					</div>
					<div class="col-lg-12 mt-3">
						<label>Gender</label><br>
						<input type="radio" name="Gender" value="female" checked>Female
						<input type="radio" value="male" name="Gender" >Male
					</div>
					<div class="col-lg-12 mt-3">
						<label>date of birth</label>
						<input type="date" name="dob" class="form-control">
					</div>
					<div class="col-lg-12 mt-3">
						<label>Exam Date</label>
						<input type="date" name="date" class="form-control">
					</div>
					<div class="col-lg-12 mt-3">
						<label>Phone number</label>
						<input type="number" name="phone_number" class="form-control">
						<small class="text-danger"><i class='fa fa-info-circle'></i>Enter valid phone number 10 numbers</small>
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

				</form>
			</div>		
		</div>
	</div>
</body>
</html>