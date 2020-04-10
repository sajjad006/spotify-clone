<?php

	session_start();
	require_once '../../config.php';
    
    if (!empty($_SESSION['email']) && !empty($_SESSION['name']) && !empty($_SESSION['utype']) && $_SESSION['utype']=='Admin') {
        
        if (isset($_POST['song_submit']) && $_SERVER['REQUEST_METHOD']=='POST') {
        	
        	if (isset($_POST['song-title']) && isset($_POST['song-description']) && isset($_POST['song-length']) && isset($_POST['song-artist']) && isset($_POST['song-genre']) && isset($_POST['song-mood']) && !empty($_FILES['song-file']['name'])) {

        		//echo $_FILES['song-file'];
        		
        		$title 	= mysqli_real_escape_string($conn, $_POST['song-title']);
        		$artist = mysqli_real_escape_string($conn, $_POST['song-artist']); 

        		$sql = "SELECT * FROM songs WHERE Title='$title'";
                $result = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($result);

        		if ($resultCheck==0) {
        			$song_file = $_FILES['song-file']['tmp_name'];
                    $name=$_FILES['song-file']['name'];
                    $allowed = array('mp3');
                    $fExt=explode('.', $name);
                    $fActExt=strtolower(end($fExt));
                    if (in_array($fActExt, $allowed)) {
                        $fileNewName=$title." ".$artist.' '.time().".".$fActExt;
                        $fileDestination='../uploads/songs/'.$fileNewName;
                        move_uploaded_file($song_file, $fileDestination);
                    	
 	                   	$stmt = $conn->prepare("INSERT INTO songs (Title, Description, Length, Artist, Genre, Mood, File, Added_By, Add_Date, Add_Time) VALUES(?,?,?,?,?,?,?,?,?,?)");

                    	$stmt->bind_param("ssssssssss", $title, $description, $length, $artist, $genre, $mood, $fileDestination, $user, $date, $time);

                    	$description = mysqli_real_escape_string($conn, $_POST['song-description']);
                    	$length = mysqli_real_escape_string($conn, $_POST['song-length']);
                    	$genre 	= mysqli_real_escape_string($conn, $_POST['song-genre']);
                    	$mood 	= mysqli_real_escape_string($conn, $_POST['song-mood']);
                    	$user 	= $_SESSION['email'];

                    	date_default_timezone_set("Asia/Kolkata");
	                    $date=date('Y-m-d');
	                    $time=date('H:i:s');
	                    
	                    if ($stmt->execute()) {
	                        header('Location:../songs.php?message=success');
	                        exit();
	                    }
	                    else{
	                        header('Location:../songs.php?message=failed');
	                        exit();
	                    }

	                    $stmt->close();	
                    }
                    else{
                    	header("Location:../songs.php?message=file");
                    	exit();
                    }
        		}
        		else{
        			header("Location:../songs.php?message=exists");
        			exit();
        		}
        	}
        	else{
        		header("Location:../songs.php?message=empty");
        		exit();
        	}
        }
        else{
        	header('Location:../songs.php');
        	exit();
        }
    }
    else{
    	header('Location:../index.php');
    	exit();
    }