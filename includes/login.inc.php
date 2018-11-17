<?php 
session_start();
	if (!(isset($_SESSION['userId']))){
		header("Location: ../index.php");
	}	

echo "in login.inc.php";
if (isset($_POST['login-submit'])) {
	
	//connect the database
	include("dbconnect.inc.php");

	$connection = $connection ?? null;
	if ($connection){
		$conn = $connection->connectDB();
	} else {
		$connection = new Database();
		$conn = $connection->connectDB();
	}

	$mailuid = $_POST['mailuid'];
	$password = $_POST['pwd'];

	if (empty($mailuid) || empty($password)){
		header("Location: ../index.php?error=emptyfields");
		exit();
	
	} else {
		$sql = "SELECT * FROM users WHERE uidUsers=? OR emailUsers=?;"; //again uses prepared statemens
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("Location: ../index.php?error=sqlerror&uid=".$mailuid);
			exit();

		} else {
			mysqli_stmt_bind_param($stmt, "ss", $mailuid, $mailuid); //I don't understand that! Why two times the same?
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			if ($row = mysqli_fetch_assoc($result)) {
				$pwdCheck = password_verify($password, $row['pwdUsers']);
				if ($pwdCheck == false) {
					header("Location: ../index.php?error=wrongpwd&uid=".$mailuid);
					exit();

				} else if ($pwdCheck == true) {
					session_start();
					$_SESSION['userId'] = $row['idUsers'];
					$_SESSION['userUid'] = $row['uidUsers'];
					if ($row['category'] == 'admin'){
						$_SESSION['admin'] = 1;
					}
					header("Location: ../index.php?login=success");
					exit();

				} else {
					header("Location: ../index.php?error=wrongpwd&uid=".$mailuid);
					exit();
				}
				
			} else {
				header("Location: ../index.php?error=nouser");
				exit();
			}
		}
	}

} else {
	header("Location: ../index.php");
	exit();
}

