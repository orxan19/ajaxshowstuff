<?php include "db.php";

$query = "SELECT * from cars";

$query_car_info = mysqli_query($connection, $query);

if(!$query_car_info){
	die("query failed " . mysqli_error($connection) );
}

while($row = mysqli_fetch_array($query_car_info))
{
	echo "<tr>";
	echo "<td class='car_id'>{$row['id']}</td>";
	echo "<td><a rel='".$row['id']."' class='title-link' href='javascript:void(0)'>{$row['title']}</a></td>";
	echo "</tr>";

}



 ?>

<script>
	$(document).ready(function(){
		$("#action-container").hide();
					$(".title-link").on("click", function(){

						$("#action-container").show();
						

						var id = $(this).attr("rel");

						$.ajax({
						url: 'process.php',
						type: 'post',
						data: {id: id},
						success: function(data)
						{
							if(!data.error)
							{

								$("#action-container").html(data);
							}
						}
					});

					});
});
</script>