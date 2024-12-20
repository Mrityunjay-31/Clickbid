<?php
    include 'connection.php';
    session_start();
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $user_id = $_SESSION['user_id'];
        $password = $_POST['password'];
        $cpassword = $_POST['confirmPassword'];

        if($_SESSION['password']==$password){
            if($password == $cpassword){
                // echo $user_id;
                $sql = "DELETE FROM user WHERE user_id = '$user_id'";
                $result = mysqli_query($conn, $sql);
                if($result){
                    echo "<script>alert(\"Account Deleted Succcessfully\");
                                window.open(\"../index.html\",\"_self\");
                        </script>";
                }
            }
            else{
                echo "<script>alert(\"Password does not match\");</script>\";
                        window.open(\"../userfunction.php\",\"_self\");
                </script>";
            }
        }
        else{
            echo "<script>alert(\"Password does not match\");
                        window.open(\"../userfunction.php\",\"_self\");
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
        <form action="delete_account.php" method="post">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Enter Your Password</label>
                <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="password">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Confirm Your Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="confirmPassword">
            </div>
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>