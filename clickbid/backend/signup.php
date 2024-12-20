<?php
    $userNotExists = true;
    $regd = false;

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        include 'connection.php';
        $user_id = uniqid('U_');
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $cpassword = $_POST['confirmPassword'];
        $dob = $_POST['dob'];
        $city = $_POST['state'];

        
        $sql = "Select * from user where username='$username'";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);
        if ($num>0){
            $userNotExists = false;
        }

        if($password == $cpassword){
            if($userNotExists){
                // $passhash = password_hash($password, PASSWORD_DEFAULT);
                $sql = "INSERT INTO user (user_id,username, email, password, dob, city, created_date) VALUES ('$user_id', '$username', '$email', '$password', '$dob', '$city', current_timestamp())";
                // echo $email;
                $result = mysqli_query($conn, $sql);
                echo"<script>window.open('../signin.html','_self')</script>";
            }
            else{
                echo '<script>alert("User already exists !! please Login");
                window.open("../signup.html","_self");
                </script>';
            }
        }
        else{
            echo '<script>alert("Wrong Password !!");
            window.open("../signup.html","_self");
            </script>';
        }
    }
    else{
        echo"<script>window.open('signup.html','_self')</script>";
    }
?>