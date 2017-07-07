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
                    <div class="col-md-2">.
                        <?php require_once('inc\sidebar.php');?>
                    </div>
                    <div class="col-md-10">
                        <div class="col-md-9">
                            <h1><i class="fa fa-plus-square"></i> Add Pages <small>Add New Page</small></h1><hr>
                            <ol class="breadcrumb">
                              <li><a href="index.php"><i class="fa fa-tachometer"></i> Dashboard</a></li>
                              <li class="active"><i class="fa fa-plus-square"></i> Add Page</li>
                            </ol>

                            <?php
                            if(isset($_POST['submit'])){
                                $date = time();
                                $page_title = mysqli_real_escape_string($con, $_POST['page_title']);
                                $page_content =  mysqli_real_escape_string($con, $_POST['page_content']);
                                $page_type = $_POST['page_type'];
                                $page_image = $_FILES['page_image']['name'];
                                $tmp_name = $_FILES['page_image']['tmp_name'];
                                $page_status = $_POST['status'];
                                $page_name = str_replace(' ', '-', strtolower($page_title));
                                //$parent_menu = $_POST['parent_menu'];
                                $menu_level = $_POST['menu_level'];
                                $tags =  mysqli_real_escape_string($con, $_POST['tags']);

                                if(empty($page_title) or empty($page_content) or empty($page_type) or empty($page_image) or empty($tags)){
                                    $error = "All (*) fields are Required";
                                }
                                else {
                                    $insert_query = "INSERT INTO pages (page_date, page_author,page_title, page_content, page_type, page_image, page_status, page_name, menu_level, tags) VALUES ('$date','$session_username','$page_title','$page_content','$page_type','$page_image','$page_status','$page_name','$menu_level','$tags')";

                                    if(mysqli_query($con, $insert_query)){
                                        $msg = "Page has been Added.";
                                        $path = "img/$page_image";
                                        $page_content = "";
                                        $page_type = "";
                                        $tags = "";
                                        $page_status = "";
                                        $parent_menu = "";
                                        $menu_level = "";

                                        if(move_uploaded_file($tmp_name, $path)){
                                            copy($path, "../$path");
                                        }
                                    }
                                    else{
                                        $error = "Page has not been Added";
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

                                            <input type="text" name="page_title" placeholder="Type Post Title Here" value="<?php if(isset($page_title)){ echo $page_title;}?>" class="form-control">
                                        </div>
                                        <!--div class="form-group">
                                            <a href="media.php" class="btn btn-primary">Add Media</a>
                                        </div-->
                                        <div class="form-group">
                                            <label for="page_content">Page Content:*</label>
                                            <textarea name="page_content" id="textarea" class="form-control" cols="30" rows="10"><?php if(isset($page_content)){ echo $page_content; }?></textarea>
                                            <!--script>CKEDITOR.replace( 'page_data' );</script-->
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="file">Page Image:*</label>
                                                    <input type="file" name="page_image" >
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="page_status">Page-type:*</label>
                                                   <select class="form-control" name="page_type" id="page_type">
                                                       <option value="Service" <?php if(isset($page_type) and $page_type == 'services'){echo "selected"; }?>>Service</option>
                                                       <option value="Sub_Service" <?php if(isset($page_type) and $page_type == 'sub_services'){echo "selected"; }?>>Sub Service</option>
                                                       <option value="Industries" <?php if(isset($page_type) and $page_type == 'industries'){echo "selected"; }?>>Industries</option>
                                                       <option value="others" <?php if(isset($others) and $page_type == 'others'){echo "selected"; }?>>Others</option>
                                                       <option value="draft" <?php if(isset($status) and $status == 'draft'){echo "selected"; }?>>Draft</option>
                                                   </select>    
                                            </div>
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
                                        <div class="row">
                                         <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="menu_level">Menu display Level :*</label>
                                                   <select class="form-control" name="menu_level" id="menu_level">
                                                       <option value="0">0 - Main Menu bar</option>
                                                       <option value="1">1 - First Level Menu</option>
                                                       <option value="2">2 - Second Level Menu</option>
                                                       <option value="3">3 - Third Level Menu</option>

                                                   </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="tags">Tags:*</label>
                                                   <input type="text" name="tags" placeholder="Your Tags Here" value = "<?php if(isset($tags)){ echo $tags;}?>"class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="status">Status:*</label>
                                                   <select class="form-control" name="status" id="status">
                                                       <option value="publish" <?php if(isset($status) and $status == 'publish'){echo "selected"; }?>>Publish</option>
                                                       <option value="draft" <?php if(isset($status) and $status == 'draft'){echo "selected"; }?>>Draft</option>
                                                   </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                           <div class="col-sm-6">      
                                            <input type="submit" class = "btn btn-primary" value="Add Post" name="submit">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div id="submitDiv" class="postBox">
                                <div class="publishPageAction">
                                    <div class="heading">
                                        <h4 class="title"><i class="fa fa-eye" aria-hidden="true"></i> Publish</h4>
                                    </div>
                                     <input type="submit" class="btn btn-primary btn-md" name="save_draft" value="Save Draft" id="save_draft">
                                    <input type="submit" class="btn btn-primary btn-md pull-right" name="publish_page" value="Publish" id="publish_page">
                                   
                                    
                                    
                                </div>
                            </div>
                            <div id="pageParentDiv" class="postBox">

                            </div>
                            <div id="postImageDiv" class="postBox">

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php require_once('inc\footer.php'); ?>