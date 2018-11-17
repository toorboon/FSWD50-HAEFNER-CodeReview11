<?php 
	// session_start();
	// if (!(isset($_SESSION['admin']))){
	// 	header("Location: ../index.php");
	// }

/*echo '<br>'.$_POST['category'];
echo '<br>'.$_POST['name'];
echo '<br>'.$_POST['id'];
echo '<br>'.$encoded_image;
echo print_r($_POST);
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
			   		if(isset($_POST['delete_image'])){
			   			$encoded_image = '';
			   		}
			   	}*/

		include("dbconnect.inc.php");
		include("restaurants.inc.php");
		include("events.inc.php");
		include("sights.inc.php");

		if(isset($_POST["category"])){
				
			$location_id = $_POST["id"];
			$category = $_POST["category"];
			$name = $_POST["name"];
			$city = $_POST["city"];
			$zip = $_POST["zip"];
			$street = $_POST["street"];
			$phone = $_POST["phone"];
			$type = $_POST["type"];
			$description = $_POST["description"];
			$webpage = $_POST["webpage"];
			$date = $_POST["date"];
			$price = $_POST["price"];
			$location = $_POST["location"];
			$visited = $_POST['visit_date'];
			
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
		   		//if(isset($_POST['delete_image'])){
		   			$encoded_image = '';
		   		//}
		   	}
		   	
		   	if ($category == 'restaurant'){
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
					$newRestaurant->update_Database();
				}
		   		
		   	} else if ($category == 'sight') {
		   		//put object instantiation for sights
		   		$newSight = new Sight(
		   			$visited,
		   			$type,
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
					$newSight->update_Database();
				}
			   			
		   	} else if ($category == 'event') {
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
					$newEvent->update_Database();
				}

		   	} else {
		   		echo "Something is wrong with the categories!";
		   	}
		//print_r($newRestaurant);	
		$sql_insert_address = $sql_return[0];
		$sql_insert_category = $sql_return[1];
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
	    $result_message .= 'New address created successfully. '; 
	} else {
			$result_message .= 'SQL insert error for address! ';
	}

	if ($conn->query($sql_insert_category) === TRUE) {
		    $result_message .= 'New '.$category.' created successfully. '; 
	} else {
			$result_message .= 'SQL insert error for '.$category.'! ';
	}
	
	//close connection
	mysqli_close($conn);

	return $result_message;
}
		
?>
 