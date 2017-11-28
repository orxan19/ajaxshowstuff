<?php 
include "db.php";

if(isset($_POST['car_name']))
{
	
	$car_name = $_POST['car_name'];
	$query = "INSERT into cars(title) values ('$car_name') ";
	$query_car_name = mysqli_query($connection, $query);

	if(!$query_car_name){
		die("Query failed " . mysqli_error());
	}

}

 ?>