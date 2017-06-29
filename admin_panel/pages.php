<?php require_once('inc\top.php'); ?>
<?php
if(!isset($_SESSION['username'])){
    header('Location:login.php');
}

?>
<?php

$session_username = $_SESSION['username'];

if(isset($_GET['del'])){
    $del_id = $_GET['del'];
    if($_SESSION['role'] == 'admin'){
         $del_check_query = "SELECT * FROM pages WHERE id = $del_id";
         $del_check_run = mysqli_query($con, $del_check_query);
    }
    else if($_SESSION['role'] == 'author'){
         $del_check_query = "SELECT * FROM pages WHERE id = $del_id and author = '$session_username'";
         $del_check_run = mysqli_query($con, $del_check_query);
    }
    if(mysqli_num_rows($del_check_run) > 0){
        $del_query = "DELETE FROM `pages` WHERE `pages`.`id` = $del_id";
        if(mysqli_query($con, $del_query)){
            $msg = "Page has been deleted";
        }
        else {
            $error = "Page has not been deleted";
        }

    }
    else{
        header('Location: index.php');
    }
        
}

if(isset($_POST['checkboxes'])){
    
    foreach($_POST['checkboxes'] as $user_id){
        $bulk_option = $_POST['bulk-options'];
        
        if($bulk_option == 'delete'){
            $bulk_del_query = "DELETE FROM `pages` WHERE `pages`.`id` = $user_id";
            mysqli_query($con, $bulk_del_query);
        }
        else if($bulk_option == 'publish'){
             $bulk_author_query = "UPDATE `pages` SET `status` = 'publish' WHERE `pages`.`id` = $user_id";
             mysqli_query($con, $bulk_author_query);
        }
        else if($bulk_option == 'draft'){
            $bulk_admin_query = "UPDATE `pages` SET `status` = 'draft' WHERE `pages`.`id` = $user_id";
             mysqli_query($con, $bulk_admin_query);
        }
    }
}

?> 
 
 
  </head>
  <body>
      <div id="wrapper">
           <?php require_once('inc\header.php'); ?>

            <div class="container-fluid body-section">
                <div class="row">
                    <div class="col-md-3">.
                        <?php require_once('inc\sidebar.php'); ?>
                    </div>
                    <div class="col-md-9">
                        <h1><i class="fa fa-file-text"></i> Pages    <small>View All Pages</small></h1><hr>
                        <ol class="breadcrumb">
                          <li><a href="index.php"><i class="fa fa-tachometer"></i> Dashboard</a></li>
                          <li class="active"><i class="fa fa-file-text"></i> Pages</li>
                        </ol>
                        
                        <?php 
                        if($_SESSION['role'] == 'admin'){
                            $query = "select * from pages order by id desc"; 
                            $run = mysqli_query($con, $query);
                        
                        }
                        else if($_SESSION['role']=='author'){
                            $query = "select * from pages where author = '$session_username' order by id desc"; 
                            $run = mysqli_query($con, $query);
                        
                        }
                        if(mysqli_num_rows($run) > 0){
                        ?>
                    <form action="" method="post">
                        <div class="row">
                            <div class="col-sm-8">
                               
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <div class="form-group">
                                                <select name="bulk-options" id="" class="form-control">
                                                    <option value="delete">Delete</option>
                                                    <option value="publish">Publish</option>
                                                    <option value="draft">Draft</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xs-8">
                                            <input type="submit" class="btn btn-success" value="Apply">
                                            <a href="add_pages.php" class="btn btn-primary">Add New</a>
                                        </div>
                                    </div>
                               
                            </div>
                        </div>
                        <?php
                        if(isset($error)){
                            echo "<span style='color:red;' class='pull-right'>$error</span>";
                        }
                        else if(isset($msg)){
                            echo "<span style='color:green;' class='pull-right'>$msg</span>";
                        }
                        ?>
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="selectallboxes"></th>
                                    <th>Sr.No</th>
                                    <th>Date</th>
                                    <th>Author</th>
                                    <th>Title</th>
                                    <th>Page Type</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                               <?php 
                                while($row = mysqli_fetch_array($run)){
                                    $id = $row['id'];
                                    $page_title = $row['page_title'];
                                    $page_author = $row['page_author'];
                                    $page_type = $row['page_type'];
                                    $page_status = $row['page_status'];
                                    $image = $row['page_image'];
                                    $date = getDate($row['page_date']);
                                    $day = $date['mday'];
                                    $month = substr($date['month'],0,3);
                                    $year = $date['year'];
                   
                                ?>
                               
                                <tr>
                                    <td><input type="checkbox" class = "checkboxes" name="checkboxes[]" value= "<?php echo $id; ?>"></td>
                                    <td><?php echo $id; ?></td>
                                    <td><?php echo "$day $month $year"; ?></td>
                                    <td><?php echo $page_author; ?></td>
                                    <td><?php echo "$page_title"; ?></td>
                                    <td><?php echo $page_type; ?></td>
                                    <td><img src="img/<?php echo $image; ?>" width="30px"></td>
                                    <td><span style="color:<?php 
                                            if($status == 'publish'){
                                                echo 'green';
                                            }
                                            else if($status == 'draft') {
                                                echo 'red';
                                            }
                                        ?>;"><?php echo ucfirst($page_status); ?></span></td>
                                    <td><a href="edit_page.php?edit=<?php echo $id; ?>"><i class="fa fa-pencil"></i></a></td>
                                    <td><a href="pages.php?del=<?php echo $id; ?>"><i class="fa fa-times"></i></a></td>
                                </tr>
                                <?php                  
                                }
                                ?>
                            </tbody>
                        </table>
                        <?php
                             }
                        else{
                            echo "<center><h2>No Pages available Now.</h2></center>";
                        }
                        ?>
                         </form>
                    </div>
                </div>
            </div>

            <?php require_once('inc\footer.php'); ?>