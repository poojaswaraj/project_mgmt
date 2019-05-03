<?php 
	include "config.php";
if(isset($_POST["eassign_to"]))
{
	$user_id = $_POST['user_id'];
	$sub_id =$_POST['sub_us_id'];
	$sub_us_ty= $_POST['sub_us_ty'];
	$rec_id=$_POST['rec_id'];
	$epro_name = $_POST['epro_name'];
	$eowner_name = $_POST['eowner_name'];
	$epro_cost = $_POST['epro_cost'];
	$econt_phone = $_POST['econt_phone'];
	$econt_email = $_POST['econt_email'];
	$eaddress = $_POST['eaddress'];
	$dt=date('Y-m-d');
	$estart_date = $_POST['estart_date'];
	$eend_date = $_POST['eend_date'];
	$eact_end_date = $_POST['eact_end_date'];
	$epro_type = $_POST['epro_type'];

	$assign_to = '';
	$assign_to_name='';
	foreach($_POST["eassign_to"] as $row)
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
		$sql = mysql_query("UPDATE `new_project` SET `user_id`='$sub_id',`sub_user_id`='$user_id',`assign_to`='".$assign_to."',`assign_to_name`='".$assign_to_name."',`pro_name`='$epro_name',`owner_name`='$eowner_name',`pro_cost`='$epro_cost',`cont_phone`='$econt_phone',`cont_email`='$econt_email',`address`='$eaddress',`update_date`= '$dt',`s_date`= '$estart_date',`e_date`= '$eend_date',`a_date`= '$eact_end_date',`pro_type`= '$epro_type' WHERE `id`='$rec_id'")or die(mysql_error($connection));

			if ($sql==true) {
				echo "1";
			}
			else{
				echo "2";
			}
	}
	else{
		$sql = mysql_query("UPDATE `new_project` SET `user_id`='$user_id',`sub_user_id`='$sub_id',`assign_to`='".$assign_to."',`assign_to_name`='".$assign_to_name."',`pro_name`='$epro_name',`owner_name`='$eowner_name',`pro_cost`='$epro_cost',`cont_phone`='$econt_phone',`cont_email`='$econt_email',`address`='$eaddress',`update_date`= '$dt',`s_date`= '$estart_date',`e_date`= '$eend_date',`a_date`= '$eact_end_date',`pro_type`= '$epro_type' WHERE `id`='$rec_id'")or die(mysql_error($connection));

			if ($sql==true) {
				echo "3";
			}
			else{
				echo "2";
			}
		}
}
else{
	echo "4";
}

 ?>