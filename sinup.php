<?php 
session_start();
include "conn.php";
   if (!isset($_SESSION['login'])) {
      header('location:index.php');
   }
   else{ 
      if($_SESSION['unique_id']!=2147483647) {
         header('location:dashboard.php');
   }
}
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
      if (isset($_POST['create'])) {
         $user_name=test_input($_POST['username']);
         $date=date('Y-m-d');
         $full_username=$user_name;
         $password=test_input($_POST['password']); 
         $cpassword=test_input($_POST['cpassword']);
         $paleng=strlen($password);
               $select=mysqli_query($conn, "SELECT * FROM user where adminame='$user_name'");
               if($select){
                     $fetched=mysqli_fetch_array($select);
                  
                     if ($user_name!='' and $password!='' and $cpassword!='') {
                           if ($paleng < 5) {
                              $message= "<div class='alert alert-danger'><i class='fa fa-info-circle'></i> Atleast five(5) Characters for password</div>";
                           }else{

                              if ($cpassword!=$password) {
                                 $message= "<div class='alert alert-danger'><i class='fa fa-info-circle'></i> Confirm password not match</div>";
                              }else{

                           if ($user_name !=$fetched['adminame'] ) { 
                                 $mysql=mysqli_query($conn,"INSERT into user values('','$full_username','$password','$date')")or die($conn->error);  
                                     header('location:index.php');
                                     $_SESSION['created']="<div class='alert alert-success'><i class='fa fa-info-circle'></i> User_name Account created <strong>#".$user_name."</strong> </div>";
                                     
                                     
                              } 
                              else{
                                 $message= "<div class='alert alert-danger'><i class='fa fa-info-circle'></i> User_name exist </div>";

                              }
                                 }
                              } 
                        }
                     else{
                             $message= "<div class='alert alert-danger'><i class='fa fa-info-circle'></i> Empty space found</div> "; 
                        } 
           }else{
            $message= "<div class='alert alert-danger'><i class='fa fa-info-circle'></i> ".$conn->error."</div> ";
         }}



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
   <div class="container-fluid" style="

         height: 100vh;
         background-image: url('images/013.jpg');
         background-size: cover; 

      ">
         <div class="row">
            <div class="col-lg-12" style="

               background-color:rgba(245, 6, 170, 0.59);
               height: 100vh;
               overflow: hidden;
            ">
               <div class="row">
               <div class="col-lg-12 p-4 text-right">
                
                        <?php
                         
                           if (!isset($_SESSION['login'])) { 
                           
                        ?>
                         
                     <?php }else{?>
                        <a href="profile.php" class=" border p-1 rounded font-weight-bold text-decoration-none text-white mr-3">
                           <i class="fa fa-user mr-1" ></i><?php echo$_SESSION['login']?>
                        </a>

                     <?php }?> 
                  </div>  
                  <div class="col-lg-6 " style="
                     margin: 0;
                     position: absolute;
                     top: 30%;
                     left: 4%;
                     overflow: hidden;
                     -ms-transform: translateY(-50%);
                     transform: translateY(-50%);

                      
               "> 
                     <h1 class="text-white">Rwanda Driving License</h1>
                     <hr>
                     <h5 class="">An institution in charge of Provisional And<br> Definitive licence </h5> 
                        <p class="mt-2"><a href="dashboard.php" class="font-weight-bold text-decoration-none text-white"><i class="fa fa-arrow-alt-circle-left" title="back to login" style="font-size: 20px"></i>
                        </a></p>
                  </div>

                  <div class="col-lg-6 mt-5" style="

                     margin: 0;
                     position: absolute;
                     top: 40%;
                     right: 4%;
                     overflow: hidden;
                     -ms-transform: translateY(-50%);
                     transform: translateY(-50%);

                  "  > 
                     <div class="col-lg-12 mt-5"> 
                     </div>
                     <div class="row mt-5 justify-content-center">
                        <div class="col-lg-7  rounded mt-5 shadow-sm mt-5" style="

                           background: rgba(245, 6, 170, 0.90);
                           color: white;
                        "  >
                           <div class="">
                              <div class="d-flex flex-row p-3 text-white   ">
                                 <div class="flex-grow-1">
                                    <h5>SinUp</h5>
                                    <small class="text-dark">Add new user to system</small>
                                 </div> 
                              </div>
                              <hr>
                              <div class=""> 
                                 <?php echo$message?>
                                 <form class="row" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                                    <div class="col-lg-12 mt-3">
                                       <label class="font-weight-bold">Admin Name</label>
                                       <input type="text" name="username" placeholder="Admin name" class="form-control">
                                    </div>
                                    <div class="col-lg-12 mt-3">
                                       
                                       <input type="text" class="rounded" style="width:100px"name="" value="<?php echo$generated?>"> Suggested strong password<br>
                                    </div>
                                    <div class="col-lg-12 mt-3">
                                       
                                       <label class="font-weight-bold">Password</label>
                                       <input type="password" name="password" placeholder="ENter password" class="form-control">
                                    </div>
                                    <div class="col-lg-12 mt-3">
                                       <label class="font-weight-bold">Confirm Password</label>
                                       <input type="password" name="cpassword" placeholder="ENter password" class="form-control">
                                    </div>
                                    <div class="col-lg-12 mt-3">
                                       <button type="submit" name="create" class="btn btn-block mt-2"
                                       style="
                                          background: rgb(245, 6, 170);
                                          color: white;
                                          border: 1px solid white; 
                                          font-weight: bold;

                                       " 
                                       >Create Account</button>
                                    </div>
                                    <div class="col-lg-6 p-3">
                                       <a href="index.php" class="link text-dark text-decoration-none">Have an account</a>
                                    </div> 
                                 </form>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div> 
               </div>
            </div>
         </div>
      </div>
   </body>
</hmtl>