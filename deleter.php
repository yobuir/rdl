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
        $sg=mysqli_query($conn, "DELETE FROM candidateapply WHERE candidatanationalid='$id'");
        
                 if ($sg) {
                    $message="<div class='alert alert-success'><i class='fa fa-info-circle'></i> Candidate deleted successful</div>";
                  } else{
                    $message="<div class='alert alert-danger'> <i class='fa fa-info-circle'></i> ".$conn->error."</div>";
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

		<div class="col-lg-6 ml-5">
			<form class="row ml-5 sticky-top" method="POST">
					<div class="col-lg-12  sticky-top" style="
						background-color:rgb(245, 6, 170);
						color: white;
						padding: 10px;
					">
						Delete Candidate request <strong>with ID#<?php echo$_GET['U']?></strong>
					</div>

					<?php
						$id=$_GET['U'];
					$selectall=mysqli_query($conn, "SELECT * FROM candidateapply where candidatanationalid='$id' ")or die($con->error);
					if (mysqli_num_rows($selectall)>0) {?>

					<div class="col-lg-12 mt-5">
						<button class="btn btn-sm" name="send" type="submit" style="
						background-color:rgba(245, 6, 170,1);
						color: white;
						padding: 10px;
					">
							Confirm
						</button>

						<a href="candidatelist.php" class="btn float-right font-weight-bold text-decoration-none" 
						style="
							color: rgba(245, 6, 170, 1); 
							border: 1px solid rgba(245, 6, 170, 1);
							">
							<i class="fa fa-arrow-alt-circle-left" title="back to login" style="font-size: 20px"></i><span>Back </span>
                        </a>
					</div>
				<?php }else{?>
					<div class='col-lg-12 alert alert-danger'><i class='fa fa-info-circle'></i> No Candidate found <a href="requestlist.php"><strong>Back to list</strong></a></div>
				<?php }?>

				</form>
		</div>
	</div>
</div>
				