<!DOCTYPE html>
<html>
<head>
	<title>SIGN UP | SPOTIFY</title>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Font Awesome 4.7 CDN -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

    <!-- Recaptcha -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

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

        a{
            color: green;
        }

    	.sign_up-btn{
    		width: 100%;border: 2px solid black;font-size: 1.2;border-radius: 50px;
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

    	<b><p>Sign Up with your Email address</p></b>

        <?php
            if (isset($_GET['message'])) {
                $error=$_GET['message'];

                if ($error=='empty') {
                    echo "<p style='text-align:center' class='alert alert-danger'>Please fill in all the fields</p>";
                }
                elseif ($error=='email') {
                    echo "<p style='text-align:center' class='alert alert-danger'>Invalid email !</p>";
                }
                elseif ($error=='passlen') {
                    echo "<p style='text-align:center' class='alert alert-danger'>Password should be atleast 6 character long</p>";
                }
                elseif ($error=='password') {
                    echo "<p style='text-align:center' class='alert alert-danger'>Passwords do not match !</p>";
                }
                elseif ($error=='captcha') {
                    echo "<p style='text-align:center' class='alert alert-danger'>Invalid captcha !</p>";
                }
                elseif ($error=='invalid') {
                    echo "<p style='text-align:center' class='alert alert-danger'>Sorry! Some unexpected error occured</p>";
                }
                elseif ($error=='success') {
                    echo "<p style='text-align:center' class='alert alert-success'>You are successfully registered! You can now login. </p>";
                }
            }

        ?>


        <form method="POST" action="includes/signup_process.php">
            <div class="form-group">
                <input type="email" name="email" placeholder="Email Address" class="form-control" autocomplete="off">
            </div>

            <div class="form-group">
                <input type="password" name="pswd" placeholder="Password" class="form-control">
            </div>

            <div class="form-group">
                <input type="password" name="pswd_confirm" placeholder="Confirm Password" class="form-control">
            </div>

            <div class="form-group">
                <input type="text" name="name" placeholder="What shall we call you?" class="form-control" autocomplete="off">
            </div>
            
            <div style="float: left;">
                <label class="radio-inline"><input type="radio" name="gender" value="male" checked>Male</label>
                <label class="radio-inline"><input type="radio" name="gender" value="female">Female</label>
            </div>

            <br><br>

            <div class="g-recaptcha" data-sitekey="6LcWKcQUAAAAAGDPBSDaPkDkT-56P57R6bKfitjW"></div>

            <br>

            <p style="font-size: 0.8em">By clicking on Sign up, you agree to Spotify's <a>Terms and Conditions of Use.</a> </p>
            
            <p style="font-size: 0.8em">To learn more about how Spotify collects, uses, shares and protects your personal data please read <a>Spotify's Privacy Policy.</a></p>

            <button type="submit" class="btn btn-success btn-lg submit-btn" name="user_signup">SIGN UP</button>
            <br><br><br>
            <p>Already have an account? <a href="login.php">Log In</a></p>
        </form>
    	
        <hr>
    </div>

	</center>
</body>
</html>