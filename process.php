<?php include "db.php"; ?>

<?php 
if(isset($_POST['id'])){

$id =	mysqli_real_escape_string($connection, $_POST['id']);
	$query = "SELECT * from cars where id = $id";
	$query_car_info = mysqli_query($connection, $query);

	if(!$query_car_info){
		die("query failed " . mysqli_error($connection) );
	}

	while($row = mysqli_fetch_array($query_car_info))
	{
		echo "<input type='text' rel='".$row['id']."' class='form-control title-input' value='".$row['title']."'>";
		echo "<input type='button' class='btn btn-success update' value='Update'>";
		echo "<input type='button' class='btn btn-danger delete' value='Delete'>";
		echo "<input type='button' class='btn btn-close' value='Close'>";
		
	

	}
}
if(isset($_POST['updatethis']))
{	
	$id 	 = mysqli_real_escape_string($connection, $_POST['id']);
	$title 	 = mysqli_real_escape_string($connection, $_POST['title']);

	$query =  "UPDATE cars set title = '$title' where id = $id ";

	$result_set = mysqli_query($connection, $query);

	if(!$result_set){
		die("query failed :(( " . mysqli_error($connection));
	}
}

if(isset($_POST['deletethis']))
{	
	$id 	 = mysqli_real_escape_string($connection, $_POST['id']);

	$query =  "DELETE from cars where id = $id ";

	$del_set = mysqli_query($connection, $query);

	if(!$del_set){
		die("query failed :(( " . mysqli_error($connection));
	}
}
 ?>


 <script>
 	$(document).ready(function(){
 		var id;
 		var title;
 		var updatethis = "update";
 		var deletethis = "delete";

 		$(".title-input").on("input", function(){

 			id = $(this).attr("rel");
 			var del_id = $(this).attr("rel");
 			title = $(this).val();
});

 		
// Update btn fnc
	$(".update").on("click", function(){
 					
			$.ajax({
					url: 'process.php',
					data: {title: title, id: id , updatethis: updatethis},
					type: "post",

					success: function(up_data){

						$("#feedback").text("record updated");

						setTimeout(function(){
							$("#feedback").text("");
						}, 1500);

							$.ajax({
					url: 'display_cars.php',
					type: 'post',
					success: function(show_cars)
					{
						if(!show_cars.error)
						{
							$("#show-cars").html(show_cars);
						}
					}
				});	 		

					} 
				});

 			});

// delete fu*king
		$(".delete").on("click", function(){
 			
id = $(".title-input").attr("rel");
			$.ajax({
					url: 'process.php',
					data: { id: id , deletethis: deletethis},
					type: "post",

					success: function(del_data){

						
							$.ajax({
					url: 'display_cars.php',
					type: 'post',
					success: function(show_cars)
					{
						if(!show_cars.error)
						{
							$("#show-cars").html(show_cars);
						}
					}
				});
					 		

					} 
				});

 			});

			$(".btn-close").on("click", function(){
 				
				$("#action-container").hide();
 			});
 	}); //doc ready ends
 </script>