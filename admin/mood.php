<?php
    session_start();
    require_once '../config.php';
    if (empty($_SESSION['email']) && empty($_SESSION['name']) && empty($_SESSION['utype']) && $_SESSION['utype']!='Admin') {
        header('Location:index.php');
        exit();
    }
    else{
        if (isset($_POST['mood_submit']) && $_SERVER['REQUEST_METHOD']=='POST') {
            if (isset($_POST['mood-name'])) {

                $mood_name = mysqli_real_escape_string($conn, $_POST['mood-name']);

                $sql = "SELECT * FROM moods WHERE Name='$mood_name'";
                $result = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($result);
                
                if ($resultCheck<=0) {
                    $stmt=$conn->prepare("INSERT INTO moods (Name,Added_By,Add_Date,Add_Time) VALUES(?,?,?,?)");
                    $stmt->bind_param("ssss",$mood_name,$user,$date,$time);

                    $mood_name = mysqli_real_escape_string($conn, $_POST['mood-name']);
                    $user = $_SESSION['email'];
                    
                    date_default_timezone_set("Asia/Kolkata");
                    $date=date('Y-m-d');
                    $time=date('H:i:s');
                    
                    if ($stmt->execute()) {
                        header('Location:mood.php?message=success');
                        exit();
                    }
                    else{
                        header('Location:mood.php?message=failed');
                        exit();
                    }

                    $stmt->close();
                }  
                else{
                    header('Location:mood.php?message=exists');
                    exit();
                }
            }
            else{
                header('Location:mood.php?message=empty');
                exit();
            }
        }

        if (isset($_POST['delete_mood']) && $_SERVER['REQUEST_METHOD']=='POST') {
            if (isset($_POST['mood_id'])) {
                $id = mysqli_real_escape_string($conn, $_POST['mood_id']);
                $sql = "DELETE FROM moods WHERE ID = '$id'";
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
    
    <title>Spotify - Admin | Mood Management</title>

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
          <li><a id="add-tab" onclick="add_topic()" style="cursor: pointer;background-color: #fffffe">Add New Mood</a></li>
          <li><a id="view-tab" onclick="view_topic()" style="cursor: pointer;">View Moods</a></li>
        </ul>
    </div>

    <div class="container-fluid" style="padding: 0">
        <div class="container-fluid tab" id="add" style="padding: 20px; margin: 10px;">
            <div class="container form-content form-content-internal" style="margin-top: 0px;">
                    
                <p class="admin-head">Add New Mood</p>

                <?php
                    if (isset($_GET['message'])) {
                        $message=$_GET['message'];
                        if ($message=='empty') {
                            echo "<p id='error-box' style='text-align:center' class='alert alert-danger'>Please fill in all the fields.</p>";
                        }
                        elseif ($message=='exists') {
                            echo "<p id='error-box' style='text-align:center' class='alert alert-danger'>This Mood already exists.</p>";
                        }
                        elseif ($message=='success') {
                            echo "<p id='success-box' style='text-align:center' class='alert alert-success'>Successfully added the mood.</p>";
                        }
                        else{
                            echo "<p id='error-box' style='text-align:center' class='alert alert-danger'>Sorry couldnot process your request.</p>";
                        }
                    }
                ?>
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="mood-name">Mood Name:</label>
                        <input autocomplete="off" type="text" class="form-control" name="mood-name">
                    </div>
                    <button type="submit" class="btn btn-default submit-btn" name="mood_submit">Submit</button>
                </form>
            </div>
        </div>

        <div class="container-fluid tab" id="view" style="display: none;padding: 0;margin-top: 30px;">
            <div class="container" style="padding: 0;">
                <table class="table table-responsive">
                    <thead style="background-color: #fffeee">
                        <th>ID</th>
                        <th>Mood</th>
                        <th>Added By</th>
                        <th class="cover">Date</th>
                        <th class="cover">Time</th>
                        <th>Action</th>
                    </thead>

                    <tbody>
                        <?php

                        $sql="SELECT * FROM moods";
                        $result=mysqli_query($conn, $sql);
                        $resultCheck=mysqli_num_rows($result);

                        if ($resultCheck) {
                        
                            while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['ID']) ?></td>
                                    <td><?= htmlspecialchars($row['Name']) ?></td>
                                    <td><?= htmlspecialchars($row['Added_By']) ?></td>
                                    <td class="cover"><?= htmlspecialchars($row['Add_Date']) ?></td>
                                    <td class="cover"><?= htmlspecialchars($row['Add_Time']) ?></td>
                                    <td>
                                        <form action="" method="POST">
                                            <input type="hidden" name="mood_id" value="<?= $row['ID'] ?>">
                                            <button type="submit" class="btn btn-danger" name="delete_mood">DELETE</button>    
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