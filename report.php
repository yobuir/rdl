 <?php include"header.php";?>
<?php 
	if (!isset($_SESSION['login'])) {
		header('location:index.php');
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
	@media print{
			body{
				visibility: hidden;
			}
			.table {
				visibility:visible;
				 
			}
			h1{
				visibility: visible;
			}
			#span{
				visibility: visible;
			}
		}

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
			<div class="col-lg-12 p-3 text-right" style="
				background-color:rgba(245, 6, 170,1);

			">
			<form method="POST">
				<a href="dashboard.php" class="font-weight-bold text-decoration-none text-white mr-3"><i class="fa fa-home"></i> Home</a>
				<a href="candidate.php" class="font-weight-bold text-decoration-none text-white mr-3"><i class="fa fa-user-plus"></i> New Candidate</a>
					<a href="candidatelist.php" class="Candidates font-weight-bold text-decoration-none text-white mr-3"><i class="fa fa-user-check"></i> Candidates</a>
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
						
							<button type="submit" name="logout" class="btn btn-sm float-right font-weight-bold"><i class="fa fa-door-open"></i>Logout</button>
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
			<div class="col-lg-12">
				<h1 class="" style="color:rgba(245, 6, 170,0.90)">Rwanda Driving License</h1>
				<hr>
				<h5 class="text-muted">Create report for  candidate</h5> 
			</div>
			<div class="col-lg-12  mt-4">
				<button onclick="window.print()" style="background-color:rgba(245, 6, 170, 1);" class="float-right btn btn-sm text-white ">Print</button>
				<hr>
				<div class="d-flex flex-row">
					<div class="">
						Create by :  
					</div> 
					<form method="POST" class="ml-3"> 
						<label>Exam Date</label>  
						<input type="date" name="date">
						<button class="btn btn-sm" name="sort" type="submit" style="
									background-color:rgb(245, 6, 170);
									color: white; 
								">create</button>
					</form>
				</div>
				<hr> 
			</div>
			<hr>

			<div class="col-lg-12 mt-5">
				<?php
				$unique_id=$_SESSION['unique_id'];
				if (isset($_POST['sort'])) { 
					$date=$_POST['date'];
					if(!empty($date)){ 
						$uyear=date('Y', strtotime($date));
						echo("<span id='span'><strong>Exam_date:</strong> ".$date."</span>");
						  $selectall=mysqli_query($conn, "SELECT * FROM candidate where unique_id='$unique_id' and examdate like'%$date%'")or die($con->error);

					}else{
						echo("no sort selected");
						 
					}
					 
				}else{
					$selectall=mysqli_query($conn, "SELECT * FROM candidate where unique_id='$unique_id'")or die($con->error);
					}
					if (mysqli_num_rows($selectall)>0) {?>
						<div class="table-responsive">          
						  <table class="table">
						    <thead>
						      <tr>
						        <th>#</th>
						        <th>Candidate_national_id</th>
						        <th>Firstname</th>
						        <th>Lastname</th>
						        <th>Gender</th>
						        <th>date of birth</th>
						        <th>Exam_date</th>
						        <th>Phone_number</th> 
						      </tr>
						    </thead>
						<?php
						
						while ($myfecthall=mysqli_fetch_array($selectall)) { 
							$year=date('Y', strtotime($myfecthall['examdate']));
							 
							$done="";
							$link="";
							$id=$myfecthall['candidatanationalid'];
								$sqlselct=mysqli_query($conn,"SELECT * FROM grade where candidatanationalid='$id'");
								$fet=mysqli_fetch_array($sqlselct);
									if ($fet['candidatanationalid']==$myfecthall['candidatanationalid']) {
										$done="<i style='color:rgba(245, 6, 170,1)' class='fa fa-check' title='grade available'></i>";
										$color="background-color:rgba(245, 6, 170,0.2);color:black";
										$tr="background-color:blue;display:none;";
										
									}else{
											$done="";
											$color="";
											$tr="";
									}


									if ($fet['candidatanationalid']==$myfecthall['candidatanationalid']) {
										$link="<a href='Details.php?U=".$myfecthall['candidatanationalid']."'>Grade</a>";
										$textt=""; 
										
									}else{
											$link="";
											$textt="";  
											if ((date('Y-m-d'))<$myfecthall['examdate']) {
										 	 	$colorfill="";
										 	 	$textt="";
											}else{
												$colorfill="bg-danger text-white";
												$textt="Outdated Exam_date";
											
											}
									}
									


								
							?>

							<tbody>
						      <tr style="<?php echo($tr)?>">
						        <td  style="<?php echo($color)?> "><?php echo$done?></td>
						        <td><?php echo$myfecthall['candidatanationalid']?></td>
						        <td><?php echo$myfecthall['firstname']?></td>
						        <td><?php echo$myfecthall['lastname']?></td>
						        <td><?php echo$myfecthall['gender']?></td>
						        <td><?php echo$myfecthall['dob']?></td>
						        <td class="<?php echo($colorfill)?> "><?php echo$myfecthall['examdate']?></td>
						        <td><?php echo$myfecthall['phonenumber']?></td>
					
						      </tr>
						    </tbody> 
					<?php
							 
						}?>
					  	</table>
					  </div>
					</div>


						<?php
						
					}else{ ?>
						<div class='col-lg-12 text-center mt-5'>
								<h1 class="text-muted mt-4"><i class="fa fa-info-circle"></i> Hello  <?php echo$_SESSION['login']?>, no results found here.</h1><br>
								<p><a href="" class="">Refresh again</a></p><br>
								<a href="candidate.php" class="border p-2 mt-3">Get started</a>
							</div>

						<?php

					}
                  	;

				?>
			</div> 



	</div>  
	<script type="text/javascript"> 

		$(document).ready(function(){
    $(".button").click(function(){
        $(".w3s").attr("id");
    });
});


	</script>

</body>
</html>