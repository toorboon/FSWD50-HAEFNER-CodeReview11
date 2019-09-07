<?php 
	session_start();
	if (!(isset($_SESSION['userId']))){
		header("Location: ../index.php");
	}	
	
	require("dbconnect.inc.php");
	include("restaurants.inc.php");
	include("events.inc.php");
	include("sights.inc.php");
	
	$connection = $connection ?? null;
		//connect the database
		if ($connection){
			$conn = $connection->connectDB();
		} else {
			$connection = new Database();
			$conn = $connection->connectDB();
		}

	//fetch data
		
	$search = $_POST['search'] ?? '';
	// echo $search;
	$loc_category = $_POST['category'];

	$edit_id = $_POST['id'] ?? NULL;
	// echo 'search'.$search;
	// echo 'id'.$edit_id;
	// echo 'cat'.$loc_category;

	if ($loc_category == 'restaurants'){
		$sql_select = Restaurant::buildQuery($search, $edit_id);
		//echo $sql_select;
	} else if ($loc_category == 'events') {
		$sql_select = Event::buildQuery($search, $edit_id);
	} else if ($loc_category == 'sights') {
		$sql_select = Sight::buildQuery($search, $edit_id);
	} else if (!$edit_id){
		$sql_select = Restaurant::buildQuery($search, $edit_id);
		$sql_select .= Event::buildQuery($search, $edit_id);
		$sql_select .= Sight::buildQuery($search, $edit_id);
		//echo $sql_select;
	}
	
	if (mysqli_multi_query($conn,$sql_select)){
			do
			{
				if ($result=mysqli_store_result($conn)) {
					while ($row=mysqli_fetch_array($result)){
						//print_r($row);
						if ($edit_id){
							//just send the resulting array of values back to the index.js as response from the Ajax call
							// echo $sql_select;
							echo json_encode($row);
						} else { //this must be an initial rendering or after an action on the main php pages
							render($row); //$row has an index and key so you can either aim directly for the information and if the key is not present, render the spare information
						}
					}
					mysqli_free_result($result);
				}
			}
		while (mysqli_next_result($conn));
	}
	
	//Here we render the card which will be displayed on the main page or filter page. 
	//Important point is that you have some conditions which decides what is printed on the screen, so you can use
	//the same render function for all categories.
	function render($row){
		$output = '';

		//if admin is logged in dísplay also the edit and delete buttons
		if (isset($_SESSION['admin'])) { 
			
			$edit_button = '<a id="'.$row['category'].'_'.$row['id'].'" class="btn btn-success btn-sm d-block edit_button">Edit</a>';
			$delete_button = '<a id="'.$row['category'].'_'.$row['id'].'" class="btn btn-danger btn-sm d-block delete_button">Delete</a>';
		} else {
			$edit_button = '';
			$delete_button = '';
		}

		//if webpage is set add the field entry for the webpage else drop the content in field with index 7
		if (isset($row['webpage'])) {
			$webpage = '<li class="list-group-item"><a class="card-text" href="'.$row['webpage'].'">'.$row['webpage'].'</a></li>';
		} else {
			$webpage = '<li class="list-group-item">'.$row[7].'<i class="fas fa-euro-sign"></i></li>';
		}
		
		//if phone is set, add the field entry for phone, otherwise leave it empty
		if (isset($row['phone'])) {
			$phone = '<li class="list-group-item">'.$row['phone'].'</li>';
		} else {
			$phone = '';
		}
		// }

		$output .= 
			'
			<div class="col-4 p-2">
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
	      				<small class="text-muted block">Last updated 3 mins ago</small>
					</div>
				</div>
			</div>
			';
		echo $output;
	}
	
 ?>