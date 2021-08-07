<?php include"header.php";?>
<?php 
$message="";
	if (!isset($_SESSION['login'])) {
		header('location:index.php');
	}
	$id=$_GET['U'];

	if (isset($_POST['send'])) { 
		$licence_exam_category=$_POST['licence_exam_category'];
		$obtained_marks=$_POST['obtained_marks'];
	 
		if ($obtained_marks >=12) {
			$dec='pass';
		}else{
			$dec='fail';
		}
		if (empty($licence_exam_category and $obtained_marks)) {
			$message= "<div class='alert alert-danger'><i class='fa fa-info-circle'></i> Empty space found</div> "; 
		}else{
			$sqlinsert=mysqli_query($conn, "UPDATE grade SET obtainedmarks='$obtained_marks',licenceexamcategory='$licence_exam_category',decision='$dec' where candidatanationalid='$id'");
			if ($sqlinsert) {
				$message= "<div class='alert alert-success'><i class='fa fa-info-circle'></i>Grade Updated successfull</div> ";
				
			}else{
				$message= "<div class='alert alert-danger'><i class='fa fa-info-circle'></i> Error".$conn->error."</div> ";
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
		<a href="dashboard.php" class="font-weight-bold text-decoration-none" style="
		color: rgba(245, 6, 170, 1); 

		"><i class="fa fa-arrow-alt-circle-left" title="back to login" style="font-size: 20px"></i><span>Back </span>
                        </a>
		</div>

		<div class="col-lg-6 ml-5">
			<form method="POST" class="row">
					<div class="col-lg-12  sticky-top" style="
						background-color:rgb(245, 6, 170);
						color: white;
						padding: 10px;
					">
						Record Grade for Candidate <strong>#<?php echo$_GET['U']?></strong>
					</div> 

					<?php
						$id=$_GET['U'];
					$selectall=mysqli_query($conn, "SELECT * FROM grade where candidatanationalid='$id' ")or die($con->error);
					if (mysqli_num_rows($selectall)>0) {
							$myfecthall=mysqli_fetch_array($selectall);
						?>

					<div class="col-lg-12 mt-3"> 
						<label>Candidate national id</label>
						<input type="number" name="candidate_national_id" class="form-control" disabled value="<?php echo$_GET['U']?>">
						<small class="text-danger"><i class='fa fa-info-circle'></i> National id can't be changed</small> 
					</div>
					<div class="col-lg-12 mt-3">
						<label>licence exam category</label>
						<select name="licence_exam_category" class="form-control">
							<option value="Provisional licence" >Provisional licence</option>
							<option value="Definitive licence">Definitive licence</option>
						</select>
						 <strong><i class='fa fa-info-circle'></i><?php echo($myfecthall['licenceexamcategory'])?></strong>
					</div>
					<div class="col-lg-12 mt-3">
						<label>Obtained marks</label>
						<input type="number" max="20" value="<?php echo($myfecthall['obtainedmarks'])?>" min="0" name="obtained_marks"  class="form-control"> 
					</div> 
					<div class="col-lg-12 mt-3" > 
						<button class="btn btn-sm" name="send" type="submit" style="
						background-color:rgba(245, 6, 170,1);
						color: white;
						padding: 10px;
					">
							Confirm
						</button>
						<button type="reset"  title="reset form" class="btn float-right font-weight-bold text-decoration-none" 
						style="
							color: rgba(245, 6, 170, 1); 
							border: 1px solid rgba(245, 6, 170, 1);
							"> <span>Reset</span>
                        </button> 
					</div>
					<?php }else{?>
					<div class='col-lg-12 alert alert-danger'><i class='fa fa-info-circle'></i> No candidate grade found</div>
				<?php }?>
				</form> 
		</div>
	</div>
</div>
				