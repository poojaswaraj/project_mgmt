<?php 
 $user_id=$_SESSION['login_user'];
 $utype=$_SESSION['user_type']=$row['type']; 
 $sub=mysql_query("SELECT * FROM mst_employee WHERE type='$utype' and id='$user_id'")or die(mysql_error());
 $array=mysql_fetch_array($sub);
 $sub_id=$array['user_id'];
?>
<div class="row">
<h3>Dashboard</h3><hr>
<div class="col-md-12">
	<div class="col-md-2">
		<div class="small-box bg-aqua">
	        <div class="inner">
	       	<?php 
	       		$sql = mysql_query("SELECT COUNT(*) as Total FROM mst_employee")or die(mysql_error($connection));
	       		$row = mysql_fetch_array($sql)
	       	?>
	            <h3><?php echo $row['Total']; ?></h3>
	            <p>Total Employees</p>
	        </div>
	        <div class="icon">
	            <i class="fa fa-users" style="color:#2bb2e7"></i>
	        </div>
	        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
	    </div>
	</div>
	<div class="col-md-2">
		<div class="small-box bg-aqua">
	        <div class="inner">
	       	<?php 
	       		$sql = mysql_query("SELECT COUNT(*) as Total FROM new_project")or die(mysql_error($connection));
	       		$row = mysql_fetch_array($sql)
	       	?>
	            <h3><?php echo $row['Total']; ?></h3>
	            <p>Total Projects</p>
	        </div>
	        <div class="icon">
	            <i class="fa fa-tasks" style="color:#f68e41"></i>
	        </div>
	            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right" ></i></a>
	    </div>
	</div>
	<div class="col-md-2">
		<div class="small-box bg-aqua">
	        <div class="inner">
			<?php 
	       		$sql = mysql_query("SELECT COUNT(*) as Total FROM `new_project` a INNER JOIN project_task b ON a.id=b.pro_id WHERE b.status='WIP'")or die(mysql_error($connection));
	       		$row = mysql_fetch_array($sql)
	       	?>
	            <h3>0</h3>
	            <p>WIP Total Tasks</p>
	        </div>
	        <div class="icon">
	            <i class="fa fa-cog fa-spin" style="color:#0082c6"></i>
	        </div>
	            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
	    </div>
	</div>
	<div class="col-md-2">
		<div class="small-box bg-aqua">
	        <div class="inner">
	        <?php 
	       		$sql = mysql_query("SELECT COUNT(*) as Total FROM `new_project` a INNER JOIN project_task b ON a.id=b.pro_id WHERE b.status='Complete'")or die(mysql_error($connection));
	       		$row = mysql_fetch_array($sql)
	       	?>
	            <h3>0</h3>
	            <p>Finished Projects</p>
	        </div>
	        <div class="icon">
	            <i class="fa fa-check" style="color:#add544"></i>
	        </div>
	            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
	    </div>
	</div>
	<div class="col-md-2">
		<div class="small-box bg-aqua">
	        <div class="inner">
	        <?php 
	       		$sql = mysql_query("SELECT COUNT(*) as Total FROM `new_project` a INNER JOIN project_task b ON a.id=b.pro_id WHERE b.status='Hold'")or die(mysql_error($connection));
	       		$row = mysql_fetch_array($sql)
	       	?>
	            <h3>0</h3>
	            <p>Delayed Projects</p>
	        </div>
	        <div class="icon">
	            <i class="fa fa-times" style="color:#ed2f59" ></i>
	        </div>
	            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
	    </div>
	</div>
	<div class="col-md-2">
		<div class="small-box bg-aqua">
	        <div class="inner">
	       	<?php 
	       		$sql = mysql_query("SELECT COUNT(*) as Total FROM `new_project` a INNER JOIN project_task b ON a.id=b.pro_id WHERE b.status='Complete'")or die(mysql_error($connection));
	       		$row = mysql_fetch_array($sql)
	       	?>
	            <h3>0</h3>
	            <p>Handover</p>
	        </div>
	        <div class="icon">
	            <i class="fa fa-file" style="color:#2bb2e7"></i>
	        </div>
	            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
	    </div>
	</div>
</div>

        <h4>Project List</h4>
		<table class="datatable table table-striped" id="example" cellspacing="0" width="100%">
		  <thead>
			<tr>
			  <th>Sr. No</th>
			  <th>Project Name</th>
			  <th>Owner Name</th>
			  <th>Project Cost</th>
			  <th>Contact Phone</th>
			  <th>Contact Email</th>
			  <th>Address</th>
			</tr>
		  </thead>
		  <tbody>
		  	<?php 
             	// include "config.php";
				$sr_no=0;
                $sql =mysql_query("SELECT * FROM new_project")or die(mysql_error($connection));
                while($row=mysql_fetch_array($sql))
               {
               	$sr_no++;
            ?>
			<tr id="invoice-23">
			  <td><?php echo $sr_no; ?></td>
			  <td>
			  <?php if($utype=='admin'){ ?>
			  <a href="dashboard.php?page=task&pro_id=<?php echo $row['id']; ?>"><?php echo $row['pro_name']; ?></a>
			  <?php }else{ ?>
			  <a href="user_dashboard.php?page=task&pro_id=<?php echo $row['id']; ?>"><?php echo $row['pro_name']; ?></a>
			  <?php } ?>
			  </td>
			  <td><?php echo $row['owner_name']; ?></td>
			  <td><?php echo $row['pro_cost']; ?></td>
			  <td><?php echo $row['cont_phone']; ?></td>
			  <td><?php echo $row['cont_email']; ?></td>
			  <td><?php echo $row['address']; ?></td>
			
			</tr>
		<?php } ?>
		  </tbody>
		</table>
	</div>