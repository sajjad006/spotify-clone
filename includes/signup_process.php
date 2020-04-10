<?php

session_start();
require_once '../config.php';

if (isset($_POST['user_signup']) && $_SERVER['REQUEST_METHOD']=='POST') {
	if (!empty($_POST['email']) && !empty($_POST['pswd']) && !empty($_POST['pswd_confirm']) && !empty($_POST['name']) && !empty($_POST['gender'])) {

        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            
            if (strlen($_POST['pswd'])>=6) {
                
                if ($_POST['pswd'] == $_POST['pswd_confirm']) {
                    
                    $res = post_captcha($_POST['g-recaptcha-response']);

                    if ($res['success']) {

                        $stmt = $conn->prepare("INSERT INTO users (Email, Password, Name, Usertype, Join_Date, Gender) VALUES (?,?,?,?,?,?)");

                        $stmt->bind_param("ssssss", $email, $password, $name, $usertype, $join_date, $gender);

                        date_default_timezone_set("Asia/Kolkata");

                        $email      = mysqli_real_escape_string($conn, $_POST['email']);
                        $password   = mysqli_real_escape_string($conn, $_POST['pswd']);
                        $name       = mysqli_real_escape_string($conn, $_POST['name']);
                        $usertype   = 'User';
                        $join_date  = date('Y-m-d');
                        $gender     = mysqli_real_escape_string($conn, $_POST['gender']);

                        $password   = password_hash($password, PASSWORD_DEFAULT); 

                        if ($stmt->execute()) {
                            $stmt->close();
                            header("Location:../signup.php?message=success");
                            exit();
                        }
                        else{
                            $stmt->close();
                            header("Location:../signup.php?message=invalid");
                            exit();
                        }
                    }
                    else{
                        header("Location:../signup.php?message=captcha");
                        exit();
                    }
                }
                else{
                    header("Location:../signup.php?message=password");
                    exit();
                }
            }
            else{
                header('Location:../signup.php?message=passlen');
                exit();
            }
        }
        else{
            header("Location:../signup.php?message=email");
            exit();
        }
	}
    else{
        header("Location:../signup.php?message=empty");
        exit();
    }
}


// re captch server side validation
function post_captcha($user_response) {
    $fields_string = '';
    $fields = array(
        'secret' => '6LcWKcQUAAAAALc_sLAZXDmc4Go8KxLFxb-PnB2c',
        'response' => $user_response
    );
    foreach($fields as $key=>$value)
    $fields_string .= $key . '=' . $value . '&';
    $fields_string = rtrim($fields_string, '&');

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
    curl_setopt($ch, CURLOPT_POST, count($fields));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, True);

    $result = curl_exec($ch);
    curl_close($ch);

    return json_decode($result, true);
}