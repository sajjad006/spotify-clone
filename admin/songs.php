<?php
    session_start();

    require_once '../config.php';
    
    if (empty($_SESSION['email']) && empty($_SESSION['name']) && empty($_SESSION['utype']) && $_SESSION['utype']!='Admin') {
        header('Location:index.php');
        exit();
    }
    else{
        $sql = "SELECT * FROM genres";
        $genres = mysqli_query($conn, $sql);

        $sql = "SELECT * FROM moods";
        $moods = mysqli_query($conn, $sql);

        $sql = "SELECT * FROM artists";
        $artists = mysqli_query($conn, $sql);

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

        function toggleAudio(button) {
            var id = button.id[0];
            var audio = document.getElementById(id);
            var audios= document.getElementsByTagName("audio");

            if(audio.paused){
                for (var i = audios.length - 1; i >= 0; i--) {
                    audios[i].pause()
                    audios[i].currentTime = 0
                    var id = audios[i].id;
                    document.getElementById(id+'_btn').innerHTML='PLAY'
                }
                audio.play()
                button.innerHTML = 'PAUSE'
            }
            else{
                audio.pause()
                audio.currentTime = 0
                button.innerHTML = 'PLAY'
            }
            
        }

    </script>

</head>
<body class="dashboard-body">

    <?php require_once("nav.php") ?>

    <div class="container-fluid">
        <ul class="nav nav-tabs">
            <li><a id="add-tab" onclick="add_topic()" style="cursor: pointer;background-color: #fffffe">Add New Song</a></li>
            <li><a id="view-tab" onclick="view_topic()" style="cursor: pointer;">View Songs</a></li></ul>
    </div>

    <div class="container-fluid">
        <div class="container-fluid tab" id="add" style="padding: 20px; margin: 10px;">
            <div class="container form-content form-content" style="margin-top: 0px;width: 70%">
                
                <p class="admin-head">Add New Song</p>
                <?php
                    if (isset($_GET['message'])) {
                        $message=$_GET['message'];
                        if ($message=='empty') {
                            echo "<p id='error-box' style='text-align:center' class='alert alert-danger'>Please fill in all the fields.</p>";
                        }
                        elseif ($message=='exists') {
                            echo "<p id='error-box' style='text-align:center' class='alert alert-danger'>This song already exists.</p>";
                        }
                        elseif ($message=='success') {
                            echo "<p id='success-box' style='text-align:center' class='alert alert-success'>Successfully added the song.</p>";
                        }
                        else{
                            echo "<p id='error-box' style='text-align:center' class='alert alert-danger'>Sorry couldnot process your request.</p>";
                        }
                    }
                ?>
                <form action="includes/song_process.php" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="song-title">Song Title</label>
                                <input type="text" autocomplete="off" placeholder="Add a song title" class="form-control" name="song-title" required>
                            </div>

                            <div class="form-group">
                                <label for="song-length">Song Length</label>
                                <input autocomplete="off" type="text" placeholder="Ex 03:21" class="form-control" name="song-length" required>
                            </div>           

                            <div class="form-group">
                                <label for="song-genre">Song Genre</label>
                                <select class="form-control" name="song-genre" required>
                                    <?php 
                                        while ($row=mysqli_fetch_assoc($genres)) {
                                            $name = $row['Name'];
                                            echo "<option value='$name'>$name</option>";
                                        }

                                    ?>
                                </select>
                            </div>                            
                        </div>

                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="song-description">Song Description</label>
                                <input autocomplete="off" type="text" placeholder="Add a song Description" class="form-control" name="song-description" required>
                            </div> 

                            <div class="form-group">
                                <label for="song-artist">Song Artist</label>
                                <select class="form-control" name="song-artist">
                                    <?php 
                                        while ($row=mysqli_fetch_assoc($artists)) {
                                            $name = $row['Name'];
                                            echo "<option value='$name'>$name</option>";
                                        }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="song-mood">Song Mood</label>
                                <select class="form-control" name="song-mood">
                                    <?php 
                                        while ($row=mysqli_fetch_assoc($moods)) {
                                            $name = $row['Name'];
                                            echo "<option value='$name'>$name</option>";
                                        }

                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-xs-12">
                            <div class="form-group">
                                <label for="song-file">Upload Song File</label>
                                <input type="file" class="form-control" name="song-file" accept="audio/*">
                            </div>
                        </div>

                    </div>

                    <button type="submit" class="btn btn-default submit-btn" name="song_submit">Submit</button>
                </form>
            </div>
        </div>

        <div class="container-fluid tab" id="view" style="display: none;padding: 0;margin-top: 30px;">
            <div class="container" style="padding: 0;">
                <table class="table table-responsive">
                    <thead style="background-color: #fffeee">
                        <th>ID</th>
                        <th>Title</th>
                        <th>Artist</th>
                        <th class="cover">Genre</th>
                        <th class="cover">Mood</th>
                        <th colspan="2">Action</th>
                    </thead>

                    <tbody>
                        <?php

                        $sql="SELECT * FROM songs";
                        $result=mysqli_query($conn, $sql);
                        $resultCheck=mysqli_num_rows($result);

                        if ($resultCheck) {
                        
                            while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['ID']) ?></td>
                                    <td><?= htmlspecialchars($row['Title']) ?></td>
                                    <td><?= htmlspecialchars($row['Artist']) ?></td>
                                    <td class="cover"><?= htmlspecialchars($row['Genre']) ?></td>
                                    <td class="cover"><?= htmlspecialchars($row['Mood']) ?></td>
                                    <td>
                                        <form action="" method="POST">
                                            <input type="hidden" name="artist_id" value="<?= $row['ID'] ?>">
                                            <button onclick="toggleAudio(this)" type="button" class="btn btn-success" name="play_song" id="<?= $row['ID'].'_btn' ?>" style="width: 70px;">PLAY</button>
                                            
                                            <button type="submit" class="btn btn-danger" name="delete_artist">DELETE</button>
                                        </form>
                                    
                                        <audio id="<?= $row['ID'] ?>">
                                            <source src="<?= 'admin/'.$row['File'] ?>" type="audio/mpeg">
                                        </audio>
                                                                                
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