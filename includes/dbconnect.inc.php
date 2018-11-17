<?php 
	
	
	class Database {
	//server credentials
		public $servername = "localhost";
		public $username = "horst";
		public $password = "password_safe";
		public $dbname = 'cr11_haefner_travelmatic';
		

	//create connection
	public function connectDB(){
		
		$conn = new mysqli($this->servername, $this->username,$this->password, $this->dbname);

		//check connection
		if (mysqli_connect_errno()) {
			   printf("Connection failed: %s\n", mysqli_connect_error());
			  exit();
		} 

		/* change character set to utf8 */
		if (!$conn->set_charset("utf8")) {
	    printf("Error loading character set utf8: %s\n", $conn->error);
	    exit();
		} 
	
	return $conn;
	}
	
	public function closeDB(){
		mysqli_close($conn);
	}

}
 ?>