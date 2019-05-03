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
		<div class="col-md-4"><label>Project Owner/Contact Person:</label>
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
	<button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModal">Add Task</button>

  <!-- Modal -->
 <div class="modal fade" id="myModal" role="dialog">
   <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" align="center">Add New Task</h4>
        </div>
        <div class="modal-body">
   
		<form id="new_project" name="new_project" method="post" autocomplete="off">
			<input type="hidden" name="pro_id" class="form-control" value="<?php echo $data['id'];?>"/>
			<input type="hidden" name="user_id" class="form-control" value="<?php echo $user_id;?>"/>
			<input type="hidden" name="sub_us_id" value="<?php echo $sub_id; ?>">
			<input type="hidden" name="sub_us_ty" value="<?php echo $utype; ?>">

			<div class="col-md-6">
				<label>Description <span class="required_field">*</span></label>	
				<textarea class="form-control" name="description" id="description" placeholder="Description" required=""></textarea>
			</div>

			<div class="col-md-6">
				<label>Start Date <span class="required_field">*</span></label>	
				<input type="date" class="form-control" name="start_date" id="start_date" data-placeholder="Start Date" required aria-required="true" value="">
			</div>
			<div class="panel-body"></div>
			<div class="col-md-6">
				<label>End Date <span class="required_field">*</span></label>	
				<input type="date" class="form-control" name="end_date" id="end_date" data-placeholder="End Date" required aria-required="true" value="">
			</div>
			
			<div class="col-md-6">
				<label>Status <span class="required_field">*</span></label>	
				<select class="form-control" name="status" id="status">
					<option value="">Select Status</option>
					<option value="Hold">Hold</option>
					<option value="WIP">WIP</option>
					<option value="Complete">Complete</option>
					<option value="Cancel">Cancel</option>
					
				</select>
			</div> 
			<div class="panel-body"></div>
			<div class="col-md-6">
				<label>Remark</label>	
				<textarea  class="form-control" name="remark" id="remark" placeholder="Remark"></textarea>
			</div> 
			<div class="col-md-6" id="other" style="display: none;" >
				<label>Percentage</label>	
				<select class="form-control" name="percet" id="percet">
					<option value="">Select Percentage</option>
					<option value="0">0%</option>
					<option value="10">10%</option>
					<option value="20">20%</option>
					<option value="30">30%</option>
					<option value="40">40%</option>
					<option value="50">50%</option>
					<option value="60">60%</option>
					<option value="70">70%</option>
					<option value="80">80%</option>
					<option value="90">90%</option>
					<option value="100">100%</option>
				</select>
			</div>
			<div class="col-md-6">
				<label>Select Employee <span class="required_field">*</span></label>	
				<select class="form-control" name="assign_to" id="assign_to" required="">
					<option value="">Select Employee</option>
					<?php 
						$qu = mysql_query("SELECT * FROM `mst_employee` WHERE id IN($assign_to_emp)")or die(mysql_error($connection));
						while($arr = mysql_fetch_array($qu)){
					?> 
					<option value="<?php echo $arr['id']; ?>|<?php echo $arr['name']; ?>"><?php echo $arr['name']; ?></option>
					<?php } ?>
				</select>
			</div> 
			<div class="panel-body"></div>
			<div class="col-md-6">
				<label>Upload Document </label>	
				<input type="file" class="form-control" name="document" id="document">
			</div>
			
			<div class="panel-body"></div>
			<div class="modal-footer">
        		<button name="btn_newproject" id="btn_newproject" type="submit" class="btn btn-primary"  value="save" data-loading-text="<i class='fa fa-spinner fa-spin'></i>Processing..."><i class="ace-icon fa fa-check bigger-110"></i>Save</button>
          		
          		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        	</div>
		</form>
        </div>
      </div>
    </div>
  </div>

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
			  <th>Document</th>
			  <th>Action</th> 
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
               	$doc= $row['document'];
            ?>
			<tr id="invoice-23">
			  <td><?php echo $sr_no; ?></td>
			  <td><?php echo $row['description']; ?></td>
			  <td><?php echo $row['start_date']; ?></td>
			  <td><?php echo $row['end_date']; ?></td>
			  <td><?php echo $row['status']; ?></td>
			  <td>
			  	<?php
				  	if($row['status']=='Complete'){echo "100%";}else if(empty($row['percentage'])){echo "0%";}
				  	else{
				   	echo $row['percentage']."%"; }
				?>
			  </td>
			  <td><?php echo $row['assign_to_name']; ?></td>
			  <td><?php echo $row['remark']; ?></td>
			  <td><?php if(!empty($doc)){ ?>
			  	<a href="<?php echo $row['document']; ?>" download><button>Download</button></a></td>
			  	<?php }else{echo "Document Not Available";} ?>
			  <td>
			  	<a href='#' title='Edit Details' data-toggle="modal" data-target="#editModal" onclick="getdata(<?php echo $row['id']; ?>)"><span class="icon fa fa-edit"></span></a>|
			  	<a href='#' title='Delete Record' data-toggle="modal" data-target="#deleteModal" onclick="$('#del_id').val('<?php echo $row['id']; ?>');"><span class="icon fa fa-trash"></span></a>
			  </td>
			</tr>
			<?php } ?>
		  </tbody>
		</table>
	</div> 
</div>

<!--Edit Modal -->
<div class="modal fade" id="editModal" role="dialog">
   <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" align="center">Edit Task Details</h4>
        </div>
        <div class="modal-body">
   
		<form id="enew_project" name="new_project" method="post" autocomplete="off">
			<!-- <input type="hidden" name="txt_id" class="form-control" value="<?php echo $data['id'];?>"/> -->
			<input type="hidden" name="user_id" class="form-control" value="<?php echo $user_id;?>"/>
			<input type="hidden" name="sub_us_id" value="<?php echo $sub_id; ?>">
			<input type="hidden" name="sub_us_ty" value="<?php echo $utype; ?>">
			<input type="hidden" name="rec_id" id="rec_id">
			<input type="hidden" name="etxt_id" id="etxt_id" class="form-control"/>

			<div class="col-md-6">
				<label>Description <span class="required_field">*</span></label>	
				<textarea class="form-control" name="edescription" id="edescription" placeholder="Description" required=""></textarea>
			</div>

			<div class="col-md-6">
				<label>Start Date <span class="required_field">*</span></label>	
				<input type="date" class="form-control" name="estart_date" id="estart_date" data-placeholder="Start Date" required aria-required="true" value="">
			</div>
			<div class="panel-body"></div>
			<div class="col-md-6">
				<label>End Date <span class="required_field">*</span></label>	
				<input type="date" class="form-control" name="eend_date" id="eend_date" data-placeholder="End Date" required aria-required="true" value="">
			</div>
			
			<div class="col-md-6">
				<label>Status <span class="required_field">*</span></label>	
				<select class="form-control" name="estatus" id="estatus" required="">
					<option value="">Select Status</option>
					<option value="Hold">Hold</option>
					<option value="WIP">WIP</option>
					<option value="Complete">Complete</option>
					<option value="Cancel">Cancel</option>
				</select>
			</div> 
			<div class="panel-body"></div>
			<div class="col-md-6">
				<label>Remark</label>	
				<textarea  class="form-control" name="eremark" id="eremark" placeholder="Remark"></textarea>
			</div>
			<div class="col-md-6" id="eother" >
				<label>Percentage</label>	
				<select class="form-control" name="epercet" id="epercet">
					<option value="">Select Percentage</option>
					<option value="0">0%</option>
					<option value="10">10%</option>
					<option value="20">20%</option>
					<option value="30">30%</option>
					<option value="40">40%</option>
					<option value="50">50%</option>
					<option value="60">60%</option>
					<option value="70">70%</option>
					<option value="80">80%</option>
					<option value="90">90%</option>
					<option value="100">100%</option>
				</select>
			</div>
			<div class="panel-body"></div>
			<div class="col-md-6">
				<label>Select Employee <span class="required_field">*</span></label>	
				<select class="form-control" name="eassign_to" id="eassign_to" required="">
					<option value="">Select Employee</option>
					<?php 
						$qu = mysql_query("SELECT * FROM `mst_employee` WHERE id IN($assign_to_emp)")or die(mysql_error($connection));
						while($arr = mysql_fetch_array($qu)){
					?> 
					<option value="<?php echo $arr['id']; ?>|<?php echo $arr['name']; ?>"><?php echo $arr['name']; ?></option>
					<?php } ?>
				</select>
			</div> 
			
			<div class="col-md-6">
				<label>Upload Document </label>	
				<input type="file" class="form-control" name="edocument" id="edocument">
				<input type="text" class="form-control" name="edocshow" id="edocshow" readonly="">
			</div>

			<div class="panel-body"></div>
	 		
			<div class="modal-footer">
        		<button name="btn_newproject" id="btn_newproject" type="submit" class="btn btn-primary"  value="save" data-loading-text="<i class='fa fa-spinner fa-spin'></i>Processing..."><i class="ace-icon fa fa-check bigger-110"></i>Update</button>
          		
          		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          		<p id="emsg"></p>
        	</div>
		</form>
        </div>
      </div>
    </div>
</div>

<!--Delete model start here-->
<div id="deleteModal" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		 <div class="modal-content">
		  	<div class="modal-header">
			    <button type="button" class="close" data-dismiss="modal">&times;</button>
			    <h4 class="modal-title" align="center">Delete Task</h4>
		  	</div>
			   <form  id="del" autocomplete="off" enctype="multipart/formdata" method="POST">
				    <div class="modal-body" id="deleteContent">
		               <input type="hidden" name="data" id="del_id">
		               <div class="form-group">
		                     <p><b>Are you sure want to delete ?</b></p>
		              </div>
				    </div>
				    <center><p id='dmsg'></p></center>
			        <div class="modal-footer">
		               <button class="btn btn-success submit" id="delete_btn" name="submit">Confirm</button>
		               <button type="button" class="btn btn-primary btn-md" data-dismiss="modal">Cancel</button>      
			        </div>
			  </form>
		</div> 
	</div>
</div>


<script>
//script to hide and show textbox in select box
	$(document).ready(function() {
		$('#status').change(function(){
		if($('#status').val() == 'WIP')
		   {
		   	$('#other').css('display', 'block'); 
		   }
		else
		   {
		   $('#other').css('display', 'none');
		   }
		});
	});
	$(document).ready(function() {
		$('#estatus').change(function(){
		if($('#estatus').val() == 'WIP')
		   {
		   	$('#eother').css('display', 'block'); 
		   }
		else
		   {
		   $('#eother').css('display', 'none');
		   }
		});
	});

function getdata(id)
{
	var rid=id;
	
	$.ajax({
				url:'tget_project_data.php',
				type:'POST',
				data:{
					xyz:rid
				},

				success: function(data)
				{
					var obj = $.parseJSON(data); // this 

					$('#rec_id').val(obj.id);
					$('#etxt_id').val(obj.pro_id);
					$('#edescription').val(obj.description);
					$('#estart_date').val(obj.start_date);
					$('#eend_date').val(obj.end_date);
					$('#estatus').val(obj.status);
					$('#eremark').val(obj.remark);
					$('#epercet').val(obj.percentage);
					var a = obj.assign_id+'|'+obj.assign_to_name;
					$('#eassign_to').val(a);
					$('#edocshow').val(obj.document);
					
				}

			})
}

</script>



<!-- Delete Script start -->
<script>
    $("#delete_btn").click(function(e)
       { 
            var id=$('#del_id').val();
			  e.preventDefault();
		
			       $.ajax({
                            url:'delete_task.php',
                            type: "POST",
                            data: {
                                   id:id  
                            },
                            success: function(data)
                                {
                                  //alert(data);
                                    if(data==1)
                                    {
                                        swal({
											  position: 'top-right',
			 							      type: 'success',
			  								  title: 'Record Deleted',
			  								  showConfirmButton: false,
			  								  timer: 1500
										  })
									  window.setTimeout(function()
									    { 
									     location.reload();
									 	} ,1500);
          								
                                        // window.location.reload();
                                        
                                    }                          
                                }
                        });
        })
</script>
<!-- Insert Script -->
<script>

$('form#new_project').submit(function(e)
{

    e.preventDefault();
	
  
	  	  $("button#btn_newproject").button('loading');

	        $.ajax({
						url:'insert_newtask.php',
						type:"POST",
						data: new FormData(this),
                        contentType:false,
                        cache:false,  
                        processData:false,            
						
						
						success: function(data)
						{
							$("button#btn_newproject").button('reset');
							if(data==1) 
							{
							   swal({
									  position: 'top-right',
	 							      type: 'success',
	  								  title: 'New Task Added',
	  								  showConfirmButton: false,
	  								  timer: 1500
								  })
								  window.setTimeout(function()
								    { 
								     location.reload();
								 	} ,1500);
								
							}
							else if(data==2)
							{
								$('#msg').html('Please Check Error.');
								$('#msg').css('color','red');
								return false;
							} 
						}
					});
 	});

// script for update data

 $('form#enew_project').submit(function(e)
  {
  	var pro_id = $('#etxt_id').val(); // project id

    e.preventDefault();
	
 		
 	  	$("button#btn_newproject").button('loading');
	  	
		        $.ajax({
							url:'update_task.php',
							type:"POST",
							data: new FormData(this),
                            contentType:false,
                            cache:false,  
                            processData:false,     
							
							success: function(data)
							{
								$("button#btn_newproject").button('reset');

								if(data==1)
								{
									swal({
										  position: 'top-right',
		 							      type: 'success',
		  								  title: 'Task info has been Updated',
		  								  showConfirmButton: false,
		  								  timer: 1500
									  })
									  window.setTimeout(function()
									    { 
									      window.location.href= "user_dashboard.php?page=task&pro_id="+pro_id;
									 	} ,1500);
					
								}
								else if(data==3)
								{
									swal({
										  position: 'top-right',
		 							      type: 'success',
		  								  title: 'Task info has been Updated',
		  								  showConfirmButton: false,
		  								  timer: 1500
									  })
									  window.setTimeout(function()
									    { 
									      window.location.href= "dashboard.php?page=task&pro_id="+pro_id;
									 	} ,1500);
								}
								else if(data==2)
								{
									$('#emsg').html('Please Check Error.');
									$('#emsg').css('color','red');
									return false;
								} 
							}
					   });

	 
});

</script>