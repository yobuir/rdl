<?php 
session_start();
include "conn.php"; 
$message="";
?>
<?php 
	if (!isset($_SESSION['login'])) {
		header('location:index.php');
	}else{ 
		if($_SESSION['unique_id']!=2147483647) {
			header('location:dashboard.php');
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
	</style>
</head>

	<body>
		<div class="container-fluid">  
			<div class="row sticky-top">
			<div class="col-lg-12 sticky-top p-3 text-right" style="
				background-color:rgba(245, 6, 170,1);

			">
			<form method="POST">
				<a href="dashboard.php" class="font-weight-bold text-decoration-none text-white mr-3"><i class="fa fa-home"></i> Home</a>
				<a href="candidate.php" class=" font-weight-bold text-decoration-none text-white mr-3"><i class="fa fa-user-plus"></i> New Candidate</a>
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
		<div class="row mt-5 justify-content-center">
			<div class="col-lg-5 loginpart rounded mt-5  mt-5">
			<h3 class="text-muted">System registered users</h3> 
			<hr>  

			<?php  
        		$select=mysqli_query($conn, "SELECT * FROM user");
               		if($select){
               			if (mysqli_num_rows($select)) {?>
               			<div class="table-responsive">          
						  <table class="table">
						    <thead>
               					<tr>
               						<th>#</th>
               						<th>Name </th>
               						<th>Date</th>
               						<th></th>
               					</tr>
               				</thead>
               				
               				<?php
               				 while ($fetched=mysqli_fetch_array($select)) {?>
               				 	<tr>
               				 		 <td>
               				 		 	<?php echo$fetched['adminid']?>
               				 		 </td>
               				 		 <td>
               				 		 	<?php echo$fetched['adminame']?>
               				 		 </td>
               				 		 <td>
               				 		 	<?php echo$fetched['time_']?>
               				 		 </td>
               				 		 <td> 
               				 		 	<?php if($_SESSION['unique_id']!=2147483647) {?>
               				 		 	<a href="deleteu.php?unique_id=<?php echo($fetched['adminid'])?>">Delete</a>
               				 		 	<?php }?>
									</td>
               				 	</tr>
               				 	 
               			<?php
               				
               				 }
               				 ?>
               				 </table>
               				</div>

               				 <?php
               			}else{
               				$message= "<div class='alert alert-danger'><i class='fa fa-info-circle'></i> No users found </div> ";
               			}
                     	
   						}else{
           					$message=$conn->error;
           				}
           	?>
				<?php echo$message?> 
			</div>
		</div> 
	</body>
</hmtl>