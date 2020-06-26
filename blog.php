<?php include "db.php"; ?>

<?php


session_start();
if (isset($_SESSION['id'])) {
    $fname = $_SESSION['fname'];
    $lname = $_SESSION['lname'];

    $full_name = $fname . " " . $lname;
?>

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




        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- navbar-brand is hidden on larger screens, but visible when the menu is collapsed -->
                <a class="navbar-brand" href="index.html">The Perfect Cup</a>
            </div>
              <!-- Navigation -->
    <?php include 'nav.php' ?>


    <div class="container">

        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                <h2 class="text-center">Welcome <?php echo $full_name?> </h2>
                    <hr>
                    <h2 class="intro-text text-center">The Perfect Cup
                        <strong>blog</strong>
                    </h2>
                    <hr>
                </div>
                <?php 
                            $query = "SELECT * FROM products";
                            $load_products_query = mysqli_query($connection,$query);

                            if (!$load_products_query) {
                                die("QUERY FAILED". mysqli_error($connection));
                            }

                            while ($row = mysqli_fetch_array($load_products_query)) {
                                $product_id = $row['product_id'];
                                $product_title = $row['product_name'];
                                $product_image = $row['product_img'];
                                $product_desc = $row['product_desc'];
                                $product_info = $row['product_info'];
                         

                                ?>
                        
                <div class="col-lg-12 text-center">
                    <img class="img-responsive img-border img-full" src="img/<?php echo $product_image ?>" alt="<?php echo $product_image ?>">
                    <h2><?php echo $product_title ?>
                        <br>
                    </h2>
                    <p><?php echo $product_desc ?>.</p>
                    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal<?php echo $product_id ?>">Read More</button>
                    <a href = "cart.php?item=<?php echo $product_id ?>" class="btn btn-success btn-lg" data-dismiss="modal">Add To Cart</a>
                     <hr>
                </div>
                 <!--Modal-1-->
	<div id="myModal<?php echo $product_id ?>" class="modal fade" role="dialog">
		<div class="modal-dialog">
            <!--Modal Content-->
            <div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss-="modal">&times;</button>
				<h4 class="modal-title"><?php echo $product_title ?></h4>
			</div>
			<div class="modal-body">
				<p><?php echo $product_info ?></p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            
            </div>
		</div>
	</div>
                        <?php
                            }
                        ?>
                
                <div class="col-lg-12 text-center">
                    <ul class="pager">
                        <li class="previous"><a href="#">&larr; Older</a>
                        </li>
                        <li class="next"><a href="#">Newer &rarr;</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
    <!--container -->
   
   
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

</html>
<?php

}
else {
    header("location:login.php");
}

?>