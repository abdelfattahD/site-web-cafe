<?php include 'panel.php';?>


            <div class="container-add">

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Users List
        </h1>
        
    </div>
</div>
<!-- /.row -->
<table class="table table-bordered table-hover">
<thead>
    <tr>

        <th>Id</th>
        <th>First Name</th>                       
        <th>Last Name</th>                       
        <th>Email</th>
        <th>Delete</th>
    </tr>
</thead>

      <tbody>
      <?php 
            $query = "SELECT * FROM users";
            $load_users_query = mysqli_query($connection,$query);

            if (!$load_users_query) {
                die("QUERY FAILED". mysqli_error($connection));
            }

            while ($row = mysqli_fetch_array($load_users_query)) {
                $user_id = $row['id'];
                $user_fname = $row['fName'];
                $user_lname = $row['LName'];
                $user_email = $row['Email'];
                
                echo "<tr>";
                echo "<td>$user_id</td>";
                echo "<td>$user_fname</td>";
                echo "<td>$user_lname</td>";
                echo "<td>$user_email</td>";                               
                echo "<td><a href='panel_users.php?delete=$user_id'>Delete</a></td>";
                echo "</tr>";
            }
            
            if (isset($_GET['delete'])) {
                $deleted_user_id = $_GET['delete'];

                $delete_query = "DELETE FROM users WHERE id = $deleted_user_id";
                $deleted_user_query = mysqli_query($connection,$delete_query);

                header('Location: panel_users.php');
            }
            

        ?>

      </tbody>
</table>

</form>

</div>
<!-- /.container-fluid -->