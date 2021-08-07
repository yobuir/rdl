<?php 
  $message="";
    if (isset($_POST['send'])) {
      $candidate_national_id=$_POST['candidate_national_id']; 
      $fname=$_POST['fname'];
      $lname=$_POST['lname'];
      $Gender=$_POST['Gender'];  
      $dob=$_POST['dob'];
      $exdate=$_POST['date']; 
      $phone_number=$_POST['phone_number']; 
      $licence_exam_category=$_POST['licence_exam_category'];
      $idlength=strlen($candidate_national_id);
      $phonelength=strlen($phone_number);
      $year=date('Y');
      $useryear=date('Y', strtotime($dob));
       $validyear=$year-$useryear;
      
       if ($candidate_national_id=='' or $fname=='' or $lname=='' or $Gender==''or $dob==''or $exdate==''or $phone_number=='' or $licence_exam_category=='') {
       	header('loction:index.php');
               $message= "<div class='alert alert-danger'><i class='fa fa-info-circle'></i> Fill all fields</div>";
               $_SESSION['message_request']=$message;
                     
              }else{
              	#if (filter_input(INPUT_POST, "candidate_national_id", FILTER_VALIDATE_INT)) {
			    		#$message= "<div class='alert alert-danger'><i class='fa fa-info-circle'></i> Enter valid numbers for id</div> ";
					#} else {

					#if (!filter_input(INPUT_POST, "phone_number", FILTER_VALIDATE_INT)) {
			    		#$message= "<div class='alert alert-danger'><i class='fa fa-info-circle'></i> Enter valid numbers for phone</div> ";
					#}
			    	#else{
              	$selectall=mysqli_query($conn, "SELECT * FROM candidateapply where candidatanationalid='$candidate_national_id' or phonenumber='$phone_number'")or die($con->error);
                  $myfecthall=mysqli_fetch_array($selectall);

                  if ($idlength!=16) {
                  	header('loction:index.php');
                   	$message="<div class='alert alert-danger'>
                   	<i class='fa fa-info-circle'></i> 
                   	enter valid candidate national id</div>";
                   	$_SESSION['message_request']=$message;
                  }else{ 

                  	if ($phonelength!=10) {
                  		header('loction:index.php');
                  		$message="<div class='alert alert-danger'>
                   					<i class='fa fa-info-circle'></i> 
                   				enter valid phone_number</div>";
                   				$_SESSION['message_request']=$message;
                  	}else{
                    if ($candidate_national_id!=$myfecthall['candidatanationalid']) {
                    	if ($exdate < (date('d-m-Y'))) {
                    		header('loction:index.php');
                    		$message="<div class='alert alert-danger'>
                   					<i class='fa fa-info-circle'></i> 
                   				enter valid exam date</div>";
                   				$_SESSION['message_request']=$message;
                    	}else{
                    		if ($validyear < 18) {
                    			header('loction:index.php');
                    			$message="<div class='alert alert-danger'><i class='fa fa-info-circle'></i>Allowed Candidate are those with more than 18 years </div>";
                    			$_SESSION['message_request']=$message;
                    		}else{
                    	if ($phone_number!=$myfecthall['phonenumber']) {
                    		 
                    		$sg=mysqli_query($conn, "INSERT INTO candidateapply VALUES('$candidate_national_id','$fname','$lname','$Gender','$dob','$exdate','$licence_exam_category','$phone_number','')");
                    		if ($sg) {
                    			header('loction:index.php');
                    			$message="<div class='alert alert-success'><i class='fa fa-info-circle'></i> Candidate request sent</div>";
                    			$_SESSION['message_request']=$message;
                    		} else{
                    			header('loction:index.php');
                    			$message="<div class='alert alert-danger'> <i class='fa fa-info-circle'></i> ".$conn->error."</div>";
                    			$_SESSION['message_request']=$message;
                    		}

                    	}else{
                    		header('loction:index.php');
                    		$message="<div class='alert alert-danger'><i class='fa fa-info-circle'></i> Phone number already exist</div>";
                    		$_SESSION['message_request']=$message;
                    	}
                    }
					}
                    }else{
                    	header('loction:index.php');
                    	$message="<div class='alert alert-danger'><i class='fa fa-info-circle'></i> National id already exist</div>";
                    	$_SESSION['message_request']=$message;
                    }
                }
                }
              #}
          #}
      }
    }

?> 
	<div class="container-fluid mt-5 ">
		<div class="row justify-content-center mt-5"> 		  	
			<div class="col-lg-12 mt-5">
				<form class="row bg-white mt-5" method="POST">
					<div class="col-lg-12 sticky-top" style="
						background-color:rgb(245, 6, 170);
						color: white;
						padding: 10px;
					">
						New Candidate <span class="float-right text-white"><a href="help.php" class="text-decoration-none text-white"><i class="fa fa-question-circle"></i>Ask how</a></span>
					</div>
					<div class="col-lg-12 pt-2">

						<?php echo$message;?>
						<?php $_SESSION['message']=$message?>
					</div>
					<div class="col-lg-12">
						<label>Candidate national id</label>
						<input type="number" name="candidate_national_id" class="form-control">
						<small class="text-danger"><i class='fa fa-info-circle'></i> Make sure you entered correct National id and match with 16 numbers</small>
					</div>
					<div class="col-lg-12 mt-3">
						<label>First Name</label>
						<input type="text" name="fname" class="form-control">
					</div>
					<div class="col-lg-12 mt-3">
						<label>Last Name</label>
						<input type="text" name="lname" class="form-control">
					</div>
					<div class="col-lg-12 mt-3">
						<label>Gender</label><br>
						<input type="radio" name="Gender" value="female" checked>Female
						<input type="radio" value="male" name="Gender" >Male
					</div>
					<div class="col-lg-12 mt-3">
						<label>Date of birth</label>
						<input type="date" name="dob" class="form-control">
					</div>
					<div class="col-lg-12 mt-3">
						<label>Exam Date</label>
						<input type="date" name="date" class="form-control">
					</div>
					<div class="col-lg-12 mt-3">
						<label>licence exam category</label>
						<select name="licence_exam_category" class="form-control">
							<option value="Provisional licence">Provisional licence</option>
							<option value="Definitive licence">Definitive licence</option>
						</select>
					</div>
					<div class="col-lg-12 mt-3">
						<label>Phone number</label>
						<input type="number" name="phone_number" class="form-control">
						<small class="text-danger"><i class='fa fa-info-circle'></i>Enter valid phone number 10 numbers</small>
					</div>
					<div class="col-lg-12 mt-3" > 
						<button class="btn btn-sm" name="send" type="submit" style="
						background-color:rgba(245, 6, 170,1);
						color: white;
						padding: 10px;
					">
						Confirm
						</button>
						<span  class="float-right btn btn-sm text-dark close" style="cursor: pointer;">
							close
						</span>
					</div>

				</form>
			</div>		
		</div>
	</div> 