<?php 
	/*session_start();
	if (!(isset($_SESSION['userId']))){
		header("Location: ../index.php");
	}	*/
	
	require("dbconnect.inc.php");
	include("restaurants.inc.php");
	include("events.inc.php");
	include("sights.inc.php");
	
	$connection = $connection ?? null;
		//connect the database
		//include("dbconnect.php");
		if ($connection){
			$conn = $connection->connectDB();
		} else {
			$connection = new Database();
			$conn = $connection->connectDB();
		}

	//fetch data
	$search = $_POST['search'];
	// echo $search;
	$loc_category = $_POST['category'];

	if ($loc_category == 'restaurants'){
		$sql_select = Restaurant::buildQuery($search);
		//echo $sql_select;
	} else if ($loc_category == 'events') {
		$sql_select = Event::buildQuery($search);
	} else if ($loc_category == 'sights') {
		$sql_select = Sight::buildQuery($search);
	} else {
		$sql_select = Restaurant::buildQuery($search);
		$sql_select .= Event::buildQuery($search);
		$sql_select .= Sight::buildQuery($search);
		//echo $sql_select;
	}
	
	if (mysqli_multi_query($conn,$sql_select)){
			do
			{
				if ($result=mysqli_store_result($conn)) {
					while ($row=mysqli_fetch_array($result)){
						//print_r($row);
						render($row);
					}
					mysqli_free_result($result);
				}
			}
		while (mysqli_next_result($conn));
	}
		
	function render($row){
		$output = '';
		if (isset($_SESSION['admin'])) { 
			
			$edit_button = '<a id="restaurant_'.$row['id'].'" class="btn btn-success btn-sm d-block">Edit</a>';
			$delete_button = '<a id="restaurant_'.$row['id'].'" class="btn btn-danger btn-sm d-block">Delete</a>';
		} else {
			$edit_button = '';
			$delete_button = '';
		}

		if (isset($row['webpage'])) {
			$webpage = '<li class="list-group-item"><a class="card-text" href="'.$row['webpage'].'">'.$row['webpage'].'</a></li>';
		} else {
			$webpage = '<li class="list-group-item">'.$row[7].'<i class="fas fa-euro-sign"></i></li>';
		}
		
		if (isset($row['phone'])) {
			$phone = '<li class="list-group-item">'.$row['phone'].'</li>';
		} else {
			$phone = '';
		}
		// }

		$output .= 
			'
			<div class="">
				<div class="card text-center">
						<img class="card-img-top loc_photo" src="'.$row['image'].'" alt="no image available">
					<div class="card-body">
	      				<div class="card-header"><h3>'.$row['name'].'</h3></div>
	      				<ul class="list-group list-group-flush">
		      				<li class="list-group-item">'.$row['address'].'</li>
		      				<li class="list-group-item">'.$row[5].'</li>
		      				<li class="list-group-item">'.$row[6].'</li>
		      			</ul>
						'.$phone.
						  $webpage.
						  $edit_button.
						  $delete_button.
						  '
	      				<small class="text-muted block">Last updated 3 mins ago</small></p>
					</div>
				</div>
			</div>
			';
		echo $output;
	}
	
 ?>