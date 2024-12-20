<?php
    include 'connection.php';
    session_start();
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $username = $_POST['username'];
        $currentPassword = $_POST['currentPassword'];
        $password = $_POST['password'];
        $cpassword = $_POST['confirmPassword'];
        $dob = $_POST['dob'];
        $city = $_POST['city'];

        if($_SESSION['password']==$currentPassword){
            if($password == $cpassword){
                $sql = "UPDATE user SET username = '$username', password = '$password', city = '$city', dob = '$dob' where email= '".$_SESSION['email']."'";
                $result = mysqli_query($conn, $sql);
    
                if($result){
                    echo "<script>alert(\"Updated Succcessfully\");
                                window.open(\"../userfunction.php\",\"_self\");
                        </script>";
                }
            }
            else{
                echo "<script>alert(\"New Password and Confirm Password does not match\");</script>\";
                        window.open(\"../edit_profile.html","_self\");
                </script>";
            }
        }
        else{
            echo "<script>alert(\"Invalid Old Password\");
                        window.open(\"../edit_profile.html","_self\");
                </script>";
        }
    }
?>