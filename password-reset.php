<!DOCTYPE html>
<html>
<head>
	<title>RESET YOUR PASSWROD | SPOTIFY</title>
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
            border-color: rgb(0,0,0);
            box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(0, 0, 0, 0.6);
            box-shadow: none;
            outline: 0 none;
        }
        .container{
            margin-top: 60px;
            width: 60%;
        }    
        .submit-btn{
            border-radius: 50px;
            width: 150px;
        }       
        a{
            color: green;
        }
        form{
            width: 55%;
        }
        @media only screen and (max-width: 768px){
            .container{
                margin-top: auto;
                padding: 10px;
                width: 100%;
            }
            form{
                width: 100%;
                padding: 10px;
            }
            img{
                height: 80px;
            }
        }
    </style>

</head>
<body style="margin: 0;">

    <picture>
        <source media="(min-width: 650px)" srcset="images/reset-logo.jpg">
        <source media="(max-width: 768px)" srcset="images/reset-logo-responsive.jpg">
        <img src="images/reset-logo.jpg" style="width: 100%" class="image-responsive">
    </picture>
	

    <center>
        <div class="container">
            <h1><b>Password Reset</b></h1>
            <p style="font-size: 1.2em">Enter your <b>Spotify username</b>, or the <b>email address</b> that you used to register. We'll send you an email with your username and a link to reset your password.</p>
        
            <br>
            <form method="POST" action="">
                <div class="form-group">
                    <label for="email" style="float: left;">Email address or username</label>
                    <input type="email" name="email" class="form-control" autocomplete="off">
                </div>

                <br><br>
                
                <button type="submit" class="btn btn-success btn-lg submit-btn" name="user_login">SEND</button>
                
                <br><br>       
                <p>If you still need help, contact <a>Spotify suppport</a></p>
            </form>
        </div>
    </center>
</body>
</html>