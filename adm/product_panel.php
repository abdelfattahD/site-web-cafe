
<?php include 'panel.php';?>



            <div class="container-add">

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Product List
        </h1>
        
    </div>
</div>
<!-- /.row -->
<table class="table table-bordered table-hover">
<thead>
    <tr>

        <th>Id</th>
        <th>Title</th>                       
        <th>Image</th>
        <th>Description</th>
        <th>Info</th>
        <th>Price</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
</thead>

      <tbody>
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
                $product_price = $row['product_price'];
               


                echo "<tr>";
                echo "<td>$product_id</td>";
                echo "<td>$product_title</td>";
                echo "<td><img class= 'img-responsive' src='../img/$product_image' alt='' width='100' height='100' ></td>";
                echo "<td>$product_desc</td>";
                echo "<td>$product_info</td>";
                echo "<td>$product_price</td>";
                echo "<td> <a href='product_Edit.php?edit=$product_id'>Edit</a></td>";
                echo "<td><a href='product_panel.php?delete=$product_id'>Delete</a></td>";
                echo "</tr>";
            }

            if (isset($_GET['delete'])) {
                $deleted_product_id = $_GET['delete'];

                $delete_query = "DELETE FROM products WHERE product_id = $deleted_product_id"; 
                $deleted_product_query = mysqli_query($connection,$delete_query);

                header('Location: product_panel.php');
            }

        ?>

      </tbody>
</table>

</form>

</div>
<!-- /.container-fluid -->

