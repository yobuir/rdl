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

		if (filter_input(INPUT_POST, "candidate_national_id", FILTER_VALIDATE_INT)) {
    		$message= "<div class='alert alert-danger'><i class='fa fa-info-circle'></i> Enter valid numbers</div> ";
		} else {

		if (!filter_input(INPUT_POST, "obtained_marks", FILTER_VALIDATE_INT)) {
    		$message= "<div class='alert alert-danger'><i class='fa fa-info-circle'></i> Enter valid numbers</div> ";
		}else{			 
		if ($obtained_marks >=12) {
			$dec='pass';
		}else{
			$dec='fail';
		}

		if (empty($candidate_national_id and $licence_exam_category and $obtained_marks)) {
			$message= "<div class='alert alert-danger'><i class='fa fa-info-circle'></i> Empty space found</div> "; 
		}else{

			$selectall=mysqli_query($conn, "SELECT * FROM grade where candidatanationalid='$candidate_national_id'")or die($conn->error);
			$selectal=mysqli_query($conn, "SELECT * FROM candidate where candidatanationalid='$candidate_national_id'")or die($conn->error);
			$fetch=mysqli_fetch_array($selectall);
			$fetchingexamx=mysqli_fetch_array($selectal);

			if ($candidate_national_id==$fetch) {
				$message= "<div class='alert alert-danger'><i class='fa fa-info-circle'></i> Candidate with this id #".$candidate_national_id." already have grade</div> ";
				 
			}else{
				if ($obtained_marks>20 or $obtained_marks<0) {
					$message= "<div class='alert alert-danger'><i class='fa fa-info-circle'></i> Invalid marks </div>";
				}else{
				$unique_id=$_SESSION['unique_id'];
				if ($fetch['examcat']='') {
					$licence_exam_category=$_POST['licence_exam_category'];
				}else{
					$licence_exam_category=$fetchingexamx['examcat'];
				}
			$sqlinsert=mysqli_query($conn,"INSERT INTO grade VALUES('$candidate_national_id','$licence_exam_category','$obtained_marks','$dec','$unique_id')");
			if ($sqlinsert) {
				$message= "<div class='alert alert-success'><i class='fa fa-info-circle'></i>Grade Added successfull</div> ";
				
			}else{
				$message= "<div class='alert alert-danger'><i class='fa fa-info-circle'></i> Error".$conn->error."</div> ";
				}
			}
			}
		}}}
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
		.Grades{
			border-top: 1px solid white;
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
			<div class="col-lg-6 mt-3 border"> 
				<form method="POST" class="row">
					<div class="col-lg-12 " style="
						background-color:rgb(245, 6, 170);
						color: white;
						padding: 10px;
					">
						Record Grade for Candidate <strong>#</strong>
					</div>
					<div class="col-lg-12 mt-3">
						<?php echo$message?>
					</div>
					<div class="col-lg-12 mt-3">
						<label>Candidate national id</label>
						<input type="number" id="candidate_national_id" name="candidate_national_id" class="form-control" onkeyup="checkinger()"> 
					</div>
					<div class="col-lg-12 mt-3">
						<label>licence exam category</label>
						<select name="licence_exam_category" class="form-control">
							<option value="Provisional licence">Provisional licence</option>
							<option value="Definitive licence">Definitive licence</option>
						</select>

					</div>
					<div class="col-lg-12 mt-3">
						<label>Obtained marks</label>
						<input type="number" max="20" min="0" name="obtained_marks"  class="form-control">
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
				</form> 
			</div> 
			<div class="col-lg-4 mt-3"> 
				<div class="col-lg-12 " style="
						background-color:rgb(245, 6, 170);
						color: white;
						padding: 10px;
					">
						Recent Added Grades for Candidate <strong>#</strong>
				</div>
				<div class="col-lg-12 border ">
					<?php
						$selectall=mysqli_query($conn, "SELECT * FROM candidate,grade where candidate.unique_id='$unique_id' and candidate.candidatanationalid=grade.candidatanationalid  limit 3")or die($conn->error); 
						if (mysqli_num_rows($selectall)>0) {?>
							<div class="table-responsive">          
							  <table class="table">
							    <thead>
							      <tr>
							        <th>#</th>
							        <th>National_id</th>
							        <th>Firstname</th>
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
							<small class="text-danger">Candidate Grades is not available</small>
							<?php
						}
						?>
						<a href="dashboard.php">view more candidate grades</a>			
				</div>

				<div class="col-lg-12 mt-3" style="
						background-color:rgb(245, 6, 170);
						color: white;
						padding: 10px;
					">
					<div class="row">
						<div class="col-lg-12"> 
							List of Candidate <strong>#</strong>
						</div>
						<div class="col-lg-12">
							<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Type firstnames " title="Type firstname">
						</div>
					</div>
				</div>
				<div class="col-lg-12 border ">
					<?php
					if (mysqli_num_rows($selectall)>0) {
					$isd=$myfecthall['candidatanationalid'];

						$selectall=mysqli_query($conn, "SELECT * FROM candidate where unique_id='$unique_id' and candidatanationalid!='$isd' order by examdate desc ")or die($conn->error); 
						if (mysqli_num_rows($selectall)>0) {?>
							<div class="table-responsive">          
							  <table class="table" id="myTable">
							    <thead>
							      <tr>
							      	<th>Firstname</th>
							      	<th>Lastname</th>
							        <th>National_id</th>  
							        <th>Gender</th>
							        <th>exam date</th>
							        <th>phonenumber</th>
							        </tr>
								</thead>
							<?php
							while ($myfecthall=mysqli_fetch_array($selectall)) {?>
								 
									<tr>
										<td><?php echo$myfecthall['firstname']?></td>
										<td> 
											<?php echo$myfecthall['lastname']?>
										</td>
										<td><?php echo$myfecthall['candidatanationalid']?>
										</td> 
										
										<td> 
											<?php echo$myfecthall['gender']?>
										</td>
										<td> 
											<?php echo$myfecthall['examdate']?>
										</td>
										<td> 
											<?php echo$myfecthall['phonenumber']?>
										</td>
										

									</tr> 
								 
							

							<?php
							}
								?>									
							</table>
						</div>
								<?php
						}else{
							?>
							<small class="text-danger">Candidates are not available</small>
							<?php
						}
						}else{?>
								<small class="text-danger">Candidates are not available</small>
						<?php }
						?>
						<a href="dashboard.php" class="mt-3">view more candidate</a>			
				</div>



			</div>
		</div>
	</div>

<script type="text/javascript">
	$(".contenter").hide();
	function checkinger() {
		$(".contenter").show("slow");			
		$.ajax({
			type:"POST",
			url:"searchcand.php",
			cashe:false,
			data:{
				type:1,
				$candidate_national_id:$("#candidate_national_id").val(),

			},
			success:function(data){
				$(".contenter").show("slow");
				$(".contenter").html(data);
			}
		});
	}
	 
</script>
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