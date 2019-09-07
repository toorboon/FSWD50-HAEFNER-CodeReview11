<?php 
	session_start();
	if (!(isset($_SESSION['admin']))){
		header("Location: ../index.php");
	}

		include("dbconnect.inc.php");
		include("restaurants.inc.php");
		include("events.inc.php");
		include("sights.inc.php");

		if(isset($_POST["category"])){
				
			$location_id = $_POST["id"] ?? NULL;
			$category = $_POST["category"] ?? NULL;
			$name = $_POST["name"] ?? NULL;
			$city = $_POST["city"] ?? NULL;
			$zip = $_POST["zip"] ?? NULL;
			$street = $_POST["street"] ?? NULL;
			$phone = $_POST["phone"] ?? NULL;
			$type = $_POST["type"] ?? NULL;
			$description = $_POST["description"] ?? NULL;
			$webpage = $_POST["webpage"] ?? NULL;
			$type_sights = $_POST['type_sights'] ?? NULL;
			$date = $_POST["date"] ?? NULL;
			$price = $_POST["price"] ?? NULL;
			$location = $_POST["location"] ?? NULL;
			$visited = $_POST['visit_date'] ?? NULL;
			
			if(isset($_FILES['uploadFile']['name']) && !empty($_FILES['uploadFile']['name'])) {
		        //Allowed file type
		        $allowed_extensions = array("jpg","jpeg","png","gif");
		         //File extension
		        $ext = strtolower(pathinfo($_FILES['uploadFile']['name'], PATHINFO_EXTENSION));
		    
		        //Check extension
		        if(in_array($ext, $allowed_extensions)) {
		           //Convert image to base64
		           $encoded_image = base64_encode(file_get_contents($_FILES['uploadFile']['tmp_name']));
		           $encoded_image = 'data:image/' . $ext . ';base64,' . $encoded_image;
		       	}
		   	}else{
		   		if($_POST['delete_image'] == 'on') {
		   			$encoded_image = 'delete';
		   		}
		   	}
		   	
		   	if ($category == 'restaurants'){
		   		$newRestaurant = new Restaurant(
		   			$phone,
		   			$webpage,
		   			$type,
		   			$description,
		   			$location_id,
		   			$category,
		   			$name,
		   			$city,
		   			$zip,
		   			$street,
		   			$encoded_image);

		   		if(!$location_id){
					$sql_return = $newRestaurant->build_insert_query();

				} else {
					$sql_return = $newRestaurant->build_update_query($location_id);
				}
		   		
		   	} else if ($category == 'sights') {
		   		//put object instantiation for sights
		   		$newSight = new Sight(
		   			$visited,
		   			$type_sights,
		   			$description,
		   			$webpage,
		   			$location_id,
		   			$category,
		   			$name,
		   			$city,
		   			$zip,
		   			$street,
		   			$encoded_image);

		   		if(!$location_id){
					$sql_return = $newSight->build_insert_query();
				
				} else {
					$sql_return = $newSight->build_update_query($location_id);
				}
			   			
		   	} else if ($category == 'events') {
		   		//put object instantiation for events
		   		$newEvent = new Event(
		   			$date,
		   			$price,
		   			$location,
		   			$location_id,
		   			$category,
		   			$name,
		   			$city,
		   			$zip,
		   			$street,
		   			$encoded_image);

		   		if(!$location_id){
					$sql_return = $newEvent->build_insert_query();
				
				} else {
					$sql_return = $newEvent->build_update_query($location_id);
				}

		   	} else {
		   		echo "Something is wrong with the categories!"; //this should never occur! If so, something needs to be checked with the parameter 'category'
		   	}
		//print_r($newRestaurant);

		$sql_insert_address = $sql_return[0];
		$sql_insert_category = $sql_return[1];
		// echo ($sql_insert_address);
		// echo ($sql_insert_category);
		$result_message = insert_into_database($sql_insert_address, $sql_insert_category, $category);
		//echo $sql_insert_category;
		echo $result_message;
			
}
	
function insert_into_database($sql_insert_address, $sql_insert_category, $category){
	
	$connection = $connection ?? null;
		//connect the database
		//include("dbconnect.php");
	if ($connection){
		$conn = $connection->connectDB();
	} else {
		$connection = new Database();
		$conn = $connection->connectDB();
	}

	$result_message = '';
	if ($conn->query($sql_insert_address) === TRUE) {
	    $last_address_id = $conn->insert_id;
	    $result_message .= 'Address inserted successfully. '; 
	} else {
			$result_message .= 'SQL insert/update error for address! ';
	}

	if ($conn->query($sql_insert_category) === TRUE) {
		    $result_message .= 'Information in table '.$category.' successfully written.'; 
	} else {
			$result_message .= 'SQL insert/update error for '.$category.'! ';
	}
	
	//close connection
	mysqli_close($conn);

	return $result_message;
}
		
?>
 