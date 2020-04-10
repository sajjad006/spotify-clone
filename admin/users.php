<?php
    session_start();
    require_once '../config.php';
    if (empty($_SESSION['email']) && empty($_SESSION['name']) && empty($_SESSION['utype']) && $_SESSION['utype']!='Admin') {
        header('Location:index.php');
        exit();
    }
    else{
        
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title>Spotify - Admin | User Management</title>

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

    <?php require_once("nav.php") ?>
    
        <div class="container-fluid tab" id="view" style="padding: 0;margin-top: 30px;">
            <div class="container" style="padding: 0;">
                <table class="table table-responsive">
                    <thead style="background-color: #fffeee">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th class="cover">Joining Date</th>
                    </thead>

                    <tbody>
                        <?php

                        $sql="SELECT * FROM users WHERE Usertype='User'";
                        $result=mysqli_query($conn, $sql);
                        $resultCheck=mysqli_num_rows($result);

                        if ($resultCheck) {
                        
                            while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['ID']) ?></td>
                                    <td><?= htmlspecialchars($row['Name']) ?></td>
                                    <td><?= htmlspecialchars($row['Email']) ?></td>
                                    <td class="cover"><?= htmlspecialchars($row['Join_Date']) ?></td>
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