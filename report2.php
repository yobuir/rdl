<?php include"header.php";?>
<?php 
$unique_id=$_SESSION['unique_id'];
$message="";
	if (!isset($_SESSION['login'])) {
		header('location:index.php');
	} 
	if (isset($_POST['send'])) {
		$candidate_national_id=$_POST['candidate_national_id'];
		$licence_exam_category=$_POST['licence_exam_category'];
		$obtained_marks=$_POST['obtained_marks'];
	 
		if ($obtained_marks >=12) {
			$dec='pass';
		}else{
			$dec='fail';
		}
		if (empty($candidate_national_id and $licence_exam_category and $obtained_marks)) {
			$message= "<div class='alert alert-danger'><i class='fa fa-info-circle'></i> Empty space found</div> "; 
		}else{

			$selectall=mysqli_query($conn, "SELECT * FROM grade where candidatanationalid='$candidate_national_id'")or die($conn->error);
			$fetch=mysqli_fetch_array($selectall);

			if ($candidate_national_id==$fetch) {
				$message= "<div class='alert alert-danger'><i class='fa fa-info-circle'></i> Candidate with this id #".$candidate_national_id." already have grade</div> ";
				 
			}else{
				if ($obtained_marks>20 or $obtained_marks<0) {
					$message= "<div class='alert alert-danger'><i class='fa fa-info-circle'></i> Invalid marks </div>";
				}else{
				$unique_id=$_SESSION['unique_id'];
			$sqlinsert=mysqli_query($conn,"INSERT INTO grade VALUES('$candidate_national_id','$licence_exam_category','$obtained_marks','$dec','$unique_id')");
			if ($sqlinsert) {
				$message= "<div class='alert alert-success'><i class='fa fa-info-circle'></i>Grade Added successfull</div> ";
				
			}else{
				$message= "<div class='alert alert-danger'><i class='fa fa-info-circle'></i> Error".$conn->error."</div> ";
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
		@media print{
			body{
				visibility: hidden;
			}
			.table {
				visibility:visible;
				width: 50%;
			}
			h1{
				visibility: visible;
			}
			#span{
				visibility: visible;
			}
		}

	</style>

</head>
<body>
	<div class="container-fluid">
		<div class="row sticky-top">
			<div class="col-lg-12 p-3 text-right " style="
				background-color:rgba(245, 6, 170,1);

			">
			<form method="POST">
				<a href="dashboard.php" class="font-weight-bold text-decoration-none text-white mr-3"><i class="fa fa-home"></i> Home</a>
				<a href="candidate.php" class="font-weight-bold text-decoration-none text-white mr-3"><i class="fa fa-user-plus"></i> New Candidate</a>
					<a href="candidatelist.php" class="font-weight-bold text-decoration-none text-white mr-3"><i class="fa fa-user-check"></i> Candidates</a>
					<a href="grades.php" class="Grades font-weight-bold text-decoration-none text-white mr-3"><i class=" fa fa-graduation-cap"></i> Grades</a>
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
		<div class="row justify-content-center mt-5">
			<div class="col-lg-12">
				<h1 class="" style="color:rgba(245, 6, 170,0.90)">Rwanda Driving License</h1>
				<hr>
				<h5 class="text-muted">Create report for  candidates who done exams</h5>
				<a href="report.php">Create report for registered candidates</a>
			</div>
			<div class="col-lg-12  mt-4">
				<button onclick="window.print()" style="background-color:rgba(245, 6, 170, 1);" class="float-right btn text-white ">Print</button>
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
					<form method="POST" class="ml-3"> 
						<label>Decision</label>  
						<select name="decision">
							<option value="pass">Pass</option>
							<option value="fail">Fail</option>
						</select>
						<button class="btn btn-sm" name="ecision" type="submit" style="
									background-color:rgb(245, 6, 170);
									color: white; 
								">create</button>
					</form>
				</div>
				<hr> 
			</div>
			<hr>
			<div class="col-lg-12 mt-3">  
				<div class="col-lg-12 border ">
					<?php 
					$unique_id=$_SESSION['unique_id'];
				if (isset($_POST['sort'])) { 
					$date=$_POST['date'];
					if(!empty($date)){ 
						$uyear=date('Y', strtotime($date));
						echo("<span id='span'><strong>Exam_date:</strong> ".$date."</span>");
						  $selectall=mysqli_query($conn, "SELECT * FROM candidate,grade where  candidate.candidatanationalid=grade.candidatanationalid and examdate='$date'")or die($con->error);

					}else{
						echo("no date selected");
						 
					}
					 
				}elseif(isset($_POST['ecision'])){
					$decision=$_POST['decision'];
					if(!empty($date)){ 
						echo("<span id='span'><strong>Exam_date:</strong> ".$date."</span>");
						  $selectall=mysqli_query($conn, "SELECT * FROM candidate,grade where  candidate.candidatanationalid=grade.candidatanationalid and decision='$decision'")or die($con->error);
						}else{
							echo("no decision selected");
						}


				}else{
						$selectall=mysqli_query($conn, "SELECT * FROM candidate,grade where  candidate.candidatanationalid=grade.candidatanationalid")or die($conn->error); 
						if (mysqli_num_rows($selectall)>0) {?>
							<div class="">          
							  <table class="table">
							    <thead>
							      <tr>
							        <th>#</th>
							        <th>Candidate_national_id</th>
							        <th>Firstname</th>
							        <th>Lastname</th>
							        <th>Gender</th>
							        <th>Dob</th>
							        <th>Exam_date</th>
							        <th>Phone_number</th> 
							        <th>Licence_exam_category</th>
							        <th>Obtained_marks /20</th>
							        <th>Decision</th>
							        </tr>
								</thead>
							<?php
							while ($myfecthall=mysqli_fetch_array($selectall)) {?>
								<tbody>
									<tr>
										<td></td> 
								        <td><?php echo$myfecthall['candidatanationalid']?></td>
								        <td><?php echo$myfecthall['firstname']?></td>
								        <td><?php echo$myfecthall['lastname']?></td>
								        <td><?php echo$myfecthall['gender']?></td>
								        <td><?php echo$myfecthall['dob']?></td>
								        <td><?php echo$myfecthall['examdate']?></td>
								        <td><?php echo$myfecthall['phonenumber']?></td>
										<td>
											<?php echo$myfecthall['licenceexamcategory']?>
										</td>
										<td>
											<?php echo$myfecthall['obtainedmarks']?>
										</td>
										<td>
											<?php if($myfecthall['decision']=='pass'){?>
												<small class="badge badge-primary">Pass</small>

												<?php
											}else{?>
												<small class="badge badge-danger">Fail</small>

											<?php }
											?>
											
										</td>
									</tr>
								</tbody>
								 
							

							<?php
							}
								?>									
							</table>
						</div>
								<?php
						}else{
							?>
							<small class="text-danger">Candidate Details is not available</small>
							<?php
						}
					}
						?> 			
				</div> 
			</div>
		</div>
	</div>
</body>
</html>