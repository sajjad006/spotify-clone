<?php
    session_start();
    if (empty($_SESSION['email']) && empty($_SESSION['name']) && empty($_SESSION['utype']) && $_SESSION['utype']!='Admin') {
        header('Location:index.php');
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
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

    <!-- My Stylesheet -->
    <link rel="stylesheet" type="text/css" href="../style/admin_style.css">

    <!-- My Script -->
    <script src="includes/script.js"></script>
</head>
<body class="dashboard-body">
    
    <?php require_once 'nav.php'; ?>

    <center>
        
    <div class="row container-fluid dash-cont">
      <div class="col-md-4">
        <div class="thumbnail">
          <a href="genre.php">
            <img src="../images/genre.jpeg" alt="Lights" style="width:100%;height: 200px;">
            <div class="caption">
              <h3>Genre Management</h3>
            </div>
          </a>
        </div>
      </div>
      <div class="col-md-4">
        <div class="thumbnail">
          <a href="artists.php">
            <img src="../images/artist.jpg" alt="Nature" style="width:100%;height: 200px;">
            <div class="caption">
              <h3>Artist Management</h3>
            </div>
          </a>
        </div>
      </div>
      <div class="col-md-4">
        <div class="thumbnail">
          <a href="mood.php">
            <img src="../images/mood.png" alt="Fjords" style="width:100%;height: 200px;">
            <div class="caption">
              <h3>Mood Management</h3>
            </div>
          </a>
        </div>
      </div>
    </div>

    <div class="row container-fluid dash-cont">
      <div class="col-md-4">
        <div class="thumbnail">
          <a href="songs.php">
            <img src="../images/songs.jpg" alt="Lights" style="width:100%;height: 200px;">
            <div class="caption">
              <h3>Song Management</h3>
            </div>
          </a>
        </div>
      </div>
      <div class="col-md-4">
        <div class="thumbnail">
          <a href="users.php">
            <img src="../images/image.jpg" alt="Nature" style="width:100%;height: 200px;">
            <div class="caption">
              <h3>User Management</h3>
            </div>
          </a>
        </div>
      </div>
      <div class="col-md-4">
        <div class="thumbnail">
          <a href="home-manage.php">
            <img src="../images/homepage.jpg" alt="Fjords" style="width:100%;height: 200px;">
            <div class="caption">
              <h3>Homepage</h3>
            </div>
          </a>
        </div>
      </div>
    </div>
    </center>

</body>
</html>