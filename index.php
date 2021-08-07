<?php include"header.php"; 
$message=''; 
$time=$_SESSION['current']=time();
	if (isset($_POST['login'])) {
		$user_name=$_POST['username'];
		$password=$_POST['password']; 
			if (empty($user_name AND $password)) {
				$message= "<div class='alert alert-danger alert-dismissable'><i class='fa fa-info-circle'></i> Error: Fill all Fields  <a href='#' class='btn' id='showlogin'>Try Again</a></div> "; 
			}else{

   				$mysql=mysqli_query($conn, "SELECT * FROM user");
   				if ($mysql) { 
   					if (mysqli_num_rows($mysql)>0) {
   						while ($result=mysqli_fetch_array($mysql)) { 
   							if ( $result['adminame']==$user_name) {
   								$adminame=$result['adminame'];
   								 $mysql2=mysqli_query($conn, "SELECT * FROM user where adminame='$adminame'")or die("error");
   								 if (mysqli_num_rows($mysql2)>0) {
   								 	$result2=mysqli_fetch_array($mysql2);
   								 	if ($result2['password']==$password) {
   								 		session_start(); 
            						 	$_SESSION['login']=$user_name;
            						 	$_SESSION['unique_id']=$result2['adminid'];
            						 	header('location:dashboard.php');
   								 	}else{
   								 		$message="
   											<div class='alert alert-danger alert-dismissable'><i class='fa fa-info-circle'></i> Admin password incorrect  <a href='#' class='btn' id='showlogin'>Try Again</a> #".$user_name."</div>";
   								 	}
   								 	 
   								 }else{
   								 	$message="
   											<div class='alert alert-danger alert-dismissable'><i class='fa fa-info-circle'></i> No user selected <a href='#' class='btn' id='showlogin'>Try Again</a> #".$user_name."</div>";
   								 }
   									

   							}else{
   								$message="
   									<div class='alert alert-danger alert-dismissable'><i class='fa fa-info-circle'></i> Admin Name incorrect  <a href='#' class='btn' id='showlogin'>Try Again</a> #".$user_name."</div>";
   							}

   						}
   					}else{
   						$message="
   							<div class='alert alert-danger alert-dismissable'><i class='fa fa-info-circle'></i> No users found
   									<a href='#' class='btn' id='showlogin'>Try Again</a> #".$user_name."
   							</div>
   						";
   					}


   				}else{
   					$message="<div class='alert alert-danger alert-dismissable'><i class='fa fa-info-circle'></i>  ".$conn->error." <a href='#' class='btn' id='showlogin'>Try Again</a> </div>";
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
		<div class="container-fluid" style="

			height: 100vh;
			background-image: url('images/013.jpg');
			background-size: ; 

		"> 
			<div class="row"> 
				<div class="col-lg-12" style="

					background-color:rgba(245, 6, 170, 0.59);
					height: 100vh;
					overflow-x: hidden;
					
				">
					<div class="row"> 

						<div class="col-lg-12 p-4 text-right">

							<form method="POST">
							<a href="index.php" class="font-weight-bold text-decoration-none text-white mr-3 home">Home</a>
							<a href="result.php" class="font-weight-bold text-decoration-none text-white mr-3 Result">Results</a>
							<?php 
									if (!isset($_SESSION['login'])) { 
									
								?>
								 
							<?php }else{?>
							<a href="dashboard.php" class="font-weight-bold text-decoration-none text-white mr-3">Dashboard</a>
							
								<?php
								} 
									if (!isset($_SESSION['login'])) { 
									
								?>
								 
							<?php }else{?>
								<a href="profile.php" class=" border p-1 rounded font-weight-bold text-decoration-none text-white mr-3">
									<i class="fa fa-user mr-1" ></i><?php echo$_SESSION['login']?>
								</a>
								
									<button type="submit" name="logout" class="btn btn-sm 	float-right font-weight-bold"><i class="fa fa-door-open"></i>Logout</button>
								
							<?php 
								if (isset($_POST['logout'])) {
									session_destroy();
									header('location:index.php');
								}

							?>
							<?php }?> 
							<a href="footer.php" class="text-decoration-none text-white mr-3">
								<i class="fa fa-question-circle"></i>
							</a>
							</form>

						</div>
						<div class="col-lg-6" style="
					  		margin: 0;
  							position: absolute;
  							top: 30%;
  							left: 4%;
  							overflow: hidden;
  							-ms-transform: translateY(-50%);
  							transform: translateY(-50%);

							 
					"> 
					 		<h1 class="text-white">Rwanda Driving License</h1>
					 		<hr>
					 		<h4 class="">An institution in charge of Provisional And<br> Definitive licence , <br>located in kigali city, Nyarugenge district</h4>


					 		<?php 
									if (isset($_SESSION['login'])) { 
									
								?>
								 
							<?php }else{?>
					 		<a href="#" class="btn mt-3 ml-5" id="showlogin" style="

					 			background: rgba(245, 6, 170, 0.70);
					 			color: white;
					 			border-radius: 25px;
					 			padding-left: 20px;
					 			padding-right: 20px;
					 		">Login As Admin</a>

					 	<?php }?>
						</div>
						<div class="col-lg-6" style="

							margin: 0;
  							position: absolute;
  							top: 30%;
  							right: 4%;
  							overflow: hidden;
  							-ms-transform: translateY(-50%);
  							transform: translateY(-50%);

						"	>  
							<div class="col-lg-12 mt-5 font-weight-bold  text-center">
								<div class="mt-5 p-4"  style="margin-top:; background:  rgba(245, 6, 170, 0.90)">
									<p class="text-dark">Register yourself as a candidate for free to attend rwanda national driving licence exams for both Provisional licence and Definitive licence.</p>
									 
									<a href="#applyparted" id="applyparted" class="btn" style="
												background: rgb(245, 6, 170);
		 									color: white;
		 									border: 1px solid white; 
		 									font-weight: bold;

													">Apply Now</a>
								</div>
							</div>
							<div class="col-lg-12 mt-5">
								<?php
									if (isset($_SESSION['created'])) {
										echo($_SESSION['created']);
									}
								 ?>
								 <?php
									if (isset($_SESSION['message'])) {
										echo($_SESSION['message']);
									}
									if (isset($_SESSION['message_request'])) {
										echo($_SESSION['message_request']);
									}
								 ?>
								<?php  echo$message?>
								
							</div>

							<div class="row mt-5 justify-content-center">
								<div class="col-lg-12 applypart shadow-sm mt-5">
									<?php include('userrequest.php')?>
								</div>
								<div class="col-lg-7 loginpart rounded mt-5 shadow-sm mt-5" style="

									background: rgba(245, 6, 170, 0.90);
					 				color: white;
								"	>
									<div class="">
										<div class="d-flex flex-row p-3 text-white	">
											<div class="flex-grow-1">
												<h5>Login</h5>
											</div>
											<div class="text-dark close" style="cursor: pointer;">
												close
											</div>
										</div>
										<hr>
										<div class="">
											<form class="row p-3" method="POST">
												<div class="col-lg-12"> 
												</div>
												<div class="col-lg-12 mt-3">
													<label class="font-weight-bold">UserName</label>
													<input type="text" name="username" placeholder="User name" class="form-control" autocomplete autofocus>
												</div>
												<div class="col-lg-12 mt-3">
													<label class="font-weight-bold">Password</label>
													<input type="password" name="password" placeholder="ENter password" class="form-control">
												</div>
												<div class="col-lg-12 mt-3">
													<button type="submit" name="login" class="btn  btn-block" 
													style="
														background: rgb(245, 6, 170);
					 									color: white;
					 									border: 1px solid white; 
					 									font-weight: bold;

													" 

													>Login</button>
												</div> 
												<div class="col-lg-6 mt-3">
													<a href="forgot.php" disabled class="link text-dark text-decoration-none">Forgot Password</a>
												</div>
												<div class="col-lg-6 mt-3">
													# 
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>				
			</div> 
		</div>
	<script type="text/javascript"> 
		$(".loginpart").hide();
		$(".applypart").hide();

		$(document).ready(function(){ 

   		$("#showlogin").click(function(){
    		$(".loginpart").show("slow");
    		$(".applypart").hide("slow");

	});

   	$("#applyparted").click(function(){
    		$(".applypart").show("slow");
    		$(".loginpart").hide("slow");

	});


   	$(".close").click(function(){
    		$(".loginpart").hide("slow");
    		$(".applypart").hide("slow");
	}); 


});
		


	</script>
	</body>
</hmtl>