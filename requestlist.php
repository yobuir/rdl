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
			<div class="col-lg-12">
				<h1 class="" style="color:rgba(245, 6, 170,0.90)">Rwanda Driving License</h1>
				<hr>
				<h5 class="text-muted">List of Requested candidate to join Rwanda Driving License Exams</h5> 
				<a href="requests.php" class="btn float-right btn-sm font-weight-bold mt-3"
					style="

					 			border:solid 1px rgba(245, 6, 170, 0.70);
					 			color: rgba(245, 6, 170, 0.70);
					 			border-radius: 25px;
					 			padding-left: 20px;
					 			padding-right: 20px;
					 		"

				> import all candidate</a>
			
			</div>
			<div class="col-lg-12 mt-5">
				<?php
				$unique_id=$_SESSION['unique_id'];
					$selectall=mysqli_query($conn, "SELECT * FROM candidateapply")or die($con->error);
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
						        <th>Date of birth</th>
						        <th>Exam_date</th>
						        <th>Exam_Category</th>
						        <th>Phone_number</th> 
						        <th>#</th> 
						      </tr>
						    </thead>
						<?php
						while ($myfecthall=mysqli_fetch_array($selectall)) {				
							?>

							<tbody>
						      <tr>
						        <td  style="<?php echo($color)?>"></td>
						        <td><?php echo$myfecthall['candidatanationalid']?></td>
						        <td><?php echo$myfecthall['firstname']?></td>
						        <td><?php echo$myfecthall['lastname']?></td>
						        <td><?php echo$myfecthall['gender']?></td>
						        <td><?php echo$myfecthall['dob']?></td>
						        <td><?php echo$myfecthall['examdate']?></td>
						        <td><?php echo$myfecthall['examcat']?></td>
						        <td><?php echo$myfecthall['phonenumber']?></td>
						        <td> 
						        	<a href="deleter.php?U=<?php echo$myfecthall['candidatanationalid']?>" class="btn btn-sm btn-danger" target="blank"><i class="fa fa-trash"></i></a> 
						        </td> 
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