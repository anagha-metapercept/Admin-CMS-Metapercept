 <!--script type="text/javascript" src="ckeditor/ckeditor.js"></script-->

<?php 
require_once('inc\top.php'); 
if(!isset($_SESSION["username"])){
    header('Location:login.php');
}

$session_username = $_SESSION['username'];
$session_author_image = $_SESSION['author_image'];


?>
  </head>
  <body>
      <div id="wrapper">
           <?php require_once('inc\header.php'); ?>
            <div class="container-fluid body-section">
                <div class="row">
                    <div class="col-md-3">.
                        <?php require_once('inc\sidebar.php');?>
                    </div>
                    <div class="col-md-9">
                        <h1><i class="fa fa-plus-square"></i> Add Pages <small>Add New Page</small></h1><hr>
                        <ol class="breadcrumb">
                          <li><a href="index.html"><i class="fa fa-tachometer"></i> Dashboard</a></li>
                          <li class="active"><i class="fa fa-plus-square"></i> Add Page</li>
                        </ol>
                        
                        <?php
                        if(isset($_POST['submit'])){
                            $date = time();
                            $page_author = mysqli_real_escape_string($con, $_POST['page_author']);
                            $page_title = mysqli_real_escape_string($con, $_POST['page_title']);
                            $page_content =  mysqli_real_escape_string($con, $_POST['page_content']);
                            $page_type = $_POST['page_type'];
                            $page_image = $_FILES['page_image']['name'];
                            $tmp_name = $_FILES['page_image']['tmp_name'];
                            $page_status = $_POST['status'];
                            $page_name = $_POST['page_name'];
                            $tags =  mysqli_real_escape_string($con, $_POST['tags']);
                            
                            
                            
                            if(empty($title) or empty($post_data) or empty($tags) or empty($image)){
                                $error = "All (*) fields are Required";
                            }
                            else {
                                $insert_query = "INSERT INTO posts (date, title, author, author_image, image, categories, tags, post_data, views, status) VALUES ('$date','$title','$session_username','$session_author_image','$image','$categories','$tags','$post_data','0','$status')";
                                
                                if(mysqli_query($con, $insert_query)){
                                    $msg = "Post has been Added.";
                                    $path = "img/$image";
                                    $title = "";
                                    $post_data = "";
                                    $tags = "";
                                    $status = "";
                                    $categories = "";
                                    $title = "";
                                    if(move_uploaded_file($tmp_name, $path)){
                                        copy($path, "../$path");
                                    }
                                }
                                else{
                                    $error = "Post has not been Added";
                                }
                            }
                        }
                        ?>
                        
                        <div class="row">
                            <div class="col-xs-12">
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="title">Title:*</label>
                                        <?php
                                            if(isset($msg)){
                                                echo "<span class='pull-right' style='color:green;'>$msg</span>";
                                            }
                                            else if(isset($error)){
                                                echo "<span class='pull-right' style='color:red;'>$error</span>";
                                            }
                                        ?>
                                        
                                        <input type="text" name="title" placeholder="Type Post Title Here" value="<?php if(isset($title)){ echo $title;}?>" class="form-control">
                                    </div>
                                    <!--div class="form-group">
                                        <a href="media.php" class="btn btn-primary">Add Media</a>
                                    </div-->
                                    <div class="form-group">
                                        <label for="page_data">Page Content:*</label>
                                        <textarea name="page_data" id="textarea" class="form-control" cols="30" rows="10"><?php if(isset($page_data)){ echo $page_data; }?></textarea>
                                        <!--script>CKEDITOR.replace( 'page_data' );</script-->
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="file">Page Image:*</label>
                                                <input type="file" name="image" >
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="status">Page-type:*</label>
                                               <select class="form-control" name="page_type" id="page_type">
                                                   <option value="Service" <?php if(isset($page_type) and $page_type == 'services'){echo "selected"; }?>>Service</option>
                                                   <option value="Sub_Service" <?php if(isset($page_type) and $page_type == 'sub_services'){echo "selected"; }?>>Sub Service</option>
                                                   <option value="Industries" <?php if(isset($page_type) and $page_type == 'industries'){echo "selected"; }?>>Industries</option>
                                                   <option value="others" <?php if(isset($others) and $page_type == 'others'){echo "selected"; }?>>Others</option>
                                                   <option value="draft" <?php if(isset($status) and $status == 'draft'){echo "selected"; }?>>Draft</option>
                                               </select>    
                                        </div>
                                        <!--div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="categories">Categories:*</label>
                                               <select class="form-control" name="categories" id="categories">
                                                  <?php/* 
                                                   $cat_query = "SELECT * FROM catagories ORDER BY id DESC";
                                                   $cat_run = mysqli_query($con, $cat_query);
                                                   if(mysqli_num_rows($cat_run) > 0){
                                                        while($cat_row = mysqli_fetch_array($cat_run)){
                                                            $cat_name = $cat_row['catagory'];
                                                            echo "<option value = '".$cat_name."' ".((isset($categories) and $categories == $cat_name)?"selected":"").">".ucfirst($cat_name)."</option>";
                                                        }
                                                    }
                                                   else{
                                                       echo "<center><h6> No Category Available. <h6></center>";
                                                   }*/
                                                   ?>
                                               </select>
                                            </div>
                                        </div-->
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="tags">Tags:*</label>
                                               <input type="text" name="tags" placeholder="Your Tags Here" value = "<?php if(isset($tags)){ echo $tags;}?>"class="form-control">
                                            </div>
                                        </div>
                                         <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="status">Status:*</label>
                                               <select class="form-control" name="status" id="status">
                                                   <option value="publish" <?php if(isset($status) and $status == 'publish'){echo "selected"; }?>>Publish</option>
                                                   <option value="draft" <?php if(isset($status) and $status == 'draft'){echo "selected"; }?>>Draft</option>
                                               </select>
                                            </div>
                                        </div>
                                        <input type="submit" class = "btn btn-primary" value="Add Post" name="submit">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php require_once('inc\footer.php'); ?>