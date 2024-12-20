<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        include 'connection.php';
        $email = $_POST["email"];
        $password = $_POST["password"];
        
    $sql = "Select * from user where email='$email'";
    $result = mysqli_query($conn, $sql);

    $num = mysqli_num_rows($result);
    // echo $num;
    if ($num>0){
        while($row=mysqli_fetch_assoc($result)){
            if ($row['password']==$password){ 
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['email'] = $email;
                $_SESSION['password']=$password;
                $_SESSION['user_id'] = $row['user_id'];
                // echo $_SESSION['user_id'];
                header('location:../userfunction.php');
                exit();
            } 
            else{
                echo '<script>alert("Error!! Invalid credentials.");
                window.open("../signin.html","_self");
                </script>';
            }
        }
    } 
    else{
        echo '<script>alert("Error!! Invalid credentials.");
        window.open("../signin.html","_self");
        </script>';
    }
}
?>