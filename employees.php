<?php
	$user_id=$_SESSION['login_user'];
	$utype=$_SESSION['user_type']=$row['type']; 
	$sub=mysql_query("SELECT * FROM user_profile WHERE type='$utype' and id='$user_id'")or die(mysql_error());
	$array=mysql_fetch_array($sub);
	$sub_id=$array['user_id'];
?>
<div class="row">
<h3> Employee</h3><hr>

	<button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModal">Add Employee</button>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
   <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" align="center">Add New Employee</h4>
        </div>
        <div class="modal-body">
		<form id="form_emp" name="form_emp" autocomplete="off" method="POST">
			<input type="hidden" name="txt_id" class="form-control" value="<?php echo $data['id'];?>"/>
			<input type="hidden" name="user_id" class="form-control" value="<?php echo $user_id;?>"/>
			<input type="hidden" name="sub_us_id" value="<?php echo $sub_id; ?>">
			<input type="hidden" name="sub_us_ty" value="<?php echo $utype; ?>">
		
			<div class="col-md-4">
			<label>Employee Name <span class="required_field">*</span></label>
				<input type="text" class="form-control" name="name" id="name" placeholder="Employee Name" value="" style="text-transform:capitalize;" required="">
			</div>
			<div class="col-md-4">
			<label>Gender <span class="required_field">*</span></label>
               <select class="form-control" name="gender" id="gender" required="">
					<option value="">Select Gender</option>
					<option value="Male">Male</option>
					<option value="Female">Female</option>
				</select>
           	</div>
		
			<div class="col-md-4">
				<label>Email Id <span class="required_field">*</span></label>
				<input type="email" class="form-control" name="email" id="email" placeholder="Email Id" value="" required="">
			</div>	
			<div class="panel-body"></div>

			<div class="col-md-4">
				<label>Contact No <span class="required_field">*</span></label>
				<input type="text" class="form-control" name="contact" id="contact" placeholder="Contact No" value="" MaxLength="10" pattern="^[789]\d{9}$" required="">
			</div>
			<div class="col-md-4">
				<label>Designation <span class="required_field">*</span></label>
				<input type="text" class="form-control" name="desig" id="desig" placeholder="Designation" value="" required="">
			</div>

			<div class="col-md-4">
				<label>Date Of Birth </label>
				<input type="date" name="dob" id="dob" class="form-control" />
			</div>
			<!-- script for DOB to hide future dates from calender -->
			<script>
				$(function(){
				    var dtToday = new Date();
				    
				    var month = dtToday.getMonth() + 1;
				    var day = dtToday.getDate();
				    var year = dtToday.getFullYear();
				    if(month < 10)
				        month = '0' + month.toString();
				    if(day < 10)
				        day = '0' + day.toString();
				    
				    var maxDate = year + '-' + month + '-' + day;
				    // alert(maxDate);
				    $('#dob').attr('max', maxDate);
				});

			</script>
			<div class="panel-body"></div>
			
             <div class="col-md-4">
				<label>State <span class="required_field">*</span></label>
				<select class="form-control" name="state" id="state" required="">
				<option value="">Select State</option>
				<?php 
					$sql=mysql_query("SELECT * FROM tbl_states")or die(mysql_error($connection));
					while($row=mysql_fetch_array($sql))
					{
				 ?>
					<option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
				<?php }  ?>
				</select>
           	</div>
           	<div class="col-md-4">
				<label>City <span class="required_field">*</span></label>
				<select class="form-control" name="city" id="city" required="">
                    <option value="">Select City</option>
                </select>
           	</div>

           	<div class="col-md-4">
			<label>Password <span class="required_field">*</span></label>
              <input type="password" class="form-control" name="pass" id="pass" placeholder="Password" value="" required="">
           	</div>
			<div class="panel-body"></div>
			<div class="col-md-4">
			<label>Confirm Password <span class="required_field">*</span></label>
              <input type="password" class="form-control" name="cpass" id="cpass" placeholder="Confirm Password" value="">
           	</div>
           	<div class="col-md-4" style="display: none;">
			<label>Report To </label>
              <input type="text" class="form-control" name="report_to" id="report_to" placeholder="Report To" value="">
           	</div>
			<div class="panel-body"></div>
			<div class="modal-footer">
			<p id="mssg"></p>
        		<button name="btn_newproject" id="btn_newproject" type="submit" class="btn btn-primary"  value="save" data-loading-text="<i class='fa fa-spinner fa-spin'></i>Processing..."><i class="ace-icon fa fa-check bigger-110"></i>Save</button>
          		
          		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        	</div>
			
		</form>
	 </div>
      </div>
    </div>
  </div>

	<div class="col-lg-12" id="reportdata">
        <h4>Employee List</h4>
		<table class="datatable table table-striped" id="example" cellspacing="0" width="100%">
		  <thead>
			<tr>
			   <th>Sr.No</th>
			   <th>Employee Name</th>
			   <!-- <th>Gender</th> -->
			   <th>Email ID</th>
			   <th>Contact NO.</th>
			   <th>Designation</th>
			   <!-- <th>DOB</th> -->
			   <th>State</th>
			   <th>City</th>
			   <!-- <th>Report To</th> -->
			   <th>Action</th>
			</tr>
		  </thead>
		  <tbody>
            <?php 
             include "config.php";

             $sql =mysql_query("SELECT b.name as state_name,c.ct_name, a.* FROM `mst_employee` a INNER JOIN `tbl_states` b ON a.state=b.id INNER JOIN `city` c ON a.city=c.ct_id")or die(mysql_error($connection));
                while($row=mysql_fetch_array($sql))
               {
            ?>

			<tr id="invoice-23">
			  <td><?php echo $row['id']; ?></td>
			  <td><?php echo $row['name']; ?></td>
			  <!-- <td><?php echo $row['gender']; ?></td> -->
			  <td><?php echo $row['email']; ?></td>
			  <td><?php echo $row['contact']; ?></td>
			  <td><?php echo $row['desig']; ?></td>
			  <!-- <td><?php echo $row['dob']; ?></td> -->
			  <td><?php echo $row['state_name']; ?></td>
			  <td><?php echo $row['ct_name']; ?></td>
			  <!-- <td><?php echo $row['report_to']; ?></td> -->

			  <td>
			  	<a href='#' title='Edit Details' data-toggle="modal" data-target="#editModal" onclick="getdata(<?php echo $row['id']; ?>)"><span class="icon fa fa-edit"></span></a>|
			  	<a href='#' title='Delete Record' data-toggle="modal" data-target="#deleteModal" onclick="$('#del_id').val('<?php echo $row['id']; ?>');"><span class="icon fa fa-trash"></span></a></button>
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
          <h4 class="modal-title" align="center">Edit Employee Details</h4>
        </div>
        <div class="modal-body">
   
		<form id="eform_emp" name="form_empe" autocomplete="off" method="POST">
			<input type="hidden" name="user_id" class="form-control" value="<?php echo $user_id;?>"/>
			<input type="hidden" name="sub_us_id" value="<?php echo $sub_id; ?>">
			<input type="hidden" name="sub_us_ty" value="<?php echo $utype; ?>">
			<input type="hidden" name="rec_id" id="rec_id">
		
			<div class="col-md-4">
			<label>Employee Name <span class="required_field">*</span></label>
				<input type="text" class="form-control" name="ename" id="ename" placeholder="Employee Name" value="" style="text-transform:capitalize;" required="">
			</div>
			<div class="col-md-4">
			<label>Gender <span class="required_field">*</span></label>
               <select class="form-control" name="egender" id="egender" required="">
					<option value="">Select Gender</option>
					<option value="Male">Male</option>
					<option value="Female">Female</option>
				</select>
           	</div>
		
			<div class="col-md-4">
				<label>Email Id <span class="required_field">*</span></label>
				<input type="email" class="form-control" name="emaile" id="emaile" placeholder="Email Id" value="" required="">
			</div>	
			<div class="panel-body"></div>

			<div class="col-md-4">
				<label>Contact No <span class="required_field">*</span></label>
				<input type="text" class="form-control" name="econtact" id="econtact" placeholder="Contact No" value="" MaxLength="10" pattern="^[789]\d{9}$" required="">
			</div>
			<div class="col-md-4">
				<label>Designation <span class="required_field">*</span></label>
				<input type="text" class="form-control" name="edesig" id="edesig" placeholder="Designation" required="">
			</div>

			<div class="col-md-4">
				<label>Date Of Birth</label>
				<input type="date" name="edob" id="edob" class="form-control"/>
			</div>
			<!-- script for DOB to hide future dates from calender -->
			<script>
				$(function(){
				    var dtToday = new Date();
				    
				    var month = dtToday.getMonth() + 1;
				    var day = dtToday.getDate();
				    var year = dtToday.getFullYear();
				    if(month < 10)
				        month = '0' + month.toString();
				    if(day < 10)
				        day = '0' + day.toString();
				    
				    var maxDate = year + '-' + month + '-' + day;
				    $('#edob').attr('max', maxDate);
				});

			</script>
			<div class="panel-body"></div>
			
             <div class="col-md-4">
				<label>State <span class="required_field">*</span></label>
				<select class="form-control" name="estate" id="estate" required="">
				<option value="">Select State</option>
				<?php 
					$sql=mysql_query("SELECT * FROM tbl_states")or die(mysql_error($connection));
					while($row=mysql_fetch_array($sql))
					{
				 ?>
					<option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
				<?php }  ?>
				</select>
           	</div>
           	<div class="col-md-4">
				<label>City <span class="required_field">*</span></label>
				<select class="form-control" name="ecity" id="ecity" required="">
                    <option value="">Select City</option>
                    <!-- to fetch all cities  -->
                     <?php 
                    	$que = mysql_query("SELECT * FROM `city`")or die(mysql_error($connection));
                    	while($arr = mysql_fetch_array($que)){
                    ?>
                    <option value="<?php echo $arr['ct_id']; ?>"><?php echo $arr['ct_name']; ?></option>
                <?php } ?> 
                </select>
           	</div>
           	<div class="col-md-4" style="display: none;">
			<label>Report To </label>
              <input type="text" class="form-control" name="ereport_to" id="ereport_to" placeholder="Report To" value="">
           	</div>
			<div class="panel-body"></div>
	 		
			<div class="modal-footer">
			<p id="emsg"></p>
        		<button name="btn_editnewproject" id="btn_editnewproject" type="submit" class="btn btn-primary"  value="save" data-loading-text="<i class='fa fa-spinner fa-spin'></i>Processing..."><i class="ace-icon fa fa-check bigger-110"></i>Update</button>
          		
          		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          		
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
			    <h4 class="modal-title" align="center">Delete Employee</h4>
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

<!-- JSON  script -->
<script>
function getdata(id)
{
	var rid=id;
	
	$.ajax({
				url:'eget_project_data.php',
				type:'POST',
				data:{
					id:rid
				},

				success: function(data)
				{
					var obj = $.parseJSON(data); // this convert strig into object 

					$('#rec_id').val(obj.id);
					$('#ename').val(obj.name);
					$('#egender').val(obj.gender);
					$('#emaile').val(obj.email);
					$('#econtact').val(obj.contact);
					$('#edesig').val(obj.desig);
					$('#edob').val(obj.dob);
					$('#estate').val(obj.state);
					$('#ecity').val(obj.city);
					$('#ereport_to').val(obj.report_to);
				}

			})
}

</script>

<!-- state city script  in insert model-->
<script type="text/javascript">
	$(document).ready(function(){
	    $('#estate').on('change',function(){
	        var stateID = $(this).val();
	        if(stateID){
	            $.ajax({
	                type:'POST',
	                url:'get_state_city.php',
	                data:'state_id='+stateID,
	                success:function(html){
	                    $('#ecity').html(html);
	                }
	            }); 
	        }else{
	           $('#ecity').html('<option value="">Select sttxt_stateate first</option>'); 
	        }
	    });
	});

	// fetch state city script in edit model
	$(document).ready(function(){
	    $('#state').on('change',function(){
	        var stateID = $(this).val();
	        if(stateID){
	            $.ajax({
	                type:'POST',
	                url:'get_state_city.php',
	                data:'state_id='+stateID,
	                success:function(html){
	                    $('#city').html(html);
	                }
	            }); 
	        }else{
	           $('#city').html('<option value="">Select sttxt_stateate first</option>');
	        }
	    });
	});
</script>

<!-- Delete Script start -->
<script>
	$("#delete_btn").click(function(e)
	{ 
	    var id=$('#del_id').val();//user_defied_variable
		e.preventDefault();

		   $.ajax({
		            url:'delete_employee.php',
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
		                    }                          
		                }
		        });
	})
</script>

<!-- Insert Script -->
<script>

$('form#form_emp').submit(function(e)
{
    e.preventDefault();
	var pass = $('#pass').val();
	var cpass = $('#cpass').val();

  	// var txt_contact = $('#txt_contact').val();
  	var x = $('#email').val();
    var atpos = x.indexOf("@");
    var dotpos = x.lastIndexOf(".");

	if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {
        $('#email').css('borderColor','red');
		$('#mssg').html('Not A valid Email Address.');
		$('#mssg').css('color','red');
        return false;
	}else{ 

      	 if(pass==cpass)
	   	 { 
		   	if(pass.length>=4 && pass.length<=10)
	        { 
          		$("button#btn_newproject").button('loading');
		        $.ajax({
							url:'insert_employee.php',
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
		  								  title: 'New Employee Added',
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
									$('#msg').html('Please Check All Fields.');
									$('#msg').css('color','red');
									return false;
								} 
								else if(data==4)
	 							{
									$('#msg').html('Alredy Exist');
									$('#msg').css('color','red');
									return false;
								} 
							}
						});
		       }
		    	else{
		    			$('#email').css('borderColor','#ccc');
		    			$('#cpass').css('borderColor','#ccc');
		                $('#pass').css('borderColor','red');
		                $('#mssg').html('Password must be between 4 to 10 characters.');
		                $('#mssg').css('color','red');
		    	}
		    }
		    else{
		    	$('#email').css('borderColor','#ccc');
		    	$('#cpass').css('borderColor','red');
				$('#mssg').html('Password Not Match.');
				$('#mssg').css('color','red');
		    }
      	}//end email validation
});//<!-- Insert Script closed-->

//<!-- Update Script -->

$('form#eform_emp').submit(function(e)
{
    e.preventDefault();

	var x = $('#emaile').val();
    var atpos = x.indexOf("@");
    var dotpos = x.lastIndexOf(".");

	if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {
        $('#emaile').css('borderColor','red');
		$('#emsg').html('Not A valid Email Address.');
		$('#emsg').css('color','red');
        return false;
	}else{ 
      		$("button#btn_editnewproject").button('loading');
	        $.ajax({
						url:'update_employee.php',
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
	  								  title: 'Employee info has been Updated',
	  								  showConfirmButton: false,
	  								  timer: 1500
								  })
								  window.setTimeout(function()
								    { 
								      window.location.href= "user_dashboard.php?page=employee";
								 	} ,1500);
				
							}
							else if(data==3)
							{										
								swal({
									  position: 'top-right',
	 							      type: 'success',
	  								  title: 'Employee info has been Updated',
	  								  showConfirmButton: false,
	  								  timer: 1500
								  })
								  window.setTimeout(function()
								    { 
								      window.location.href= "dashboard.php?page=employee";
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
	       
   		}//end email validation
	 
});

</script>

