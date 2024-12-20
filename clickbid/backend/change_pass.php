<?php
    include 'connection.php';
    session_start();
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        // $user_id = $_SESSION['user_id'];
        $old_password = $_POST['old-password'];
        $password = $_POST['password'];
        $cpassword = $_POST['confirmPassword'];

        if($_SESSION['password']==$old_password){
            if($password == $cpassword){
                // echo $user_id;
                $sql = "UPDATE user SET password = '$password' where user_id= '".$_SESSION['user_id']."'";
                $result = mysqli_query($conn, $sql);
                if($result){
                    echo "<script>alert(\"Password Changed Succcessfully\");
                                window.open(\"../userfunction.php\",\"_self\");
                        </script>";
                }
            }
            else{
                echo "<script>alert(\"Password does not match\");
                        window.open(\"change_pass.php\",\"_self\");
                </script>";
            }
        }
        else{
            echo "<script>alert(\"Old Password does not match\");
                        window.open(\"change_pass.php\",\"_self\");
                </script>";
        }
    }
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Delete Your Account</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <form action="change_pass.php" method="post">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Enter Your Old Password</label>
                <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="old-password">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Enter Your New Password</label>
                <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="password">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Confirm Your New Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="confirmPassword">
            </div>
            <button type="submit" class="btn btn-success">Update Password</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>