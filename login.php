<!DOCTYPE html>
<html>
<head>
	<title>LOG IN | SPOTIFY</title>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Font Awesome 4.7 CDN -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

    <style type="text/css">
		.form-control:focus{
    		border-color: rgba(126, 239, 104, 0.8);
  			box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(126, 239, 104, 0.6);
  			outline: 0 none;
    	}

    	.form-content{
    		width: 30%;
    	}

    	.submit-btn{
    		border-radius: 50px;
    		width: 100%;
    	}

    	.sign_up-btn{
    		width: 100%;border: 2px solid black;font-size: 1.2;border-radius: 50px;
    	}

    	a{
            color: green;
        }

    	@media only screen and (max-width: 768px){
    		.form-content{
    			width: 90%;
    		}
    		.submit-btn{
    			width: 70%;
    		}
    	}
    </style>
</head>
<body>
	<center>
		<img src="images/logo.jpg" class="img-responsive" style="width: 350px;height: 100px">

		<hr>

    <div class="container form-content">

    	<b><p>To continue Log In to Spotify.</p></b>

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


        <form method="POST" action="includes/login_process.php">
            <div class="form-group">
                <input type="email" name="email" placeholder="Email Address" class="form-control" autocomplete="off">
            </div>

            <div class="form-group">
                <input type="password" name="password" placeholder="Password" class="form-control">
            </div>
           
            <button type="submit" class="btn btn-success btn-lg submit-btn" name="user_login">LOG IN</button>
            <br><br>
            <a href="password-reset.php" class="text text-success">Forgot Password?</a>

        </form>
    	
        <hr>

    	<p><b>Don't have an account ?</b></p>
    	<button onclick="window.location.href='signup.php'" class="btn btn-default sign_up-btn" style=""><b>SIGN UP FOR FREE</b></button>

    	<hr>

    	<p>If you click "Log In" you agree to <a>Spotify's Terms & Conditions</a> and <a>Privacy Policy</a></p>
    </div>

	</center>
</body>
</html>