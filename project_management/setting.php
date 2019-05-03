<?php 
$user_id=$_SESSION['login_user'];
?>
<div class="row">
<!-- /.panel-heading -->
<div class="panel-body">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs">
        <li class="active"><a href="dashboard.php?page=setting">Company Setting</a></li>
        <li><a href="dashboard.php?page=my_setting">My Setting</a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
		<!-- Tab 1 -->
        <div class="tab-pane fade in active" id="global">
            <h3>Company Setting</h3><hr>

          
        <div class="col-lg-12" id="globset">
              <form id="globalsettingform" name="globalsetting" autocomplete="off" method="POST" enctype="multipart/form-data">
               
           <?php
			$aa = mysql_query("SELECT * FROM company WHERE user_id='$user_id'")or die(mysql_error($connection));
				$rr=mysql_fetch_array($aa);
			
			?>
			<input type="hidden" name="data1" id="data1" value="<?php echo $rr['id'];?>">
			<input type="hidden" name="user_id" value="<?php echo $user_id;?>">

			<div class="col-lg-6">
				<h4>Company</h4>
				<div class="col-md-4">
					<label>Company Name <span class="required_field">*</span></label>
				</div><div class="panel-body"></div>
				<div class="col-md-8">
					<input type="text" class="form-control" name="txt_name" id="txt_cname" value="<?php echo $rr['company_name'];?>" placeholder="Name" required>
				</div>
				<div class="panel-body"></div>
				
				<div class="col-md-4">
					<label>Address <span class="required_field">*</span></label>
				</div><div class="panel-body"></div>
				<div class="col-md-8">
					<textarea class="form-control" name="txt_saddr" id="txt_saddr" placeholder="Address" required><?php echo $rr['company_address'];?></textarea>
				</div>
				<div class="panel-body"></div>

				<div class="col-md-4">
					<label>GST No</label>
				</div><div class="panel-body"></div>
				<div class="col-md-8">
					<input type="text" class="form-control" name="txt_gstin" id="txt_gstin" value="<?php echo $rr['gst_no'];?>" placeholder="GST No.">
				<script>
				  $(document).on('change',"#txt_gstin", function(){    
				    var inputvalues = $(this).val();
				    var gstinformat = new RegExp('^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$');
				    
					    if (gstinformat.test(inputvalues)) {
					     return true;
					    } else {
					        alert('Please Enter Valid GSTIN Number');
					        // $("#txt_gst").val('');
					        $("#txt_gstin").focus();
					    }
				    
					});
				</script> 
				</div>
				<div class="panel-body"></div>

				<div class="col-md-4">
					<label>PAN No</label>
				</div><div class="panel-body"></div>
				<div class="col-md-8">
					<input type="text" class="form-control" name="txt_panno" id="txt_panno" value="<?php echo $rr['pan_no'];?>" MaxLength="10" pattern="[A-Z]{5}\d{4}[A-Z]{1}" placeholder="PAN No.">
				</div>
				<div class="panel-body"></div>

				<div class="col-md-4">
					<label>State <span class="required_field">*</span></label>
				</div><div class="panel-body"></div>
				<div class="col-md-8">
					<input type="text" class="form-control" name="txt_state" id="txt_state" value="<?php echo $rr['state'];?>" placeholder="State" onkeyup="state()" required>
				</div>
				<div class="panel-body"></div>
				</div>
				<div class="col-lg-6">
				<div class="panel-body"></div>
				<div class="col-md-4">
					<label>State Code <span class="required_field">*</span></label>
				</div><div class="panel-body"></div>
				<div class="col-md-8">
					<input type="text" class="form-control" name="state_code" id="state_code" value="<?php echo $rr['state_code'];?>"  placeholder="State Code" required readonly>
				</div>
				<div class="panel-body"></div>
			
				<div class="col-md-4">
					<label>Phone <span class="required_field">*</span></label>
				</div><div class="panel-body"></div>
				<div class="col-md-8">
					<input type="text" class="form-control" name="txt_cphone" id="txt_cphone" value="<?php echo $rr['company_phone'];?>" placeholder="Phone" required>
				</div>
				<div class="panel-body"></div>
				
				<div class="col-md-4">
					<label>Email <span class="required_field">*</span></label>
				</div><div class="panel-body"></div>
				<div class="col-md-8">
					<input type="email" class="form-control" name="txt_cemail" id="txt_cemail" value="<?php echo $rr['company_email'];?>" placeholder="Email" required>
				</div>
				<div class="panel-body"></div>
				
				<div class="col-md-4">
					<label>Web</label>
				</div><div class="panel-body"></div>
				<div class="col-md-8">
					<input type="text" class="form-control" name="txt_cweb" id="txt_cweb" value="<?php echo $rr['company_url'];?>" placeholder="Web" >
				</div>
				<div class="panel-body"></div>
				
				<div class="col-md-4">
					<label>Logo</label>
				</div><div class="panel-body"></div>
				<div class="col-md-8">
					<input type="file" name="logo" id="logo" onchange="readURL(this);">
					<img id="blah" src="<?php echo $rr['logo'];?>" alt="your logo" width=100 height=100 />
				</div>
			</div>
		
			<div class="panel-body"></div>

			<div class="col-lg-12">
				<div class="col-md-12">
					<label>Bank Details</label>
				</div>
				<div class="col-md-6">
					<textarea class="form-control" name="txt_bank" id="txt_bank" rows="5" placeholder="Enter Bank Name, Account Number, IFSC code."><?php echo $rr['bank_details'];?></textarea>
				</div>
			</div>
			
			<div class="panel-body"></div>

			<div class="col-lg-12">
				<h4>Legal Texts</h4>
				<div class="col-md-12">
					<label>Terms & Conditions</label>
				</div>
				<div class="col-md-6">
					<textarea class="form-control" name="txt_terms" id="txt_terms" rows="5"><?php echo $rr['terms'];?></textarea>
				</div>
			</div>
			
			<div class="panel-body"></div>
			<div class="col-lg-6" align="right">
				<?php
				$aa = mysql_query("SELECT * FROM company WHERE user_id='$user_id'")or die(mysql_error($connection));
					while($rr=mysql_fetch_array($aa))
					  {
					  	 $c_id= $rr['id'];
					  }
					  if(!empty($c_id)){
				?>
					<button name="update" type="submit" value="updcomp" id="update" class="btn btn-primary" onclick="document.pressed=this.value">Update</button>
				<?php
				  }
				  else{
				?>
				   <button name="save" type="submit" value="savecomp" id="saved" class="btn btn-primary" onclick="document.pressed=this.value" >Save</button>
				<?php
				  }	
				?>
			 </div>
			</form>
		</div>
		<div class="panel-body"></div>
        </div>
	</div>
<!-- /.panel-body -->
</div>

 <script type="text/javascript">
// script for bill state fetch
	function state(){

	    var txt_product = document.getElementById("txt_state").value;
	    $("#txt_state").autocomplete({
	        source: 'select_state.php',
	        select: function(a,b)
		        {
		            $(this).val(b.item.value); //grabed the selected value
		            get_state_code(b.item.value);//passed that selected value
		        }
	    });
	}
	function get_state_code(name){
		$.ajax({
                 url:'get_state_code.php',
                 type:'POST',
                 data:{
                        name:name
                 },
                 success: function(data)
                 {
                   var obj = $.parseJSON(data);
                    $('#txt_state').val(obj.name);
                    $('#state_code').val(obj.state_code);
                    
                  if(data==1)
                    {
                        alert("update");
                    }
                 } 
            });
		}
</script>
<script>

//Insert company details
$('form#globalsettingform').submit(function(e){

     e.preventDefault();

	if(document.pressed == 'savecomp')
	  {
  		$("button#saved").button('loading');
           $.ajax({
					// data:$("#globalsettingform").serialize(),
					data:new FormData(this),
					type:"POST",
					url:'insert_comp_setting.php',
					contentType:false,
			        processData:false,
					success: function(data)
					{
						$("button#saved").button('reset');
						 // alert(data);
						if(data==1) 
						{
							swal({
								  	position: 'top-right',
								    type: 'success',
									title: 'Save Successfully!!!',
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
							alert('Error..');
							return false;
						} 
					}
			    });
	}
	else
	 if(document.pressed == 'updcomp')
	  {
	  	$("button#update").button('loading');
           $.ajax({
					// data:$("#globalsettingform").serialize(),
					data:new FormData(this),
					type:"POST",
					url:'update_comp_setting.php',
					contentType:false,
			        processData:false,
					success: function(data)
					{
						$("button#update").button('reset');
						if(data==1) 
						{
							swal({
								  	position: 'top-right',
								    type: 'success',
									title: 'Updated Successfully!!!',
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
							alert('Error..');
							return false;
						} 
					}
			    });
	}

});
</script>
<!-- Image Preview -->
<script type="text/javascript">

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

</script>