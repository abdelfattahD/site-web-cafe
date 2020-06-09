<?php include "db/connec.php"; ?>
<? session_start(); ?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>The Perfect Cup - Blog</title>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/business-casual.css" rel="stylesheet">

    <!-- Bootstrap Core CSS -->
    <link href="css/login.css" rel="stylesheet">

  


    <!-- Fonts -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>


    <div class="brand">The Perfect Cup</div>
    <div class="address-bar">3481 Melrose Place | Beverly Hills, CA 90210 | 123.456.7890</div>

    <!-- Navigation -->
    <?php include 'Navbar.php';?>

 
<?php

$message = "";

if (isset($_POST['submit'])) {

    $fname = $_POST['fname'];
    $lname = $_POST['Lname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordc = $_POST['cpassword'];

    $fname = mysqli_real_escape_string($mysqli,$fname);
    $lname = mysqli_real_escape_string($mysqli,$lname);
    $email = mysqli_real_escape_string($mysqli,$email);
    $password = mysqli_real_escape_string($mysqli,$password);

    
    

    $search_query = "SELECT * FROM users WHERE Email = '$email'";
    $search_result = mysqli_query($mysqli,$search_query);
    
    if (strlen($fname)<2){

        $message = "<div class='alert alert-danger'>your first name is too short</div>";

    }else if (strlen($lname)<2){

        $message = "<div class='alert alert-danger'>your last name is too short</div>";

    }else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){

        $message = "<div class='alert alert-danger'>your email format is invalid</div>";

    }else if (mysqli_num_rows($search_result) > 0) {

        $message = "<div class='alert alert-danger'>your email already exists, please login</div>";

    }else if (!preg_match("#.*^(?=.{6,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$#", $password )){

        $message = "<div class='alert alert-danger'>your password should have at least a capital, a lower a number, a special caracter and should be longer than 6 caracters</div>";

    }else if ($passwordc !== $password ){

        $message = "<div class='alert alert-danger'>your password should  be same of password confrmed</div>";

    }
    else{
    
       
    $query = "INSERT INTO users(fName,LName,Email,passwor) VALUES ('{$fname}','{$lname}','{$email}','{$password}')";
    $register_query = mysqli_query($mysqli,$query);
    $message = "<div class='alert alert-success'>registration submitted</div>";
    header("Location: login.php");
    if (!$register_query) {
        die("QUERY FAILED" . mysqli_error($mysqli));
    }
    }

}

    
?>


<div id="containerR">
    <div class="login-wrap">
        <div class="login-html">
            <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab"><a href="Login.php">Login</a></label>
            <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Register</label>

                
                    <form role="form"  method="post" >
                        <div class="row">
                            <div class="form-group col-lg-4" id="col-lg-1">
                                <label class="label" >First Name</label>
                                <input type="fname" id="fname" name="fname" class="form-control" maxlength="30">
                            </div>
                            <div class="form-group col-lg-4" id="col-lg-2">
                                <label class="label">Last Name</label>

                                <input type="Lname" id="Lname" name="Lname" class="form-control" maxlength="30">
                            </div>
                            <div class="form-group col-lg-4" id="col-lg-3">
                                <label class="label">Email address</label>

                                <input type="email" id="email" name="email" class="form-control" maxlength="40">
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group col-lg-4" id="col-lg-4">
                                <label class="label">Password</label>

                                <input type="password" id="password" name="password" class="form-control" maxlength="25">
                            </div>
                            <div class="form-group col-lg-4" id="col-lg-5">
                                <label class="label">Confirm Password </label>

                                <input type="password" id="passwordc" name="cpassword" class="form-control" maxlength="25">
                            </div>
                              
                        </div>
                        <div class="group">
                           <input  type="submit" class="button" name="submit" value="Sign In">
                            </div>
                        <div id="add_err2"><?php echo $message ?></div>                                

                    </form>
                    
            
            </div>
        </div>
    </div>
  

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p>Copyright &copy; The Perfect Cup 2019</p>
                </div>
            </div>
        </div>

    </footer>
    
    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>
<!--<script src="js/log.js"></script>-->