<?php
$con=mysqli_connect("localhost","root","");
 
$createdb=mysqli_query($con,"CREATE DATABASE rdl");
if ($createdb) {
	$con=mysqli_connect("localhost","root","","rdl");
	 $createtb=mysqli_query($con,"CREATE TABLE `candidate` (
  candidatanationalid varchar(16) NOT NULL primary key ,
  firstname varchar(255) NOT NULL,
  lastname varchar(255) NOT NULL,
  gender varchar(255) NOT NULL,
  dob varchar(255) NOT NULL,
  examdate varchar(255) NOT NULL,
  examcat varchar(255) NOT NULL,
  phonenumber varchar(12) NOT NULL,
  unique_id varchar(255) NOT NULL
)");


	 if ($createtb) {
		$createtb2=mysqli_query($con,"CREATE TABLE `grade` (
  candidatanationalid varchar(16) NOT NULL primary key,
  licenceexamcategory varchar(255) NOT NULL,
  obtainedmarks int(21) NOT NULL,
  decision varchar(255) NOT NULL,
  unique_id varchar(255) NOT NULL
)");
		if ($createtb2) {
		
			$createtb3=mysqli_query($con,"CREATE TABLE `user` (
  adminid int(11) NOT NULL primary key,
  adminame varchar(255) NOT NULL,
  password varchar(255) NOT NULL
)");

	mysqli_query($con,"CREATE TABLE `session_time_out` (
  adminname varchar(255) NOT NULL primary key, 
  time_ time NOT NULL
)");

mysqli_query($con,"CREATE TABLE `userlogged` ( adminame varchar(255) NOT NULL, password varchar(255) NOT NULL )");


			if ($createtb3) {
				 $createtx=mysqli_query($con,"CREATE TABLE `candidateapply` (
  candidatanationalid varchar(16) NOT NULL primary key ,
  firstname varchar(255) NOT NULL,
  lastname varchar(255) NOT NULL,
  gender varchar(255) NOT NULL,
  dob varchar(255) NOT NULL,
  examdate varchar(255) NOT NULL,
  examcat varchar(255) NOT NULL,
  phonenumber varchar(12) NOT NULL,
  unique_id varchar(255) NOT NULL
)");

$ask=mysqli_query($con,"CREATE TABLE `askedq` (
 id varchar(16) NOT NULL primary key,
  name varchar(255) NOT NULL, 
  question varchar(255) NOT NULL, 
)");

if ($ask) { 
}else{
	echo("asked".$con->error);
}

				 if ($createtx) {$inser=mysqli_query($con,"INSERT INTO `candidate` (`candidatanationalid`, `firstname`, `lastname`, `gender`, `dob`, `examdate`, `phonenumber`, `unique_id`) VALUES
('1234567890111111', 'job', 'iradukunda', 'male', 'DOB', '2021-01-01', '250780809031', '2')");

				if ($inser) {
					$inser2=mysqli_query($con,"INSERT INTO `grade` (`candidatanationalid`, `licenceexamcategory`, `obtainedmarks`, `decision`, `unique_id`) VALUES
('1234567890111111', 'Definitive licence', 12, 'pass', '2')");
					if ($inser2) {
						$inser3=mysqli_query($con,"INSERT INTO `user` (`adminid`, `adminame`, `password`) VALUES
(1, '#kizzG', '123456'),
(2, 'job', '1234567'),
(3, 'admin', 'admin123'),
(4, 'honore', 'honore')");
						if ($inser3) { 
						}else{
							echo($con->error);
						}
				 	
				 }else{
				 	echo($con->error);
				 }
				
					}else{
						echo($con->error);
					}
					
				}else{
					echo($con->error);
				}
 
				$for=mysqli_query($con,"ALTER TABLE grade
ADD FOREIGN KEY (candidatanationalid) REFERENCES candidate(candidatanationalid)");
				
				if ($for) {
					$f=mysqli_query($con,"ALTER TABLE `user` ADD `adminid` INT NOT NULL AUTO_INCREMENT FIRST, ADD PRIMARY KEY (`adminid`)");
				if ($f) {
					echo("DONE");
				}else{
					echo($con->error);
				}
					

				}else{
					echo($con->error);
				}
 

			}else{
				echo($con->error);
			}
		}else{
			echo($con->error);
		}
	}else{
		echo($con->error);
	}
}else{
	echo("error creating db ".$con->error);
} 