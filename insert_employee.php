<?php
 
 include "config.php";
	
	$user_id = $_POST['user_id'];
	$sub_id =$_POST['sub_us_id'];
	$sub_us_ty= $_POST['sub_us_ty'];

    $pass=$_POST['pass'];
    $name=$_POST['name'];
    $gender=$_POST['gender'];
    $email=$_POST['email'];
    $contact=$_POST['contact'];
    $desig=$_POST['desig'];
    $dob=$_POST['dob'];
    $state=$_POST['state'];
    $city=$_POST['city'];
    $report_to = $_POST['report_to'];
    $dt=date('Y-m-d');

$query = mysql_query("SELECT * FROM mst_employee WHERE email='$email' OR contact='$contact'")or die(mysql_error($connection));
$row=mysql_fetch_array($query);

$count=mysql_num_rows($query);

if($count==0)
{
    $query = mysql_query("SELECT * FROM mst_employee WHERE type='$sub_us_ty'");
	$row=mysql_fetch_array($query);
		$type= $row['type'];

	if($type=='user')
	{

		$sql = mysql_query("INSERT INTO `mst_employee` (`user_id`,`sub_user_id`,`name`,`gender`,`email`,`contact`,`desig`,`dob`,`state`,`city`,`password`,`record_date`,`report_to`) VALUES ('$sub_id','$user_id','$name','$gender','$email','$contact','$desig','$dob','$state','$city','$pass','$dt','$report_to')")or die(mysql_error($connection));
		if($sql==true)
		{
			echo "1";
		}
		else{
			echo "2".mysql_error($connection);
		}
	}//End of type user loop 
	else
	{
		$sql = mysql_query("INSERT INTO `mst_employee` (`user_id`,`sub_user_id`,`name`,`gender`,`email`,`contact`,`desig`,`dob`,`state`,`city`,`password`,`record_date`,`report_to`) VALUES ('$user_id','$sub_id','$name','$gender','$email','$contact','$desig','$dob','$state','$city','$pass','$dt','$report_to')")or die(mysql_error($connection));
		if($sql==true)
		{
			echo "1";
		}
		else{
			echo "2".mysql_error($connection);
		}
	
	}
}//end of count loop
else{
	echo "4";
}
?>