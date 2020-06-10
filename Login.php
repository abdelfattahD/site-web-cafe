
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>The Perfect Cup - Contact</title>

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

        <!-- <script src="js/script.js" defer></script> -->
</head>

<body>

    <div class="brand">The Perfect Cup</div>
    <div class="address-bar">3481 Melrose Place | Beverly Hills, CA 90210 | 123.456.7890</div>

    <!-- Navigation -->
    <?php include 'nav.php' ?>

<?php
session_start();
    $messageL = "";
if (isset($_POST['login'])) {

    
    $email = $_POST['email'];
    $password = $_POST['password'];

    

    $query = "SELECT * FROM users WHERE Email = '{$email}'";
    $login_query = mysqli_query($connection,$query);

    if (!$login_query) {
        die("QUERY FAILED" . mysqli_error($connection));
    }

    while($row = mysqli_fetch_assoc($login_query)){
        $db_id = $row['id'];
        $db_email = $row['Email'];
        $hash = $row['Passwor'];
        $db_fname = $row['fName'];
        $db_lname = $row['LName'];
       
    } 
    $row_count = mysqli_num_rows($login_query);
    if ($row_count < 1) {
        $messageL = "<div class='alert alert-danger'>this email does not exist, try again or <a href='register.php'>register</a> </div>";;
    }else {
        if ($password=== $hash) {
             $messageL = "<div class='alert alert-success'>Welcome $db_fname </div>";
            $_SESSION['id'] = $db_id;
            $_SESSION['fname'] = $db_fname;
            $_SESSION['lname'] = $db_lname;
            $messageL =  "<div class='alert alert-danger'>correct</div>";

            header('Location: blog.php');
        } else{
            $messageL =  "<div class='alert alert-danger'>$hash your password $password in incorrect</div>";
        }
    }
    

}

?>   



<div id="containerR">
    <div class="login-wrap">
        <div class="login-html">
            <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Login</label>
            <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab"><a href="regster.php">Register</a></label>

            <div class="login-form">
                    <form role="form"  method="post">
                <div class="sign-in-htm">
                    <div class="group">
                    <label for="pass"  class="label">Email Address</label>
                    <input type="email" id="email" name="email" class="form-control" maxlength="40">
                    </div>
                    <div class="group">
                        <label for="pass" class="label">Password</label>
                        <input type="password" id="password" name="password" class="form-control" maxlength="25">
                    </div>
                    
                    <div class="group">
                        <input  type="submit" name="login" class="button" value="Sign In">
                    </div>
                    <div id="add_err2"><?php echo $messageL ?></div>

                </div>

                </form>
                
            </div>
        </div>
    </div>
    </div>
    </div>
    <!-- /.container -->

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p>Copyright &copy; The Perfect Cup 2019</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>