<?php include"header.php";?>
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
		table{
			overflow-x: hidden;
		}
		@media print{
			body{
				visibility: hidden;
			}
			h1{
				visibility: visible;
			}
			.table {
				visibility:visible;
				 
			}
			#span{
				visibility: visible;
			}
		}
	</style>
</head>
	<body> 
		<div class="container-fluid">  
			<a href="index.php" class="font-weight-bold sticky-top">Back home</a>
			<div class="row mt-5 justify-content-center">
				<div class="col-lg-12" style="color:rgba(245, 6, 170, 1);">
					<h1 class="">Rwanda Driving License</h1>
					<div class="d-flex flex-row">
						<div class="flex-fill">
							<p class="text-dark">Search  your results</p>
						</div>
						<div>
							<button onclick="window.print()" style="background-color:rgba(245, 6, 170, 1);" class="float-right bt-sm btn text-white ">Print</button>
						</div>
					</div> 
					<hr>
				</div>
				<div class="col-lg-9">
					<form class="row" method="POST">
						<div class="col-lg-5 mt-2">
							<input type="number" class="form-control" name="id" placeholder="enter your national id number">
						</div>
						<div class="mt-2">
							<button class="btn ml-4 " style="background-color:rgba(245, 6, 170, 1); color: white" name="search">Search</button>
						</div>
					</form>
				</div>
				<div class="col-lg-3">
					<?php
					if (isset($_POST['search'])) {

					$id=$_POST['id'];
						$selectall=mysqli_query($conn, "SELECT * FROM candidate where candidatanationalid='$id'")or die($conn->error); 
						if (mysqli_num_rows($selectall)>0) {
							$sele=mysqli_query($conn,"SELECT * FROM grade where candidatanationalid='$id'")or die($conn->error); 
							 
							$myfecthall=mysqli_fetch_array($selectall);
							$myfeall=mysqli_fetch_array($sele);
							if ($myfecthall['candidatanationalid']!=$myfeall['candidatanationalid']) {
								$exam=$myfecthall['examdate'];

								if ((date('Y-m-d'))<$myfecthall['examdate']) {
										 	 	$colorfill="";
										 	 	$textt="";
										 	 	$linkapply="";
											}else{
												$colorfill="bg-danger text-white";
												$textt="Outdated Exam_date | ";
												$linkapply="<a href='index.php'>Apply Again</a>";
											
											}

							 ?>
								<div class="alert alert-info"><p><i class='fa fa-info-circle'></i>User with this id<strong><?php echo$id?></strong> you did not pass any exam
								but we have your record in registered candidate.</p>
								Exam Date: <?php echo$exam?>

								<hr> <span class="text-danger"><?php echo$textt; echo$linkapply?></span></div>
								 
								 
							<?php 
						}

							?>
								
						</div>
								<?php
						}else{
							?> 
							<?php
						}

						$selectall=mysqli_query($conn, "SELECT * FROM candidateapply where candidatanationalid='$id'")or die($conn->error);
						if (mysqli_num_rows($selectall)>0) {?>
							<div class="alert alert-info"><i class='fa fa-info-circle'></i> User with this id<strong><?php echo$id?></strong> your request is being proccessed please wait.</div>

						<?php }elseif(mysqli_num_rows($selectall)<0){ ?>
							<div class="alert alert-info"> <i class='fa fa-info-circle'></i> User with this id<strong><?php echo$id?></strong> There is no records in our system <a href="inde.php">Apply again</a></div>
							<?php 
						}  
					}

						?> 	 		
					 
				</div>
				<div class="col-lg-12 mt-5">
					
					<?php
					if (isset($_POST['search'])) {
								$id=$_POST['id'];
								if (empty($id)) { ?>
								<div class="text-danger">
									<h4 class=""><i class="fa fa-info-circle"> </i>Type in your  national id</h4>
								</div>

									 
						<?php	
							}else{
						?>

						<span id='span'>Results for candidate with id <strong><?php echo$id?></strong></span>
						<?php

					
						$selectall=mysqli_query($conn, "SELECT * FROM candidate,grade where candidate.candidatanationalid='$id' and grade.candidatanationalid='$id' ")or die($conn->error); 
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
							<div class='col-lg-12 text-center mt-5'> 
								<h1 class="text-muted mt-4"><i class="fa fa-info-circle"></i> no results found here.</h1><br>
								<p><a href="" class="">Refresh again</a></p><br>
								<a href="index.php" class="border p-2 mt-3">Get started</a>
							</div>
							<?php
						}}
					}else{

						?> 	
						<div class='col-lg-12 text-center mt-5'>
								<h1 class="text-muted mt-4"><i class="fa fa-info-circle"></i> Type in your national id..</h1><br>
							</div>		
					<?php

				}
				?>


				</div>
			</div>
		</div>
	</body>
</hmtl>