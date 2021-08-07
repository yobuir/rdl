 
<?php include"header.php";?>
<?php 
	if (!isset($_SESSION['login'])) {
		header('location:index.php');
	}
	$unique_id=$_SESSION['unique_id'];
 
if (isset($_POST['type'])==1) {  
	$selectall=mysqli_query($conn, "SELECT * FROM candidate where unique_id='$unique_id'")or die($conn->error);
	if (mysqli_num_rows($selectall)>0) {
		?>
		<small class="text-success small mt-3"><i class='fa fa-info-circle'></i> Suggestions</small>
		<small style="cursor: pointer;" class="text-danger small float-right mt-3" id="close"><i class='fa fa-times'></i> close</small> 
		<table class="table" id="table">
		    <thead>
		      <tr>
		        	<th>#</th>
		        	<th>Candidate_national_id</th>
		      	  	<th>Firstname</th>
		        	<th>Lastname</th>
		        	<th>Exam_date</th> 
		    	</tr>
			</thead>
			<tbody>

		<?php
		while ($myfecthall=mysqli_fetch_array($selectall)) {
		 
		?> 
		
				<tr>
					<td>
						
					</td>
					<td><?php echo$myfecthall['candidatanationalid']?></td>
					<td>
						<?php echo$myfecthall['firstname']?> 
					</td>
					<td>
						<?php echo$myfecthall['lastname']?>
					</td>
					<td>
						<?php echo$myfecthall['examdate']?>
					</td>
					<td> 
					</td>
				</tr>
			<?php }?>
			</tbody>
		</table>  
		<?php

	}else{
		?>
		<small class="text-danger small"><i class='fa fa-info-circle'></i> Candidate with id is not available</small><br><br>
		<small class="alert alert-danger small mt-3"> Check if he/she does not have grades</small>
		<?php
	}
}

?>
<script type="text/javascript">
	$("#close").click(function() {
		$("#table").hide("slow");
		$(".small").hide("slow");
	});
</script>