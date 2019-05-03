<?php
	$user_id=$_SESSION['login_user'];
	$utype=$_SESSION['user_type']=$row['type']; 
	$sub=mysql_query("SELECT * FROM mst_employee WHERE type='$utype' and id='$user_id'")or die(mysql_error());
	$array=mysql_fetch_array($sub);
	$sub_id=$array['user_id'];
	// this is for edit record 
	if(isset($_GET['pro_id']))
	{
		$rec_id=$_GET['pro_id'];

		$sql = mysql_query("SELECT * FROM new_project WHERE id='$rec_id'")or die(mysql_error($connection));
		$data=mysql_fetch_array($sql);
		$assign_to_emp = $data['assign_to'];
	}
	else{}
?>
<div class="row">
<h3>Project Details</h3><hr>
	<div class="col-md-12">
		<div class="col-md-4"><label>Project Name:</label>
		<?php echo $data['pro_name']; ?>
		</div>
		<div class="col-md-4"><label>Project Owner:</label>
		<?php echo $data['owner_name']; ?>
		</div>
		<div class="col-md-4"><label>Contact No:</label>
		<?php echo $data['cont_phone']; ?>
		</div>
	</div>
	<div class="col-md-12">
		<div class="col-md-4"><label>Email-Id:</label>
		<?php echo $data['cont_email']; ?>
		</div>
		<div class="col-md-4"><label>Project Cost:</label>
		<?php echo $data['pro_cost']; ?>
		</div>
		<div class="col-md-4"><label>Address:</label>
		<?php echo $data['address']; ?>
		</div>
	</div>
	<div class="col-md-12">
		<div class="col-md-4"><label>Start Date:</label>
		<?php echo $data['s_date']; ?>
		</div>
		<div class="col-md-4"><label>End Date:</label>
		<?php echo $data['e_date']; ?>
		</div>
		<div class="col-md-4"><label>Actual End Date:</label>
		<?php echo $data['a_date']; ?>
		</div>
	</div>
	<div class="col-md-12">
		<div class="col-md-4"><label>Project Type:</label>
		<?php echo $data['pro_type']; ?>
		</div>
		<div class="col-md-8"><label>Assign To:</label>
		<?php echo $data['assign_to_name']; ?>
		</div>
		
	</div>
	<div class="panel-body"></div><hr>
	<div class="col-lg-12" >
	    <h4>Task List</h4>
		<table class="datatable table table-striped" id="example" cellspacing="0" width="100%">
		  <thead>
			<tr>
			  <th>Sr.No</th>
			  <th>Description</th>
			  <th>Start Date</th>
			  <th>End Date</th>
			  <th>Status</th>
			  <th>Status Percentage</th>
			  <th>Assigned To</th>
			  <th>Remark</th>
			  
			</tr>
		  </thead>
		  <tbody>
            <?php 
            include "config.php";
            $sr_no=0;
            $sql =mysql_query("SELECT * FROM project_task WHERE pro_id='$rec_id'")or die(mysql_error($connection));
               while($row=mysql_fetch_array($sql))
               {
               	$sr_no++;
            ?>
			<tr id="invoice-23">
			  <td><?php echo $sr_no; ?></td>
			  <td><?php echo $row['description']; ?></td>
			  <td><?php echo $row['start_date']; ?></td>
			  <td><?php echo $row['end_date']; ?></td>
			  <td><?php echo $row['status']; ?></td>
			  <td>
			  	<?php
				  	if(empty($row['percentage']))echo "0%";
				  	else
				   	echo $row['percentage']."%"; 
				?>
			  </td>
			  <td><?php echo $row['assign_to_name']; ?></td>
			  <td><?php echo $row['remark']; ?></td>
			</tr>
			<?php } ?>
		  </tbody>
		</table>
	</div> 
</div>

