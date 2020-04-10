<?php
	session_start();

	if (isset($_SESSION['email']) && $_SESSION['utype']=='Admin') {
		header('Location:dashboard.php');
		exit();
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Spotify - Admin</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    <!-- Font Awesome 4.7 CDN -->
    <script src="https://kit.fontawesome.com/8d16bebb1a.js"></script>

    <link rel="stylesheet" type="text/css" href="../style/admin_style.css">
</head>
<body class="index-body">

	<div class="container form-content">
		<p class="admin-head">Admin Login</p>

		<?php

		if (isset($_GET['error'])) {
			$error=$_GET['error'];

			if ($error=='invalid') {
				echo "<p style='text-align:center' class='text text-danger'>Invalid Username or password</p>";
			}
			elseif ($error=='empty') {
				echo "<p style='text-align:center' class='text text-danger'>Please fill in all the fields</p>";
			}
			elseif ($error=='unexpected') {
				echo "<p style='text-align:center' class='text text-warning'>Sorry! Some unexpected error occured</p>";
			}
		}

		?>

		<form action="includes/admin_login_process.php" method="POST">
		  <div class="form-group">
		    <label for="email">Email address:</label>
		    <input type="email" class="form-control" name="email">
		  </div>
		  <div class="form-group">
		    <label for="pwd">Password:</label>
		    <input type="password" class="form-control" name="pwd">
		  </div>
		  <button type="submit" class="btn btn-default submit-btn" name="submit">Submit</button>
		</form>
	</div>

</body>
</html>