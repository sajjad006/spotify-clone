<?php
    session_start();
    require_once '../config.php';

    if (empty($_SESSION['email']) && empty($_SESSION['name']) && empty($_SESSION['utype']) && $_SESSION['utype']!='Admin') {
        header('Location:index.php');
        exit();
    }
    else{
        if (isset($_POST['artist_submit']) && $_SERVER['REQUEST_METHOD']=='POST') {
            
            if (isset($_POST['artist-name']) && isset($_POST['artist-description']) && !empty($_FILES['artist-image']['name'])) {

                $artist_name = mysqli_real_escape_string($conn, $_POST['artist-name']);

                $sql = "SELECT * FROM artists WHERE Name='$artist_name'";
                $result = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($result);

                if ($resultCheck==0) {

                    $image = $_FILES['artist-image']['tmp_name'];
                    $name=$_FILES['artist-image']['name'];
                    $allowed = array('jpeg','jpg','png');
                    $fExt=explode('.', $name);
                    $fActExt=strtolower(end($fExt));
                    if (in_array($fActExt, $allowed)) {
                        $fileNewName=$artist_name."-".time().".".$fActExt;
                        $fileDestination='uploads/artistImages/'.$fileNewName;
                        move_uploaded_file($image, $fileDestination);
                    
                        $stmt = $conn->prepare("INSERT INTO artists (Name, Description, Image, Added_By, Add_Date, Add_Time) VALUES (?,?,?,?,?,?)");

                        $stmt->bind_param("ssssss", $artist_name, $artist_description, $fileDestination, $user, $date, $time);

                        $artist_description = mysqli_real_escape_string($conn, $_POST['artist-description']);
                        $user = $_SESSION['email'];

                        date_default_timezone_set("Asia/Kolkata");
                        $date=date('Y-m-d');
                        $time=date('H:i:s');
                        
                        //echo $stmt->execute();exit();
                        if ($stmt->execute()) {
                            header('Location:artists.php?message=success');
                            exit();
                        }
                        else{
                            header("Location:artists.php?message=failed");
                            exit();
                        }

                        $stmlt->close();
                    }
                    else{
                        header('Location:artists.php?message=image');
                        exit();
                    }                   

                }
                else{
                    header('Location:artists.php?message=exists');
                    exit();
                }
            }
            else{
                header('Location:artists.php?message=empty');
                exit();
            }
        }

        if (isset($_POST['delete_artist']) && $_SERVER['REQUEST_METHOD']=='POST') {
            if (isset($_POST['artist_id'])) {
                $id = mysqli_real_escape_string($conn, $_POST['artist_id']);
                $sql = "DELETE FROM artists WHERE ID = '$id'";
                mysqli_query($conn, $sql);
            }
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title>Spotify - Admin | Artists</title>

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

    <script type="text/javascript">

        function add_topic() {
            var add  = document.getElementById("add");
            var view = document.getElementById("view");
            
            if (add.style.display=='none') {
                add.style.display = "block";
                view.style.display = "none";
                document.getElementById('add-tab').style.backgroundColor='#fffffe';
                document.getElementById('view-tab').style.backgroundColor='';
            }       
        }

        function view_topic() {
            var add  = document.getElementById("add");
            var view = document.getElementById("view");
            
            if (view.style.display=='none') {
                add.style.display = "none";
                view.style.display="block";
                
                document.getElementById('view-tab').style.backgroundColor='#fffffe';
                document.getElementById('add-tab').style.backgroundColor='';
            }       
        }

    </script>

</head>
<body class="dashboard-body">

    <?php require_once("nav.php") ?>

    <div class="container-fluid">
        <ul class="nav nav-tabs">
          <li><a id="add-tab" style="cursor: pointer;background-color: #fffffe" onclick="add_topic()">Add New artist</a></li>
          <li><a id="view-tab" style="cursor: pointer;" onclick="view_topic()">View artists</a></li>
        </ul>
    </div>

    <div class="container-fluid" style="padding: 0;">
        <div class="container-fluid tab" id="add" style="padding: 5px; margin: 10px;">
            <div class="container form-content form-content-internal" style="margin-top: 0px;">
                
                <p class="admin-head">Add New Artist</p>

                <?php
                    if (isset($_GET['message'])) {
                        $message=$_GET['message'];
                        if ($message=='empty') {
                            echo "<p id='error-box' style='text-align:center' class='alert alert-danger'>Please fill in all the fields.</p>";
                        }
                        elseif ($message=='exists') {
                            echo "<p id='error-box' style='text-align:center' class='alert alert-danger'>This artist already exists.</p>";
                        }
                        elseif ($message=='success') {
                            echo "<p id='success-box' style='text-align:center' class='alert alert-success'>Successfully added the artist.</p>";
                        }
                        elseif ($message=='image') {
                            echo "<p id='error-box' style='text-align:center' class='alert alert-danger'>Invalid Image.</p>";
                        }
                        else{
                            echo "<p id='error-box' style='text-align:center' class='alert alert-danger'>Sorry couldnot process your request.</p>";
                        }
                    }
                ?>

                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="artist-name">Name</label>
                        <input type="text" placeholder="Artist Name" autocomplete="off" class="form-control" name="artist-name">
                    </div>

                    <div class="form-group">
                        <label for="artist-description">Description</label>
                        <input type="text" placeholder="Artist Description" autocomplete="off" class="form-control" name="artist-description">
                    </div>

                    <div class="form-group">
                        <label for="artist-name">Artist Image:</label>
                        <input type="file" class="form-control" name="artist-image" accept="image/*">
                    </div>

                    <button type="submit" class="btn btn-default submit-btn" name="artist_submit">Submit</button>
                </form>
            </div>
        </div>

        <div class="container-fluid tab" id="view" style="display: none;padding: 0;margin-top: 30px;">
            <div class="container" style="padding: 0;">
                <table class="table table-responsive">
                    <thead style="background-color: #fffeee">
                        <th></th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th class="cover">Add Date</th>
                        <th>Action</th>
                    </thead>

                    <tbody>
                        <?php

                        $sql="SELECT * FROM artists";
                        $result=mysqli_query($conn, $sql);
                        $resultCheck=mysqli_num_rows($result);

                        if ($resultCheck) {
                        
                            while ($row = mysqli_fetch_assoc($result)) {
                                $image = $row['Image'];
                            ?>
                                <tr>
                                    <td style="padding: 0;width: 80px"><img src="<?= $image ?>" style="margin-left: 20px;width: 50px; height: 50px; border-radius: 100cm"></td>
                                    <td><?= htmlspecialchars($row['ID']) ?></td>
                                    <td><?= htmlspecialchars($row['Name']) ?></td>
                                    <td><?= htmlspecialchars(substr($row['Description'], 0, 15)."...") ?></td>
                                    <td class="cover"><?= htmlspecialchars($row['Add_Date']) ?></td>
                                    <td>
                                        <form action="" method="POST">
                                            <input type="hidden" name="artist_id" value="<?= $row['ID'] ?>">
                                            <button type="submit" class="btn btn-danger" name="delete_artist">DELETE</button>    
                                        </form>
                                        
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        else{
                            ?>
                            <tr>
                                <td colspan="3">No records found</td>
                            </tr>
                            <?php
                        }   
                            ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
</body>
</html>