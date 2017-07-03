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
                        <h1><i class="fa fa-cog"></i> Add Services <small> Add New Service</small></h1><hr>
                        <ol class="breadcrumb">
                          <li><a href="index.html"><i class="fa fa-tachometer"></i> Dashboard</a></li>
                          <li class="active"><i class="fa fa-cog"></i> Add Service</li>
                        </ol>
                        
                        <?php
                        if(isset($_POST['submit'])){
                            $date = time();
                            $service_name = mysqli_real_escape_string($con, $_POST['service_name']);
                            $description =  mysqli_real_escape_string($con, $_POST['description']);
                            $tag_line =  mysqli_real_escape_string($con, $_POST['tag_line']);
                            $status = $_POST['status'];
                            $featured_image = $_FILES['featured_image']['name'];
                            $tmp_image = $_FILES['featured_image']['tmp_name'];
                            
                            if(empty($service_name) or empty($description) or empty($tag_line) or empty($featured_image)){
                                $error = "All (*) fields are Required";
                            }
                            else {
                                $insert_query = "INSERT INTO services (date, service_name, featured_image, tag_line, description, status) VALUES ('$date','$service_name','$featured_image','$tag_line','$description','$status')";
                                
                                if(mysqli_query($con, $insert_query)){
                                    $msg = "Service has been Added.";
                                    $path = "media/$featured_image";
                                    $service_name = "";
                                    $description =  "";
                                    $tag_line =  "";
                                    $status = "";
                                   
                                    if(move_uploaded_file($tmp_image, $path)){
                                        copy($path, "../$path");
                                    }
                                }
                                else{
                                    $error = "Service has not been Added";
                                }
                            }
                        }
                        ?>
                        
                        <div class="row">
                            <div class="col-xs-12">
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="Service Name">Service Name:*</label>
                                        <?php
                                            if(isset($msg)){
                                                echo "<span class='pull-right' style='color:green;'>$msg</span>";
                                            }
                                            else if(isset($error)){
                                                echo "<span class='pull-right' style='color:red;'>$error</span>";
                                            }
                                        ?>
                                        
                                        <input type="text" name="service_name" placeholder="Type Service Name Here" value="<?php if(isset($service_name)){ echo $service_name;}?>" class="form-control">
                                    </div>
                                     <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="tag_line">Tag Line:*</label>
                                               <input type="text" name="tag_line" placeholder="Enter Tag Line Here" value = "<?php if(isset($tag_line)){ echo $tag_line;}?>"class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <!--div class="form-group">
                                        <a href="media.php" class="btn btn-primary">Add Media</a>
                                    </div-->
                                    <div class="form-group">
                                        <textarea name="description" id="textarea" class="form-control" cols="30" rows="10"><?php if(isset($description)){ echo $description; }?></textarea>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="file">Featured Image:*</label>
                                                <input type="file" name="featured_image" >
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
                                        <div class="col-sm-6">
                                            <input type="submit" class = "btn btn-primary" value="Add Service" name="submit">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php require_once('inc\footer.php'); ?>