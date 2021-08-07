<?php include"header.php";?>
<?php 
	if (!isset($_SESSION['login'])) {
		header('location:index.php');
	}
	$unique_id=$_SESSION['unique_id'];
?>

<!DOCTYPE html>
<html>
<head>
	
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>RDL _ Rwanda driving license</title>  
	<link rel="" type="text/css" href="about_us.png">
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
	 

	<link rel="stylesheet" type="text/css" href="css/fontawesome.css">
	<link rel="stylesheet" type="text/css" href="css/all.css">
	<link rel="stylesheet" type="text/css" href="css/all.mini.css">
	<link rel="stylesheet" type="text/css" href="css/fontawesome.min.css">
	<style type="text/css">
	table th{
			color: rgba(245, 6, 170,0.90);
		}
		table tr{
			border-bottom:1px solid rgba(245, 6, 170,0.90);
		}
		a:hover{
			border-top: 1px solid white;
			transition: 1.3;
		}
		.Home{
			border-top: 1px solid white;
		}
		a{
			color: rgba(245, 6, 170,0.90); 
		}

		@media print{
			body{
				visibility: hidden;
			}
			.ider {
				visibility:visible;
				 
			} 
			.trrr{
				visibility: hidden;
			}
		}

	</style>

</head>
<body>
	<div class="container-fluid">
		<div class="row sticky-top">
			<div class="col-lg-12 p-3 " style="
				background-color:rgba(245, 6, 170,1);

			"> 
			<form method="POST" class="text-right">
				<a href="dashboard.php" class="Home font-weight-bold text-decoration-none text-white mr-3"><i class="fa fa-home"></i> Home</a>
				<a href="candidate.php" class="font-weight-bold text-decoration-none text-white mr-3"><i class="fa fa-user-plus"></i> New Candidate</a>
					<a href="candidatelist.php" class="font-weight-bold text-decoration-none text-white mr-3"><i class="fa fa-user-check"></i> Candidates</a>
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
		<div class="row justify-content-center mt-4">
			<div class="col-lg-12 text-right">
				<a href="users.php" class="btn btn-sm font-weight-bold mt-3"
					style=" 
			 			border:solid 1px rgba(245, 6, 170, 0.70);
			 			color: rgba(245, 6, 170, 0.70);
			 			border-radius: 25px;
			 			padding-left: 20px;
			 			padding-right: 20px;
					 		"

				> System users</a>
				<a href="report.php" class="ml-2 btn  btn-sm font-weight-bold mt-3"
					style=" 
			 			border:solid 1px rgba(245, 6, 170, 0.70);
			 			color: rgba(245, 6, 170, 0.70);
			 			border-radius: 25px;
			 			padding-left: 20px;
			 			padding-right: 20px;
					 		"

				>Report</a>
				
			</div>
			 
			<div class="col-lg-3">
				<div class="col-lg-12  sticky-top mt-3" style="
						background-color:rgb(245, 6, 170);
						color: white;
						padding: 10px;
					">
						Registered Candidates 
						
				</div>
				<div class="col-lg-12 border p-2">
					<div class="d-flex flex-row"> 
						<h6 style="color:rgb(245, 6, 170);" class="flex-fill">
							<?php
							$selectall=mysqli_query($conn, "SELECT count(candidatanationalid) AS total FROM candidate where unique_id='$unique_id'"); 
								$failed=mysqli_fetch_array($selectall);
							echo($failed['total']); 
							?>
						</h6>
						<a href="candidatelist.php"><i class="fa fa-eye"></i></a>
					</div>
				</div>
			</div>

			<div class="col-lg-3">
				<div class="col-lg-12  sticky-top mt-3" style="
						background-color:rgb(245, 6, 170);
						color: white;
						padding: 10px;
					">
						Failed Candidates
				</div>
				<div class="col-lg-12 border p-2">
					<div class="d-flex flex-row">
						<h6 style="color:rgb(245, 6, 170);" class="flex-fill">
							<?php
							$selectall=mysqli_query($conn, "SELECT count(candidatanationalid) AS total FROM grade where decision='fail' and unique_id='$unique_id'"); 
								$failed=mysqli_fetch_array($selectall);
							echo($failed['total']);

							
							?>
						</h6>
						<a href="#failed"><i class="fa fa-eye"></i></a>
					</div>
				</div>
			</div>

			<div class="col-lg-3">
				<div class="col-lg-12  sticky-top mt-3" style="
						background-color:rgb(245, 6, 170);
						color: white;
						padding: 10px;
					">
						Passed Candidates
				</div>
				<div class="col-lg-12 border p-2">
					<div class="d-flex flex-row">
						<h6 style="color:rgb(245, 6, 170);" class="flex-fill">
						<?php
						$selectall=mysqli_query($conn, "SELECT count(candidatanationalid) AS total FROM grade where decision='pass'  and unique_id='$unique_id'"); 
							$failed=mysqli_fetch_array($selectall);
						echo($failed['total']);

						
						?></h6>
						<a href="#passed"><i class="fa fa-eye"></i></a>
					</div>
				</div>
			</div>

			<div class="col-lg-3">
				<div class="col-lg-12  sticky-top mt-3" style="
						background-color:rgb(245, 6, 170);
						color: white;
						padding: 10px;
					">
						Received requests
				</div>
				<div class="col-lg-12 border p-2">
					<div class="d-flex flex-row">
						<h6 style="color:rgb(245, 6, 170);" class="flex-fill">
							<?php
							$selectall=mysqli_query($conn, "SELECT count(candidatanationalid) AS total FROM candidateapply ")or die($conn->error); 
								$failed=mysqli_fetch_array($selectall);
							echo($failed['total']); 
							?>
						</h6>
						<a href="requestlist.php"><i class="fa fa-eye"></i></a>
					</div>
				</div>
			</div> 


			<div class="col-lg-12  mt-4">
				<hr>
				<div class="d-flex flex-row">
					<div class="">
						Sort by :  
					</div> 
					<form method="POST" class="ml-3">
						<select name="Desion">
							<option>Desion</option>
							<option>Pass</option>
							<option>Fail</option>
						</select> 
						<button class="btn btn-sm" name="sort" type="submit" style="
									background-color:rgb(245, 6, 170);
									color: white; 
								">sort</button>
					</form>
					<div class="ml-5">
						<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Type firstnames " title="Type firstname">
					</div>
					<div class="flex-fill">
						<button onclick="window.print()" style="background-color:rgba(245, 6, 170, 1);" class="btn float-right bt-sm  text-white ">Print</button>
					</div>
					
				</div>
				<hr> 
			</div>
			<hr>
			<div class="col-lg-12 ider">
				<?php
				if (isset($_POST['sort'])) {

					$decision=$_POST['Desion'];
					if(!empty($decision)){ 
						echo("<strong>DECISION:</strong> ".$decision);
						$selectall=mysqli_query($conn, "SELECT * FROM candidate,grade where candidate.unique_id='$unique_id' and candidate.candidatanationalid=grade.candidatanationalid and grade.decision='$decision'")or die($conn->error); 
					}else{
						echo("no sort selected");
					}
					 
				}else{
					$selectall=mysqli_query($conn, "SELECT * FROM candidate,grade where candidate.unique_id='$unique_id' and candidate.candidatanationalid=grade.candidatanationalid ")or die($conn->error); 
				}
						if (mysqli_num_rows($selectall)>0) {?>
							<div class="col-lg-12  sticky-top mt-3" style="
									background-color:rgb(245, 6, 170);
									color: white;
									padding: 10px;
								">
									List of Candidates with their grades
			 				</div>
							<div class="table-responsive">          
							  <table class="table" id="myTable">
							    <thead>
							      <tr>
							      	<th>Names</th>  
							        <th>National_id</th> 
							         <th>Gender</th>
							        <th>Licence_exam_category</th>
							        <th>Obtained_marks /20</th>
							        <th>Decision</th>
							        <th class="text-center trrr">Other actions</th>
							        </tr>
								</thead>
							<?php
							while ($myfecthall=mysqli_fetch_array($selectall)) {?>
								<tbody> 
									<tr> 
										<td>
											<?php echo$myfecthall['firstname']?>
											<?php echo$myfecthall['lastname']?>
										</td>  
										<td> 
											<?php echo$myfecthall['candidatanationalid']?>
										</td>
										 
										<td>
											<?php echo$myfecthall['gender']?>
										</td>
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
										<td class="trrr">
											<a href="Details.php?U=<?php echo$myfecthall['candidatanationalid']?>"><i class="fa fa-eye"></i>Details</a>
											<a href="update.php?U=<?php echo$myfecthall['candidatanationalid']?>" class="btn-sm"><i class='fa fa-user-edit'></i>Candidate </a>
											<a href="updateg.php?U=<?php echo$myfecthall['candidatanationalid']?>" class="btn-sm"><i class=" fa fa-edit"></i>Grade</a>
											<a href="deleteg.php?U=<?php echo$myfecthall['candidatanationalid']?>" class="text-danger btn-sm"><i class=" fa fa-trash"></i>Grade</a>
											<a href="delete.php?U=<?php echo$myfecthall['candidatanationalid']?>" class="text-danger btn-sm"><i class=" fa fa-trash"></i>Candidate</a>
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
							<div class='col-lg-12 text-center mt-5'>
								<h1 class="text-muted mt-4"><i class="fa fa-info-circle"></i> Hello  <?php echo$_SESSION['login']?>, no results found here.</h1><br>
								<p><a href="" class="">Refresh again</a></p><br>
								<a href="candidate.php" class="border p-2 mt-3">Get started</a>
							</div>
							<?php
						}
						?> 			
				
				</div>
		</div>
	</div>

<script>
	function myFunction() {
	  var input, filter, table, tr, td, i;
	  input = document.getElementById("myInput");
	  filter = input.value.toUpperCase();
	  table = document.getElementById("myTable");
	  tr = table.getElementsByTagName("tr");
	  for (i = 0; i < tr.length; i++) {
	    td = tr[i].getElementsByTagName("td")[0];
	    if (td) {
	      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
	        tr[i].style.display = "";
	      } else {
	        tr[i].style.display = "none";
	      }
	    }       
	  }
	}
</script>
</body>
</html>