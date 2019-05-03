<?php 
	include "config.php";
	$id = $_POST['xyz'];
	
	$sql =mysql_query("SELECT * FROM project_task WHERE id='$id'")or die(mysql_error($connection));
    $data=mysql_fetch_assoc($sql);
   
    if($sql==true)
    {
    	echo json_encode($data); //default funtion of json in php for generating a json tree
    }else{
    	echo "Error".mysql_error($connection);
    }
        	
?>