<?php
 
 include "config.php";

	$user_id = $_POST['user_id'];
	$sub_id =$_POST['sub_us_id'];
	$sub_us_ty= $_POST['sub_us_ty'];
    $pro_id = $_POST['pro_id'];
    $description = $_POST['description'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $status = $_POST['status'];
    $remark = $_POST['remark'];
    $percet = $_POST['percet'];
	$dt=date('Y-m-d');
	$row = $_POST["assign_to"];
	$file=$_FILES["document"]["name"];
	$assign_to = '';
	$assign_to_name='';
	
  	$result_explode = explode('|', $row);
    $assign_to .= $result_explode[0].", ";
    $assign_to_name .= $result_explode[1].", ";	
	$assign_to = substr($assign_to, 0, -2);
	$assign_to_name = substr($assign_to_name, 0, -2);

	$query1 = mysql_query("SELECT * FROM mst_employee WHERE type='$sub_us_ty'");
	$row=mysql_fetch_array($query1);
	$type= $row['type'];

	if($type=='user')
	{
		if($file!=null || $file='')
		{
			if(isset($_FILES["document"]["name"]))  
			{   
			  $target_dir ="doc/";  
			  $docFileType = pathinfo($_FILES["document"]["name"],PATHINFO_EXTENSION);    
			  $target_file = $target_dir.$_FILES["document"]["name"];   

		       if (move_uploaded_file($_FILES["document"]["tmp_name"], $target_file)) 
		        {      
		            $doc=$target_file;            
		        } 
		       else{        
		            echo "Sorry, there was an error uploading your file.";      
		        }       
			}

			$sql = mysql_query("INSERT INTO `project_task` (`user_id`,`sub_user_id`,`pro_id`,`description`,`start_date`,`end_date`,`status`,`percentage`,`remark`,`assign_id`,`assign_to_name`,`record_date`,`document`) VALUES ('$sub_id','$user_id','$pro_id','$description','$start_date','$end_date','$status','$percet','$remark','".$assign_to."','".$assign_to_name."','$dt','$doc')")or die(mysql_error($connection));
					if($sql==true)
					{
						echo "1";
					}
					else{
						echo "2".mysql_error($connection);
					}
		}//end of file if 
		else{
			$sql = mysql_query("INSERT INTO `project_task` (`user_id`,`sub_user_id`,`pro_id`,`description`,`start_date`,`end_date`,`status`,`percentage`,`remark`,`assign_id`,`assign_to_name`,`record_date`) VALUES ('$sub_id','$user_id','$pro_id','$description','$start_date','$end_date','$status','$percet','$remark','".$assign_to."','".$assign_to_name."','$dt')")or die(mysql_error($connection));
					if($sql==true)
					{
						echo "1";
					}
					else{
						echo "2".mysql_error($connection);
					}
		}
	}
	else
	{

		if($file!=null || $file='')
		{
			if(isset($_FILES["document"]["name"]))  
			{   
			  $target_dir ="doc/";  
			  $docFileType = pathinfo($_FILES["document"]["name"],PATHINFO_EXTENSION);    
			  $target_file = $target_dir.$_FILES["document"]["name"];   

		       if (move_uploaded_file($_FILES["document"]["tmp_name"], $target_file)) 
		        {      
		            $doc=$target_file;            
		        } 
		       else{        
		            echo "Sorry, there was an error uploading your file.";      
		        }       
			}
			$sql = mysql_query("INSERT INTO `project_task` (`user_id`,`sub_user_id`,`pro_id`,`description`,`start_date`,`end_date`,`status`,`percentage`,`remark`,`assign_id`,`assign_to_name`,`record_date`,`document`) VALUES ('$user_id','$sub_id','$pro_id','$description','$start_date','$end_date','$status','$percet','$remark','".$assign_to."','".$assign_to_name."','$dt','$doc')")or die(mysql_error($connection));
				if($sql==true)
				{
					echo "1";
				}
				else{
					echo "2".mysql_error($connection);
				}
		}//end of file if 
		else{
			$sql = mysql_query("INSERT INTO `project_task` (`user_id`,`sub_user_id`,`pro_id`,`description`,`start_date`,`end_date`,`status`,`percentage`,`remark`,`assign_id`,`assign_to_name`,`record_date`) VALUES ('$user_id','$sub_id','$pro_id','$description','$start_date','$end_date','$status','$percet','$remark','".$assign_to."','".$assign_to_name."','$dt')")or die(mysql_error($connection));
				if($sql==true)
				{
					echo "1";
				}
				else{
					echo "2".mysql_error($connection);
				}
		}
	}

?>