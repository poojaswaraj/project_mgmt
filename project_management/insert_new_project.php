<?php 
	include "config.php";
if(isset($_POST["assign_to"]))
{
	$user_id = $_POST['user_id'];
	$sub_id =$_POST['sub_us_id'];
	$sub_us_ty= $_POST['sub_us_ty'];
	$pro_name = $_POST['pro_name'];
	$owner_name = $_POST['owner_name'];
	$pro_cost = $_POST['pro_cost'];
	$cont_phone = $_POST['cont_phone'];
	$cont_email = $_POST['cont_email'];
	$address = $_POST['address'];
	$start_date = $_POST['start_date'];
	$end_date = $_POST['end_date'];
	$act_end_date = $_POST['act_end_date'];
	$pro_type = $_POST['pro_type'];
	$dt=date('Y-m-d');
	
	$assign_to = '';
	$assign_to_name='';
	foreach($_POST["assign_to"] as $row)
	 {
	  	$result_explode = explode('|', $row);
        $assign_to .= $result_explode[0].", ";
        $assign_to_name .= $result_explode[1].", ";
	 }
	 $assign_to = substr($assign_to, 0, -2);
	 $assign_to_name = substr($assign_to_name, 0, -2);

	
	$query1 = mysql_query("SELECT * FROM mst_employee WHERE type='$sub_us_ty'");
	$row=mysql_fetch_array($query1);
	$type= $row['type'];

	if($type=='user')
	{

		$sql = mysql_query("INSERT INTO `new_project`(`user_id`, `sub_user_id`,`assign_to`,`assign_to_name`,`pro_name`,`owner_name`,`pro_cost`, `cont_phone`,`cont_email`,`address`,`record_date`,`s_date`,`e_date`,`a_date`,`pro_type`) VALUES ('$sub_id','$user_id','".$assign_to."','".$assign_to_name."','$pro_name','$owner_name','$pro_cost','$cont_phone','$cont_email','$address','$dt','$start_date','$end_date','$act_end_date','$pro_type')")or die(mysql_error($connection));

			if ($sql==true) {
				echo "1";
			}
			else{
				echo "2";
			}
	}
	else{

		$sql = mysql_query("INSERT INTO `new_project`(`user_id`, `sub_user_id`,`assign_to`,`assign_to_name`,`pro_name`,`owner_name`,`pro_cost`, `cont_phone`,`cont_email`,`address`,`record_date`,`s_date`,`e_date`,`a_date`,`pro_type`) VALUES ('$user_id','$sub_id','".$assign_to."','".$assign_to_name."','$pro_name','$owner_name','$pro_cost','$cont_phone','$cont_email','$address','$dt','$start_date','$end_date','$act_end_date','$pro_type')")or die(mysql_error($connection));

			if ($sql==true) {
				echo "1";
			}
			else{
				echo "2";
			}
		}

	}
	else{
		echo "3";
	}

 ?>