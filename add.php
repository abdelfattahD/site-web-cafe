<?php

$message = "";


    $fname = $_POST['fname'];
    $lname = $_POST['Lname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $fname = mysqli_real_escape_string($mysqli,$fname);
    $lname = mysqli_real_escape_string($mysqli,$lname);
    $email = mysqli_real_escape_string($mysqli,$email);
    $password = mysqli_real_escape_string($mysqli,$password);

    
    

    $search_query = "SELECT * FROM users WHERE Email = '$email'";
    $search_result = mysqli_query($mysqli,$search_query);
    
    

   if (mysqli_num_rows($search_result) > 0) {

        $message = "<div class='alert alert-danger'>your email already exists, please login</div>";

    }else{
    
    $password = password_hash($password, PASSWORD_DEFAULT);
       
    $query = "INSERT INTO users(fName,LName,Email,Password) VALUES ('{$fname}','{$lname}','{$email}','{$password}')";
    $register_query = mysqli_query($mysqli,$query);
    $message = "<div class='alert alert-success'>registration submitted</div>";
        header("location:index.php");

    // header("Location: index.php");
    if (!$register_query) {
        die("QUERY FAILED" . mysqli_error($mysqli));
    }
    }



    
?>