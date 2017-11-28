<?php 
include "db.php";

$search = $_POST['search'];

if(!empty($search))
{
	$query = "SELECT * from cars Where title like '$search%' ";

	$search_query = mysqli_query($connection, $query);

	$count = mysqli_num_rows($search_query);


	if(!$search_query)
	{
		die("QUery failed :(( " . mysqli_error($connection));
	}

	if($count <= 0) {
			echo "<li>No result</li>";
	} else{

	while($row = mysqli_fetch_array($search_query))
	{
		$brand = $row['title'];

		?>
		<ul class="list-unstyled">
			<?php 
				echo "<li>{$brand} </li>";
			 ?>		
		</ul>





	<?php  }

}}?>