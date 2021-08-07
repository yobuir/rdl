<?php 
session_start();
include "conn.php"; 
?>

 <?php 
 function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data; 
}
 
  $upper_case="ABCDEFGHIJKLMNOPQRSTUVWXYZ";
         $lower=strtolower($upper_case);
         $number="0123456789";
         $special="!@#$%^&*()";
         $generated_upper=substr(str_shuffle($upper_case),0,2);
         $generated_lower=substr(str_shuffle($lower),0,3);
         $generated_number=substr(str_shuffle($number),0,2);
         $generated_special=substr(str_shuffle($special),0,2);
         $generated_p="$generated_upper$generated_lower$generated_number$generated_special";
         $generated=substr(str_shuffle($generated_p),0,8);


 $message="";
      if (isset($_POST['change'])) { 
      	$unique_id=$_POST['unique_code'];
         $password=test_input($_POST['password']); 
         $cpassword=test_input($_POST['cpassword']); 
         $paleng=strlen($password);

         if (empty($unique_id or $password or $cpassword)) {
         	 $message= "<div class='alert alert-danger'><i class='fa fa-info-circle'></i> empty space found</div>";
         	
         }else{
               $select=mysqli_query($conn, "SELECT * FROM user where adminid='$unique_id'");
               if($select){
                     $fetched=mysqli_fetch_array($select);

                     if($unique_id==$fetched['adminid']){

                     if ($unique_id!='' and $password!='' and $cpassword!='') {
                           if ($paleng < 5) {
                              $message= "<div class='alert alert-danger'><i class='fa fa-info-circle'></i> Atleast five(5) Characters for password</div>";
                           }else{

                              if ($cpassword!=$password) {
                                 $message= "<div class='alert alert-danger'><i class='fa fa-info-circle'></i> Confirm password not match</div>";
                              }else{
  
                                 $mysql=mysqli_query($conn,"UPDATE user SET password='$password'where adminid='$unique_id'")or die($conn->error);   
                                     $message="<div class='alert alert-success'><i class='fa fa-info-circle'></i> Account changed  <a href='login.php'>Login now</a></div>";
                                     
                                     
                                
                                 }
                              } 
                        }
                     else{
                             $message= "<div class='alert alert-danger'><i class='fa fa-info-circle'></i> Empty space found</div> "; 
                        } 
                    }else{
                    	$message= "<div class='alert alert-danger'><i class='fa fa-info-circle'></i> Enter correct code </div> "; 
                    }
           }else{
           			$message=$conn->error;
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
</head>
	<body>
		<div class="container">  
		<div class="row mt-5 justify-content-center">
			<div class="col-lg-5 loginpart rounded mt-5  mt-5" style="

				color: rgba(245, 6, 170, 0.90);
 				
			"	>
			<h3>Forgot password</h3> 
			<hr> 
			<?php echo$message?>
				<form class="row" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
	                <div class="col-lg-12 mt-3"> 
	                   <label class="font-weight-bold">Account unique Code </label>
	                   <input type="text" name="unique_code" placeholder="Enter unique_code" class="form-control">
	                </div>
	                <div class="col-lg-12 mt-3"> 
	                   <input type="text" class="rounded" style="width:100px"name="" value="<?php echo$generated?>"> Suggested strong password<br>
	                </div>
	                <div class="col-lg-12 mt-3"> 
	                   <label class="font-weight-bold">New Password</label>
	                   <input type="password" name="password" placeholder="ENter password" class="form-control">
	                </div>
	                <div class="col-lg-12 mt-3">
	                   <label class="font-weight-bold">Confirm Password</label>
	                   <input type="password" name="cpassword" placeholder="ENter password" class="form-control">
	                </div>
	                <div class="col-lg-12 mt-3">
	                   <button type="submit" name="change" class="btn btn-block mt-2"
	                   style="
	                      background: rgb(245, 6, 170);
	                      color: white;
	                      border: 1px solid white; 
	                      font-weight: bold;

	                   " 
	                   >Change Account</button>
	                </div>
	                <div class="col-lg-6 p-3">
	                   <a href="index.php" class="link text-dark text-decoration-none">Cancel</a>
	                </div> 
	             </form>
				 
			</div>
		</div> 
	</body>
</hmtl>