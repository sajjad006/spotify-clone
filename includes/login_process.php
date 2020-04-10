<?php
	
	session_start();
	
	if (isset($_POST['user_login']) && $_SERVER['REQUEST_METHOD']=='POST') {
	
		if (!empty($_POST['email']) && !empty($_POST['password'])) {
				
			require_once '../config.php';

			$stmt = $conn->prepare("SELECT * FROM users WHERE Email=?");
			$stmt->bind_param("s", $email);

			$email 	= mysqli_real_escape_string($conn, $_POST['email']);
			$pwd 	= mysqli_real_escape_string($conn, $_POST['password']);

			$stmt->execute();
			$result = $stmt->get_result();
			$stmt->close();

			$resultCheck = mysqli_num_rows($result);

			if ($resultCheck == 1) {

				$row=mysqli_fetch_assoc($result);
				
				$db_password = $row['Password'];
				$user_type 	 = $row['Usertype'];
				$name 		 = $row['Name'];

				if (password_verify($pwd, $db_password)) {
		
					if ($user_type == 'User') {
						
						$_SESSION['email'] = $email;
						$_SESSION['name']  = $name;
						$_SESSION['utype'] = $user_type;
						
						header("Location:../dashboard.php");
						exit();
					}
					else{
						header('Location:../login.php?error=invalid');
						exit();
					}
				}
				else{
					header('Location:../login.php?error=invalid');
					exit();
				}
			}
			else{
				header('Location:../login.php?error=invalid');
				exit();
			}
		}
		else{
			header("Location:../login.php?error=empty");
			exit();
		}
	}	
	else {
		header('Location:../login.php?error=unexpected');
		exit();
	}

	//jmyBfE4m
	// ZZC1252170
	// JSC1709401 393

?>