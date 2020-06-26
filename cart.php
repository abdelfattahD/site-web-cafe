
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
<!-- Bootstrap Core CSS -->
<link href="css/cart.css" rel="stylesheet">

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
    <?php session_start(); ?>
    <!-- Navigation -->
    <?php include 'nav.php' ?>



  

<?php 
    //getting the session id
    if (isset($_SESSION['id'])) {
        $client_id = $_SESSION['id'];
    }
    //getting the item id
    if (isset($_GET['item'])) {
        $item_id = $_GET['item'];
        //getting all items from cart table
    $cart_query = "SELECT * FROM cart WHERE item_id = $item_id AND client_id = $client_id";
    $cart_search_query = mysqli_query($connection,$cart_query);
    if (!$cart_search_query) {
        die("QUERY FAILED" . mysqli_error($connection));
    }
    while ($row = mysqli_fetch_array($cart_search_query)) {
        $item_title = $row['item_name'];
        $item_image = $row['item_img'];
        $item_price = $row['item_price'];
        $item_quantity = $row['item_quantity'];
    }
    $row_count = mysqli_num_rows($cart_search_query);

    if($row_count > 0){
        $update_query = "UPDATE cart SET item_quantity = item_quantity+1 WHERE item_id = $item_id AND client_id = $client_id";
        $update_item_query = mysqli_query($connection,$update_query);
        header('Location: cart.php');

    }else{
         //getting the item infos from products table
        $item_query = "SELECT * FROM products WHERE product_id = $item_id";
        $item_search_query = mysqli_query($connection,$item_query);

        while ($row = mysqli_fetch_array($item_search_query)) {
            $item_title = $row['product_name'];
            $item_image = $row['product_img'];
            $item_price = $row['product_price'];
            
        }

        if (!$item_search_query) {
            die("QUERY FAILED" . mysqli_error($connection));
        }

         //adding the item to cart if it doesn't already exist
        $add_query = "INSERT INTO cart(client_id,item_id,item_name,item_img,item_price) VALUES ($client_id,$item_id,'$item_title','$item_image',$item_price)";
        $add_to_cart_query = mysqli_query($connection,$add_query);

        if (!$add_to_cart_query) {
            die("QUERY FAILED" . mysqli_error($connection));
        }

        header('Location: cart.php');
    }
    }

    

   

      

?>



            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                        Shopping Cart
                        </h1>
                        
                    </div>
                </div>
                <!-- /.row -->
                <table class="table table-bordered ">
                <thead>
                    <tr>
                
                        <th>Id</th>
                        <th>Title</th>                       
                        <th>Image</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                
                      <tbody>
                      <?php 
                            
                            $cart_query = "SELECT * FROM cart WHERE client_id = $client_id";
                            $cart_search_query = mysqli_query($connection,$cart_query);
                            while ($row = mysqli_fetch_array($cart_search_query)) {
                                
                                $cart_id = $row['item_id'];
                                $item_title = $row['item_name'];
                                $item_image = $row['item_img'];
                                $item_price = $row['item_price'];
                                $item_quantity = $row['item_quantity'];

                                $total = $item_price * $item_quantity;

                                echo "<tr>";
                                echo "<td>$cart_id</td>";
                                echo "<td>$item_title</td>";
                                echo "<td><img class= 'img-responsive' src='img/$item_image' alt='' width='100' height='100'></td>";
                                echo "<td>$item_price</td>";
                                echo "<td >$item_quantity &nbsp &nbsp<a href='cart.php?add=$cart_id&user=$client_id'>
                                <button class='button minus' >+</button></a><a href='cart.php?reduce=$cart_id&user=$client_id'>
                                <button class='button minus' > - </button></a></td>";
                                echo "<td>$total</td>";
                                
                                echo "<td><a href='cart.php?remove=$cart_id&user=$client_id'>Remove</a></td>";
                                echo "</tr>";

                            }

                                
                            if (isset($_GET['remove'])) {
                                $removed_item_id = $_GET['remove'];

                                $remove_query = "DELETE FROM cart WHERE item_id = $removed_item_id AND client_id = $client_id";
                                $removed_item_query = mysqli_query($connection,$remove_query);

                                header('Location: cart.php');
                            }
                            if (isset($_GET['add'])) {
                                $added_item_id = $_GET['add'];

                                $add_item_query = "UPDATE cart SET item_quantity = item_quantity + 1 WHERE item_id = $added_item_id AND client_id = $client_id";
                                $added_item_query = mysqli_query($connection,$add_item_query);

                                header('Location: cart.php');
                            }

                            if (isset($_GET['reduce'])) {
                                $reduced_item_id = $_GET['reduce'];

                                $check_query = "SELECT * FROM cart WHERE item_id = $reduced_item_id AND client_id = $client_id ";
                                $check_quantity_query = mysqli_query($connection,$check_query);
                                $check_row = mysqli_fetch_array($check_quantity_query);
                                $quantity = $check_row['item_quantity'];

                                if ($quantity == 1 ) {
                                    $reduce_item_query = "DELETE FROM cart WHERE item_id = $reduced_item_id AND client_id = $client_id";
                                    $reduced_item_query = mysqli_query($connection,$reduce_item_query);
                                }else{
                                    $reduce_item_query = "UPDATE cart SET item_quantity = item_quantity - 1 WHERE item_id = $reduced_item_id AND client_id = $client_id";
                                    $reduced_item_query = mysqli_query($connection,$reduce_item_query);
                                }

                                

                                header('Location: cart.php');
                            }
                            

                            
                        ?>

                      </tbody>
            </table>
            <a href = "blog.php" class="btn btn-success btn-lg" data-dismiss="modal">Back to Blog</a>
            <a href = "#" class="btn btn-success btn-lg" data-dismiss="modal">Checkout</a>
            
            </form>

            </div>
            <!-- /.container-fluid -->

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

<script>
/* Set rates + misc */
var taxRate = 0.05;
var shippingRate = 15.00; 
var fadeTime = 300;


/* Assign actions */
$('.product-quantity input').change( function() {
  updateQuantity(this);
});

$('.product-removal button').click( function() {
  removeItem(this);
});


/* Recalculate cart */
function recalculateCart()
{
  var subtotal = 0;
  
  /* Sum up row totals */
  $('.product').each(function () {
    subtotal += parseFloat($(this).children('.product-line-price').text());
  });
  
  /* Calculate totals */
  var tax = subtotal * taxRate;
  var shipping = (subtotal > 0 ? shippingRate : 0);
  var total = subtotal + tax + shipping;
  
  /* Update totals display */
  $('.totals-value').fadeOut(fadeTime, function() {
    $('#cart-subtotal').html(subtotal.toFixed(2));
    $('#cart-tax').html(tax.toFixed(2));
    $('#cart-shipping').html(shipping.toFixed(2));
    $('#cart-total').html(total.toFixed(2));
    if(total == 0){
      $('.checkout').fadeOut(fadeTime);
    }else{
      $('.checkout').fadeIn(fadeTime);
    }
    $('.totals-value').fadeIn(fadeTime);
  });
}


/* Update quantity */
function updateQuantity(quantityInput)
{
  /* Calculate line price */
  var productRow = $(quantityInput).parent().parent();
  var price = parseFloat(productRow.children('.product-price').text());
  var quantity = $(quantityInput).val();
  var linePrice = price * quantity;
  
  /* Update line price display and recalc cart totals */
  productRow.children('.product-line-price').each(function () {
    $(this).fadeOut(fadeTime, function() {
      $(this).text(linePrice.toFixed(2));
      recalculateCart();
      $(this).fadeIn(fadeTime);
    });
  });  
}


/* Remove item from cart */
function removeItem(removeButton)
{
  /* Remove row from DOM and recalc cart total */
  var productRow = $(removeButton).parent().parent();
  productRow.slideUp(fadeTime, function() {
    productRow.remove();
    recalculateCart();
  });
}
</script>