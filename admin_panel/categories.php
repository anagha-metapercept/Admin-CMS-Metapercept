<?php require_once('inc\top.php');?>
<?php
if(!isset($_SESSION['username'])){
    header('Location:login.php');
}
else if(isset($_SESSION['username']) && $_SESSION['role']=='author'){
    header('Location:index.php');
}

if(isset($_GET['edit'])){
    $edit_id = $_GET['edit'];
}

if(isset($_GET['del'])){
    $del_id = $_GET['del'];
    
    if(isset($_SESSION['username']) and $_SESSION['role'] == 'admin'){
        $del_query = "DELETE FROM catagories WHERE id = '$del_id'";
        if(mysqli_query($con, $del_query)){
           $del_msg = "Category has been deleted";
        }
        else{
           $del_error = "Category has not been deleted";
        }
    }
}

if(isset($_POST['submit'])){
    $cat_name = mysqli_real_escape_string($con, strtolower($_POST['cat_name']));
    
   if(empty($cat_name)){
       $error = "Must fill this Field";
   }
   else{
        $check_query = "SELECT * FROM catagories WHERE catagory = '$cat_name'";
        $check_run = mysqli_query($con, $check_query);
        if(mysqli_num_rows($check_run) > 0){
            $error = "Category Already Exist";
        }
        else{
            $insert_query = "INSERT INTO catagories (catagory) VALUES ('$cat_name')";
            if(mysqli_query($con, $insert_query)){
                $msg = "Category has been Added";
            }
            else{
                $error = "Category has not been Added";
            }
        }
    }
}

if(isset($_POST['update'])){
    $cat_name = mysqli_real_escape_string($con, strtolower($_POST['cat_name']));
    
   if(empty($cat_name)){
       $up_error = "Must fill this Field";
   }
   else{
        $check_query = "SELECT * FROM catagories WHERE catagory = '$cat_name'";
        $check_run = mysqli_query($con, $check_query);
        if(mysqli_num_rows($check_run) > 0){
            $up_error = "Category Already Exist";
        }
        else{
            $update_query = "UPDATE `catagories` SET `catagory` = '$cat_name' WHERE `catagories`.`id` = $edit_id";
            if(mysqli_query($con, $update_query)){
                $up_msg = "Category has been Updated";
            }
            else{
                $up_error = "Category has not been Updated";
            }
        }
    }
}

?>
  </head>
  <body>
      <div id="wrapper">
           <?php require_once('inc\header.php');?>

            <div class="container-fluid body-section">
                <div class="row">
                    <div class="col-md-3">.
                        <?php require_once('inc\sidebar.php');?>
                    </div>
                    <div class="col-md-9">
                       <h1><i class="fa fa-folder-open"></i> Categories <small>Different Categories</small></h1><hr>
                        <ol class="breadcrumb">
                          <li class="active"><a href="index.php"><i class="fa fa-tachometer"></i>Dashboard</a></li>
                           <li class="active"><i class="fa fa-folder-open"></i>Categories</li>
                        </ol>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <form action="" method="post">
                                    <div class="form-group">
                                        <lable for="category">Category Name</lable>
                                        <?php
                                            if(isset($msg)){
                                                echo "<span class = 'pull-right' style='color:green;'>$msg</span>";
                                            }
                                            else if(isset($error)){
                                                echo "<span class = 'pull-right' style='color:red;'>$error</span>";
                                            }
                                        ?>
                                        <input type="text" name="cat_name" placeholder="Category Name" class="form-control">
                                    </div>
                                    <input type="submit" value="Add Category" name="submit" class="btn btn-primary">
                                </form>
                                <?php
                                if(isset($_GET['edit'])){
                                    $edit_check_query = "SELECT * FROM catagories WHERE id = $edit_id";
                                    $edit_check_run = mysqli_query($con, $edit_check_query);
                                    if(mysqli_num_rows($edit_check_run) > 0){
                                        $edit_row = mysqli_fetch_array($edit_check_run);
                                            $up_category = $edit_row['catagory'];
                                  
                                ?>
                                <hr>
                                
                              <form action="" method="post">
                                <div class="form-group">
                                    <lable for="category">Update Category Name</lable>
                                    <?php
                                        if(isset($up_msg)){
                                            echo "<span class = 'pull-right' style='color:green;'>$up_msg</span>";
                                        }
                                        else if(isset($up_error)){
                                            echo "<span class = 'pull-right' style='color:red;'>$up_error</span>";
                                        }
                                    ?>
                                    <input type="text" name="cat_name" placeholder="Category Name" class="form-control" value="<?php echo $up_category; ?>">
                                </div>
                                <input type="submit" value="Update Category" name="update" class="btn btn-primary">
                            </form>
                            <?php
                                  }
                                }
                            ?>
                            </div>
                            <div class="col-md-6">
                               <?php
                                $get_query = "SELECT * FROM catagories ORDER BY id DESC";
                                $get_run = mysqli_query($con, $get_query);
                                if(mysqli_num_rows($get_run) > 0){
                                    if(isset($del_msg)){
                                        echo "<span class = 'pull-right' style='color:green;'>$del_msg</span>";
                                    }
                                    else if(isset($del_error)){
                                        echo "<span class = 'pull-right' style='color:red;'>$del_error</span>";
                                    }
                                ?>
                                
                                <table class="table table-hover table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sr No.</th>
                                            <th>Category Name</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php
                                        while($get_row = mysqli_fetch_array($get_run)){
                                            $category_id = $get_row['id'];
                                            $category_name = $get_row['catagory'];
                                        ?>
                                        <tr>
                                            <td><?php echo $category_id; ?></td>
                                            <td><?php echo ucfirst($category_name); ?></td>
                                            <td><a href="categories.php?edit=<?php echo $category_id; ?>"><i class="fa fa-pencil"></i></a></td>
                                            <td><a href="categories.php?del=<?php echo $category_id; ?>"><i class="fa fa-times"></i></a></td>
                                        </tr>  
                                        <?php
                                        }
                                        
                                        ?>                                      
                                    </tbody>
                                </table>
                                <?php
                                }                         
                                else{
                                    echo "<center><h3>No Category Found.</h3></center>";
                                }

                                ?>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>

            <?php require_once('inc\footer.php');?>