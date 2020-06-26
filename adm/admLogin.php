
<?php include "../db.php"; ?>
<?php ob_start(); ?>


<?php
session_start();
    $messageL = "";
if (isset($_POST['login'])) {

    
    $email = $_POST['email'];
    $password = $_POST['password'];

    

    $query = "SELECT * FROM adminusers WHERE email = '{$email}'";
    $login_query = mysqli_query($connection,$query);

    if (!$login_query) {
        die("QUERY FAILED" . mysqli_error($connection));
    }

    while($row = mysqli_fetch_assoc($login_query)){
        $db_id = $row['id'];
        $db_email = $row['email'];
        $hash = $row['passwor'];
       
       
    } 
    $row_count = mysqli_num_rows($login_query);
    if ($row_count < 1) {
        $messageL = "<div class='alert alert-danger'>this email does not exist, try again or <a href='register.php'>register</a> </div>";;
    }else {
        if ($password=== $hash) {
             $messageL = "<div class='alert alert-success'>Welcome $db_fname </div>";
            $_SESSION['idAdmin'] = $db_id;
          
            $messageL =  "<div class='alert alert-danger'>correct</div>";

            header('Location:product_panel.php');
        } else{
            $messageL =  "<div class='alert alert-danger'>$hash your password $password in incorrect</div>";
        }
    }
    

}

?>   

<link href="../css/login.css" rel="stylesheet">


<div id="containerR">
    <div class="login-wrap">
        <div class="login-html">
            <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Login</label>
            <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab"></label>

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


    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

