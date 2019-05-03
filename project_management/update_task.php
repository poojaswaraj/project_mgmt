<?php
 
 include "config.php";
	
	$user_id = $_POST['user_id'];
	$sub_id =$_POST['sub_us_id'];
	$sub_us_ty= $_POST['sub_us_ty'];
	$rec_id=$_POST['rec_id'];
    $edescription = $_POST['edescription'];
    $estart_date = $_POST['estart_date'];
    $eend_date = $_POST['eend_date'];
    $estatus = $_POST['estatus'];
    $eremark = addslashes($_POST['eremark']);
    $epercet = $_POST['epercet'];
    $row = $_POST["eassign_to"];
    $file=$_FILES["edocument"]["name"];
	$assign_to = '';
	$assign_to_name='';
	
  	$result_explode = explode('|', $row);
    $assign_to .= $result_explode[0].", ";
    $assign_to_name .= $result_explode[1].", ";	
	$assign_to = substr($assign_to, 0, -2);
	$assign_to_name = substr($assign_to_name, 0, -2);

	$dt=date('Y-m-d');

	$query1 = mysql_query("SELECT * FROM mst_employee WHERE type='$sub_us_ty'");
	$row=mysql_fetch_array($query1);
	$type= $row['type'];

	if($type=='user')
	{
		if($file!=null || $file='')
		{
			if(isset($_FILES["edocument"]["name"]))  
			{   
			  $target_dir ="doc/";  
			  $docFileType = pathinfo($_FILES["edocument"]["name"],PATHINFO_EXTENSION);    
			  $target_file = $target_dir.$_FILES["edocument"]["name"];   

		       if (move_uploaded_file($_FILES["edocument"]["tmp_name"], $target_file)) 
		        {      
		            $doc=$target_file;            
		        } 
		       else{        
		            echo "Sorry, there was an error uploading your file.";      
		        }       
			}

			$sql = mysql_query("UPDATE `project_task` SET `user_id`='$sub_id',`sub_user_id`='$user_id',`description`='$edescription',`start_date`='$estart_date',`end_date`='$eend_date',`status`='$estatus',`remark`='$eremark',`percentage`='$epercet',`assign_id`='".$assign_to."',`assign_to_name`='".$assign_to_name."',`update_date`='$dt',`document`='$doc' WHERE `id`='$rec_id'")or die(mysql_error($connection));
			if($sql==true)
			{
				echo "1";
			}
			else{
				echo "2".mysql_error($connection);
			}
		}//End of file if
		else{
			
			$sql = mysql_query("UPDATE `project_task` SET `user_id`='$sub_id',`sub_user_id`='$user_id',`description`='$edescription',`start_date`='$estart_date',`end_date`='$eend_date',`status`='$estatus',`remark`='$eremark',`percentage`='$epercet',`assign_id`='".$assign_to."',`assign_to_name`='".$assign_to_name."',`update_date`='$dt' WHERE `id`='$rec_id'")or die(mysql_error($connection));
				if($sql==true)
				{
					echo "1";
				}
				else{
					echo "2".mysql_error($connection);
				}
		}
	}//end user loop
	else
	{
		if($file!=null || $file='')
		{
			if(isset($_FILES["edocument"]["name"]))  
			{   
			  $target_dir ="doc/";  
			  $docFileType = pathinfo($_FILES["edocument"]["name"],PATHINFO_EXTENSION);    
			  $target_file = $target_dir.$_FILES["edocument"]["name"];   

		       if (move_uploaded_file($_FILES["edocument"]["tmp_name"], $target_file)) 
		        {      
		            $doc=$target_file;            
		        } 
		       else{        
		            echo "Sorry, there was an error uploading your file.";      
		        }       
			}

			$sql = mysql_query("UPDATE `project_task` SET `user_id`='$user_id',`sub_user_id`='$sub_id',`description`='$edescription',`start_date`='$estart_date',`end_date`='$eend_date',`status`='$estatus',`remark`='$eremark',`percentage`='$epercet',`assign_id`='".$assign_to."',`assign_to_name`='".$assign_to_name."',`update_date`='$dt',`document`='$doc' WHERE `id`='$rec_id'")or die(mysql_error($connection));
			if($sql==true)
			{
				echo "3";
			}
			else{
				echo "2".mysql_error($connection);
			}
		}//end file if
		else{
			$sql = mysql_query("UPDATE `project_task` SET `user_id`='$user_id',`sub_user_id`='$sub_id',`description`='$edescription',`start_date`='$estart_date',`end_date`='$eend_date',`status`='$estatus',`remark`='$eremark',`percentage`='$epercet',`assign_id`='".$assign_to."',`assign_to_name`='".$assign_to_name."',`update_date`='$dt' WHERE `id`='$rec_id'")or die(mysql_error($connection));
			if($sql==true)
			{
				echo "3";
			}
			else{
				echo "2".mysql_error($connection);
			}
		}
	}
	
?>