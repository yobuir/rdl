<?php include"header.php"; 
$message=''; 
$time=$_SESSION['current']=time();
   if (isset($_POST['login'])) {
      $user_name=$_POST['username'];
      $password=$_POST['password']; 
         if (empty($user_name AND $password)) {
            $message= "<div class='alert alert-danger alert-dismissable'><i class='fa fa-info-circle'></i> Error: Fill all Fields  <a href='#' class='btn' id='showlogin'>Try Again</a></div> "; 
         }else{

               $mysql=mysqli_query($conn, "SELECT * FROM user");
               if ($mysql) { 
                  if (mysqli_num_rows($mysql)>0) {
                     while ($result=mysqli_fetch_array($mysql)) { 
                        if ( $result['adminame']==$user_name) {
                           $adminame=$result['adminame'];
                            $mysql2=mysqli_query($conn, "SELECT * FROM user where adminame='$adminame'")or die("error");
                            if (mysqli_num_rows($mysql2)>0) {
                              $result2=mysqli_fetch_array($mysql2);
                              if ($result2['password']==$password) {
                                 session_start(); 
                                 $_SESSION['login']=$user_name;
                                 $_SESSION['unique_id']=$result2['adminid'];
                                 header('location:dashboard.php');
                              }else{
                                 $message="
                                    <div class='alert alert-danger alert-dismissable'><i class='fa fa-info-circle'></i> Admin password incorrect  <a href='#' class='btn' id='showlogin'>Try Again</a> #".$user_name."</div>";
                              }
                               
                            }else{
                              $message="
                                    <div class='alert alert-danger alert-dismissable'><i class='fa fa-info-circle'></i> No user selected <a href='#' class='btn' id='showlogin'>Try Again</a> #".$user_name."</div>";
                            }
                              

                        }else{
                           $message="
                              <div class='alert alert-danger alert-dismissable'><i class='fa fa-info-circle'></i> Admin Name incorrect  <a href='#' class='btn' id='showlogin'>Try Again</a> #".$user_name."</div>";
                        }

                     }
                  }else{
                     $message="
                        <div class='alert alert-danger alert-dismissable'><i class='fa fa-info-circle'></i> No users found
                              <a href='#' class='btn' id='showlogin'>Try Again</a> #".$user_name."
                        </div>
                     ";
                  }


               }else{
                  $message="<div class='alert alert-danger alert-dismissable'><i class='fa fa-info-circle'></i>  ".$conn->error." <a href='#' class='btn' id='showlogin'>Try Again</a> </div>";
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
            
         "  >
         <h3>Login now</h3> 
         <hr> 
         <?php echo$message?>
            <form class="row p-3" method="POST">
               <div class="col-lg-12"> 
               </div>
               <div class="col-lg-12 mt-3">
                  <label class="font-weight-bold">UserName</label>
                  <input type="text" name="username" placeholder="User name" class="form-control" autocomplete autofocus>
               </div>
               <div class="col-lg-12 mt-3">
                  <label class="font-weight-bold">Password</label>
                  <input type="password" name="password" placeholder="ENter password" class="form-control">
               </div>
               <div class="col-lg-12 mt-3">
                  <button type="submit" name="login" class="btn  btn-block" 
                  style="
                     background: rgb(245, 6, 170);
                     color: white;
                     border: 1px solid white; 
                     font-weight: bold;

                  " 

                  >Login</button>
               </div> 
               <div class="col-lg-6 mt-3">
                  <a href="forgot.php" disabled class="link text-dark text-decoration-none">Forgot Password</a>
               </div>
               <div class="col-lg-6 mt-3">
                  # 
               </div>
            </form>
             
         </div>
      </div> 
   </body>
</hmtl>