<?php
 
 include "config.php";
	
	$user_id = $_POST['user_id'];
	$sub_id =$_POST['sub_us_id'];
	$sub_us_ty= $_POST['sub_us_ty'];
   
    $rec_id=$_POST['rec_id'];
    $ename=$_POST['ename'];
    $egender=$_POST['egender'];
    $emaile=$_POST['emaile'];
    $econtact=$_POST['econtact'];
    $edesig=$_POST['edesig'];
    $edob=$_POST['edob'];
    $estate=$_POST['estate'];
    $ecity=$_POST['ecity'];
    $report_to = $_POST['ereport_to'];
    $dt=date('Y-m-d');
  
	$query = mysql_query("SELECT * FROM mst_employee WHERE type='$sub_us_ty'");
	$row=mysql_fetch_array($query);
		$type= $row['type'];

	if($type=='user')
	{
		$sql = mysql_query("UPDATE `mst_employee` SET `user_id`='$sub_id',`sub_user_id`='$user_id',`name`='$ename',`gender`='$egender',`email`='$emaile',`contact`='$econtact',`desig`='$edesig',`dob`='$edob',`state`='$estate',`city`='$ecity',`update_date`='$dt',`report_to`='$report_to' WHERE `id`='$rec_id'")or die(mysql_error($connection));
			
			if($sql==true)
			{
				echo "1";
			}
			else{
				echo "2".mysql_error($connection);
			}
	}//End of user loop
	else{
			$sql = mysql_query("UPDATE `mst_employee` SET `user_id`='$user_id',`sub_user_id`='$sub_id',`name`='$ename',`gender`='$egender',`email`='$emaile',`contact`='$econtact',`desig`='$edesig',`dob`='$edob',`state`='$estate',`city`='$ecity',`update_date`='$dt',`report_to`='$report_to' WHERE `id`='$rec_id'")or die(mysql_error($connection));
		
			if($sql==true)
			{
				echo "3";
			}
			else{
				echo "2".mysql_error($connection);
			}
		}
	
?>