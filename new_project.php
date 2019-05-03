<?php
	$user_id=$_SESSION['login_user'];
	$utype=$_SESSION['user_type']=$row['type']; 
	$sub=mysql_query("SELECT * FROM mst_employee WHERE type='$utype' and id='$user_id'")or die(mysql_error());
	$array=mysql_fetch_array($sub);
	$sub_id=$array['user_id'];
?>
<div class="row">
<h3>New Project</h3><hr>
<div class="container">
 
  <button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModal">Add Project</button>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
   <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
          <h4 class="modal-title" align="center">Add New Project</h4>
        </div>
        <div class="modal-body">
   
		<form id="new_project" name="new_project" method="post" autocomplete="off">

			<input type="hidden" name="user_id" class="form-control" value="<?php echo $user_id;?>"/>
			<input type="hidden" name="sub_us_id" value="<?php echo $sub_id; ?>">
			<input type="hidden" name="sub_us_ty" value="<?php echo $utype; ?>">
       
			<div class="col-md-6">
				<label>Project Name <span class="required_field">*</span></label>	
				<input type="text" class="form-control" name="pro_name" id="pro_name" placeholder="Project Name" required="" value="">
			</div>

			<div class="col-md-6">
				<label>Project Owner/Contact Person <span class="required_field">*</span></label>	
				<input type="text" class="form-control" name="owner_name" id="owner_name" placeholder="Project Owner/Contact Person" required="" value="">
			</div>
			<div class="panel-body"></div>
			<div class="col-md-6">
				<label>Project Cost </label>	
				<input type="text" class="form-control" name="pro_cost" id="pro_cost" placeholder="Project Cost" value="">
			</div>
			
			<div class="col-md-6">
				<label>Contact Phone <span class="required_field">*</span></label>	
				<input type="text" class="form-control" name="cont_phone" id="cont_phone" placeholder="Contact Phone" MaxLength="10" pattern="^[789]\d{9}$" required=""  >
			</div>
			<div class="panel-body"></div>
			<div class="col-md-6">
				<label>Contact Email <span class="required_field">*</span></label>	
				<input type="text" class="form-control" name="cont_email" id="cont_email" placeholder="Contact Email" required="" value="">
			</div>
			<div class="col-md-6">
				<label>Address </label>	
				<input type="text" class="form-control" name="address" id="address" placeholder="Address" value="">
			</div>

			<div class="panel-body"></div>
			<div class="col-md-6">
				<label>Start Date <span class="required_field">*</span></label>	
				<input type="date" class="form-control" name="start_date" id="start_date"  required="">
			</div>
			<div class="col-md-6">
				<label>End Date <span class="required_field">*</span></label>	
				<input type="date" class="form-control" name="end_date" id="end_date" required>
			</div>

			<div class="panel-body"></div>
			<div class="col-md-6">
				<label>Actual End Date</label>	
				<input type="date" class="form-control" name="act_end_date" id="act_end_date">
			</div>
			<div class="col-md-6">
				<label>Project Type <span class="required_field">*</span></label>	
				<select id="pro_type" name="pro_type" class="form-control" required="">
			      <option value="">Select Type</option>
			      <option value="Internal">Internal</option>
			      <option value="External">External</option>
			     </select>
			</div>

			<div class="panel-body"></div>
			<div class="col-md-6">
				<label>Assign to <span class="required_field">*</span></label>	
				<select id="assign_to" name="assign_to[]" class="form-control" multiple required="">
			     <?php 
			     	$query = mysql_query("SELECT * FROM mst_employee")or die(mysql_error());
			     	while($arr = mysql_fetch_array($query))
			     	{
			     ?>
			      <option value="<?php echo $arr['id']; ?>|<?php echo $arr['name']; ?>"><?php echo $arr['name']; ?></option>
			      <?php } ?>
			      
			     </select>
			</div>
			<script>
				$(document).ready(function(){
				 $('#assign_to').multiselect({
				  nonSelectedText: 'Select Employee',
				  enableFiltering: true,
				  enableCaseInsensitiveFiltering: true,
				  buttonWidth:'400px'
				 });
				})
			</script>
			<div class="panel-body"></div>
			<div class="modal-footer">
        		<button name="btn_newproject" id="btn_newproject" type="submit" class="btn btn-primary"  value="save" data-loading-text="<i class='fa fa-spinner fa-spin'></i>Processing..."><i class="ace-icon fa fa-check bigger-110"></i>Save</button>
          		
          		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          		<p id="msg"></p>
        	</div>
		</form>
        </div>
      </div>
    </div>
  </div><!--model end here-->
</div><!-- container closed-->
	
	<div class="col-lg-12" id="reportdata">
        <h4>Project List</h4>
		<table class="datatable table table-striped" id="example" cellspacing="0" width="100%">
		  <thead>
			<tr>
			  <th>Sr. No</th>
			  <th>Project Name</th>
			  <th>Start Date</th>
			  <th>End Date</th>
			  <th>Actual End Date</th>
			  <th>Action</th>
			</tr>
		  </thead>
		  <tbody>
		  	<?php 
             	// include "config.php";
				$sr_no=0;
                $sql =mysql_query("SELECT * FROM new_project")or die(mysql_error($connection));
                $array1 = array();

                while($row=mysql_fetch_array($sql))
               {
               		$sr_no++;
    
    		?>
			<tr id="invoice-23">
			  <td><?php echo $sr_no; ?></td>
			  <td><?php echo $row['pro_name']; ?></td>
			  <td><?php echo $row['s_date']; ?></td>
			  <td><?php echo $row['e_date']; ?></td>
			  <td><?php echo $row['a_date']; ?></td>
			
			  <td>
			  	<a href='#' title='Edit Details' data-toggle="modal" data-target="#editModal" onclick="getdata(<?php echo $row['id']; ?>)"><span class="icon fa fa-edit"></span></a>|
			  	<a href='#' title='Delete Record' data-toggle="modal" data-target="#deleteModal" onclick="$('#del_id').val('<?php echo $row['id']; ?>');"><span class="icon fa fa-trash"></span></a>|
			  	<?php if($utype=='admin') {?>
			  	<a href="dashboard.php?page=task&pro_id=<?php echo $row['id'];?>"><button class="btn btn-primary">View Project</button></a>
			  	<?php }else{ ?>
			  	<a href="user_dashboard.php?page=task&pro_id=<?php echo $row['id'];?>"><button class="btn btn-primary">View Project</button></a>
			  	<?php } ?>
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
          <h4 class="modal-title" align="center">Edit Project Details</h4>
        </div>
        <div class="modal-body">
   
		<form id="edit_new_project" name="edit_new_project" method="post" autocomplete="off">
			<input type="hidden" name="user_id" class="form-control" value="<?php echo $user_id;?>"/>
			<input type="hidden" name="sub_us_id" value="<?php echo $sub_id; ?>">
			<input type="hidden" name="sub_us_ty" value="<?php echo $utype; ?>">

 			<input type="hidden" name="rec_id" id="rec_id">
			<div class="col-md-6">
				<label>Project Name <span class="required_field">*</span></label>	
				<input type="text" class="form-control" name="epro_name" id="epro_name" placeholder="Project Name" required="" value="">
			</div>

			<div class="col-md-6">
				<label>Project Owner/Contact Person <span class="required_field">*</span></label>	
				<input type="text" class="form-control" name="eowner_name" id="eowner_name" placeholder="Project Owner/Contact Person" required="" value="">
			</div>
			<div class="panel-body"></div>
			<div class="col-md-6">
				<label>Project Cost</label>	
				<input type="text" class="form-control" name="epro_cost" id="epro_cost" placeholder="Project Cost" value="">
			</div>
			
			<div class="col-md-6">
				<label>Contact Phone <span class="required_field">*</span></label>	
				<input type="text" class="form-control" name="econt_phone" id="econt_phone" placeholder="Contact Phone" MaxLength="10" pattern="^[789]\d{9}$" required="" value="">
			</div>
			<div class="panel-body"></div>
			<div class="col-md-6">
				<label>Contact Email <span class="required_field">*</span></label>	
				<input type="text" class="form-control" name="econt_email" id="econt_email" placeholder="Contact Email" required="" value="">
			</div>
			<div class="col-md-6">
				<label>Address <span class="required_field">*</span></label>	
				<input type="text" class="form-control" name="eaddress" id="eaddress" placeholder="Address" required="" value="">
			</div>
			<div class="panel-body"></div>
			<div class="col-md-6">
				<label>Start Date <span class="required_field">*</span></label>	
				<input type="date" class="form-control" name="estart_date" id="estart_date"  required="">
			</div>
			<div class="col-md-6">
				<label>End Date <span class="required_field">*</span></label>	
				<input type="date" class="form-control" name="eend_date" id="eend_date" required>
			</div>
			<div class="panel-body"></div>
			<div class="col-md-6">
				<label>Actual End Date </label>	
				<input type="date" class="form-control" name="eact_end_date" id="eact_end_date">
			</div>
			<div class="col-md-6">
				<label>Project Type <span class="required_field">*</span></label>	
				<select id="epro_type" name="epro_type" class="form-control" required="">
			      <option value="">Select Type</option>
			      <option value="Internal">Internal</option>
			      <option value="External">External</option>
			     </select>
			</div>
			<div class="panel-body"></div>
			<div class="col-md-6">
				<label>Assign to <span class="required_field">*</span></label><br>	
				<select id="eassign_to" name="eassign_to[]" class="form-control" multiple required="">
			     <?php 
			     	$query = mysql_query("SELECT * FROM mst_employee")or die(mysql_error());
			     	while($arr = mysql_fetch_array($query))
			     	{
			     		$idd = $arr['id'];
			     		for($i=0;$i<count($idd);$i++){
			     			echo $arr[$i];
			     ?>
			    <option value="<?php echo $arr['id']; ?>|<?php echo $arr['name']; ?>"><?php echo $arr['name']; }?></option>

			      <?php } ?>
			     
			      
			     </select>
			</div>
		<script>
				$(document).ready(function(){
				 $('#eassign_to').multiselect({
				  nonSelectedText: 'Select Employee',
				  enableFiltering: true,
				  enableCaseInsensitiveFiltering: true,
				  buttonWidth:'400px'
				 });
				})
			</script>
			<div class="panel-body"></div>
	 		
			<div class="modal-footer">
        		<button name="btn_editnewproject" id="btn_editnewproject" type="submit" class="btn btn-primary"  value="save" data-loading-text="<i class='fa fa-spinner fa-spin'></i>Processing..."><i class="ace-icon fa fa-check bigger-110"></i>Update</button>
          		
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
			    <h4 class="modal-title" align="center">Delete Project</h4>
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

// Script for fetching data form database
// function function_name(parameter)
function getdata(id)
{
	var rid=id;
	
	$.ajax({
				url:'get_project_data.php',
				type:'POST',
				data:{
					xyz:rid
				},

				success: function(data)
				{
					var obj = $.parseJSON(data); // this 

					$('#rec_id').val(obj.id);
					$('#epro_name').val(obj.pro_name);
					$('#eowner_name').val(obj.owner_name);
					$('#epro_cost').val(obj.pro_cost);
					$('#econt_email').val(obj.cont_email);
					$('#econt_phone').val(obj.cont_phone);
					$('#eaddress').val(obj.address);
					$('#estart_date').val(obj.s_date);
					$('#eend_date').val(obj.e_date);
					$('#eact_end_date').val(obj.a_date);
					$('#epro_type').val(obj.pro_type);
					$('#eassign_to').prop('checked',obj.assign_to);
					 var b=obj.assign_to;
                     var c = b.split(",");

                   for(i=0;i<c.length;i++){
                            // $('input[type=checkbox]').each(function(){
                                // alert(arr[i]);
                                if($('#eassign_to').val()==c[i]){
                       $("#eassign_to").prop("selected",true);
                        }
                        
                        // })
                        }
				}	

			})
}

// Script for delete record
  $("#delete_btn").click(function(e)
    { 
        var id=$('#del_id').val(); //user_defied_variable
		e.preventDefault();
       $.ajax({
                url:'delete_new_project.php',
                type: "POST",
              
                data:{
                       id:id // veriable: user_defied_variable
                },
                  // contentType:false,
                // cache:false,  
                // processData:false,
                success: function(data)
                {
                    if(data==1)
                    {
                       	swal({
							  position: 'top-right',
							      type: 'success',
								  title: 'Deleted Successfully !!!',
								  showConfirmButton: false,
								  timer: 1500
							})
						  window.setTimeout(function()
						    { 
								window.location.reload();
							} ,1500);
                    }                          
                }
            });
    })

 //script for insert data

$('form#new_project').submit(function(e)
{

    e.preventDefault();
  	var x = $('#cont_email').val();
    var atpos = x.indexOf("@");
    var dotpos = x.lastIndexOf(".");

	if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {
        $('#cont_email').css('borderColor','red');
		$('#msg').html('Not A valid Email Address.');
		$('#msg').css('color','red');
        return false;
	}else{ 
		$("button#btn_newproject").button('loading');
	   	$.ajax({
	   			url:'insert_new_project.php',
	   			type:"POST",
	   			data: new FormData(this),
	   			// data:$("#new_project").serialize(),
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
								title: 'New Project Added',
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
					else if(data==3)
					{
						$('#msg').html('Please Select Employee.');
						$('#msg').css('color','red');
						
						return false;
					} 
					
				}
			 
			 });
	   }//end of email validation
});

// script for update data
$('form#edit_new_project').submit(function(e){

	e.preventDefault();
	var x = $('#econt_email').val();
    var atpos = x.indexOf("@");
    var dotpos = x.lastIndexOf(".");

	if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {
        $('#econt_email').css('borderColor','red');
		$('#emsg').html('Not A valid Email Address.');
		$('#emsg').css('color','red');
        return false;
	}else{
	  		$("button#btn_editnewproject").button('loading');
	         $.ajax({
	         			url:'update_new_project.php',
	         			type:"POST",
						data: new FormData(this),
						contentType:false,
	                    cache:false,  
	                    processData:false,
						
						success: function(data)
						{
							$("button#btn_editnewproject").button('reset');

							if(data==1)
							{
								swal({
									  position: 'top-right',
	 							      type: 'success',
	  								  title: 'Project info has been Updated',
	  								  showConfirmButton: false,
	  								  timer: 1500
								  })
								  window.setTimeout(function()
								    { 
								      window.location.href= "user_dashboard.php?page=new_project";
								 	} ,1500);
				
							}
							else if(data==3)
							{
								
								swal({
									  position: 'top-right',
	 							      type: 'success',
	  								  title: 'Project info has been Updated',
	  								  showConfirmButton: false,
	  								  timer: 1500
								  })
								  window.setTimeout(function()
								    { 
								      window.location.href= "dashboard.php?page=new_project";
								 	} ,1500);
							}
							else if(data==4)
							{
								// alert('Error....');
								$('#emsg').html('Please Check Error.');
								$('#emsg').css('color','red');
								return false;
							} 
						}
				   });
	    }//end of email validation
});

</script>
