<?php
    include 'connection.php';
    session_start();
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            //GETTING INFO FROM FORM
            $projectID = uniqid('P_');
            $project_name = $_POST['project_title'];
            $description = $_POST['description'];
            $category = $_POST['category'];
            $budget = $_POST['budget'];
            $deadline = $_POST['deadline'];
            $skills = $_POST['skills'];
            $features = implode(", ", $_POST['features']);
            $contact_type = $_POST['contact_type'];
            $contact = $_POST['contact'];
            $username =  $_SESSION['username'];
            $user_id = $_SESSION['user_id'];
            $status = "LIVE";
            //DATE VALIDATION
            $currentDate = new DateTime(); 
            $inputDate = new DateTime($deadline);
            if($inputDate<$currentDate){
                $status = "END";
                echo "<script>alert(\"Please Enter a Future Date\");</script>";
                echo "<script>window.open('../postproject.html','_self')</script>";
            }

            //BUDGET VALIDATION
            if($budget<=0){
                echo "<script>alert(\"Please Enter a Valid Budget greater than 0\");</script>";
                echo "<script>window.open('../postproject.html','_self')</script>";
            }

            //SQL INJECTION
            $sql = "INSERT INTO projects (project_id, project_name, description, category, price, bidding_date, deadline, skills, features, client_id, client_name, contact_method, contact, status) VALUES ('$projectID', '$project_name', '$description', '$category', '$budget', current_timestamp(), '$deadline', '$skills', '$features', '$user_id', '$username', '$contact_type', '$contact', '$status')";
            $result = mysqli_query($conn, $sql);

            //AFTER SUBMISSION REDIRECTION
            echo"<script>window.open('../userfunction.php','_self')</script>";
    
        }
        else{
            echo "<script>alert(\"Sorry For this Inconvinience!! Please fill the form again\");</script>";
            echo "<script>window.open('../postproject.html','_self')</script>";
        }
    }
    else{
        echo "<script>
                alert(\"Please login first to post your Project\");
                window.open('../signin.html','_self');
            </script>";
    }
?>