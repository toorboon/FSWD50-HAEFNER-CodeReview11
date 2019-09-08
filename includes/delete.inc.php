<?php 
session_start();
if (!(isset($_SESSION['admin']))){
	header("Location: ../index.php");
}

include("dbconnect.inc.php");
	
$category = $_POST['category']; 
$id = $_POST['id'];
$sql_delete = build_delete_query($category, $id);

$connection = $connection ?? null;
	
	//connect the database
	if ($connection){
		$conn = $connection->connectDB();
	} else {
		$connection = new Database();
		$conn = $connection->connectDB();
	}

$result_message = '';

if ($conn->query($sql_delete) === TRUE) {
	$result_message .= $category.' successfully deleted! '; 
} else {
	$result_message .= 'SQL delete error for '.$category.'! ';
	$result_message .= $sql_delete;
}

echo $result_message;
	
//close connection
mysqli_close($conn);

function build_delete_query($category, $id) {
		$category = 'travelomatic_'.$category; //this was necessary due to restructering of database
		
		$sql_delete = "
			DELETE ".$category.", travelomatic_address ";
			

		$sql_delete .= "
			FROM ".$category." ";

		$sql_delete .= "
			LEFT JOIN travelomatic_address
			ON travelomatic_address.id = ".$category.".address_id ";

		$sql_delete .= "
			WHERE ".$category.".id = ".$id.";";

	return $sql_delete;
}

?>
