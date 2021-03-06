<?php require_once('inc\top.php'); ?>
  </head>
  <body>
   <?php require_once('inc\header.php'); ?>
        
<?php
if(isset($_GET['post_id'])){
    $post_id = $_GET['post_id'];
    
    $views_query = "UPDATE `posts` SET `views` = views + 1 WHERE `posts`.`id` = $post_id";
    mysqli_query($con, $views_query);
    
    $query = "select * from posts where status = 'publish' and id = $post_id";
    $run = mysqli_query($con, $query);
    if(mysqli_num_rows($run) > 0){
        $row = mysqli_fetch_array($run);
        $id = $row['id'];
        $date = getDate($row['date']);
        $day = $date['mday'];
        $month = $date['month'];
        $year = $date['year'];
        $title = $row['title'];
        $image = $row['image'];
        $author_image = $row['author_image'];
        $author = $row['author'];
        $categories = $row['categories'];
        $post_data = $row['post_data'];
    }
    else{
        header('Location: index.php');
    }
}
?>
        
    <div class="jumbotron">
        <div class="container">
            <div id="details" class="animated fadeInLeft">
                <h1>Custom<span> Posts</span></h1>
                <p>Here you can put your own tagline to make it more attractive</p>
            </div>
        </div>
        <img src="img/top-image.jpg" alt="Top Image">
    </div>
    
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="post">
                        <div class="row">
                            <div class="col-md-2" post-date>
                                <div class="day"><?php echo $day; ?></div>
                                <div class="month"><?php echo $month; ?></div>
                                <div class="year"><?php echo $year; ?></div>
                            </div>
                            <div class="col-md-8" post-title>
                                <a href="post.php?post_id=<?php echo $id; ?>"><h2><?php echo $title; ?></h2></a>
                                <p>Written by: <span><?php echo ucfirst($author
); ?></span></p>
                            </div>
                            <div class="col-md-2" profile-picture>
                                <img src="img/<?php echo $author_image; ?>" alt="Profile Picture" class="img-circle">
                            </div>
                        </div>
                        <a href="img/<?php echo $image; ?>"><img src="img/<?php echo $image; ?>" alt="Post Image"></a>
                        <div class="desc">
                            <?php echo $post_data; ?>
                        </div>
                        
                        <div class="bottom">
                            <span class="first"><i class="fa fa-folder"></i><a href="#"> <?php echo ucfirst($categories); ?></a></span> |
                            <span class="sec"><i class="fa fa-comment"></i><a href="#">Comment</a></span>
                        </div>
                    </div>
                    
                    <div class="related-posts">
                       <h3>Related Posts</h3><hr>
                        <div class="row">
                           <?php 
                            $r_query = "select * from posts where status = 'publish' and title like '%$title%' limit 3";
                            $r_run = mysqli_query($con, $r_query);
                            while($r_row = mysqli_fetch_array($r_run)){
                                $r_id = $r_row['id'];
                                $r_title = $r_row['title'];
                                $r_image = $r_row['image'];
                        
                            ?> 
                            <div class="col-sm-4">
                                <a href="post.php?post_id=<?php echo $r_id; ?>">
                                    <img src="img/<?php echo $r_image; ?>" alt="Slider One">
                                    <h4><?php echo $r_title; ?></h4>
                                </a>
                            </div>
                           <?php
                                }
                            ?>
                        </div>
                        
                    </div>
                    
                    <div class="author">
                        <div class="row">
                            <div class="col-sm-3">
                                <img src="img/<?php echo $author_image; ?>" alt="Profile Image" class="img-circle">
                            </div>
                            <div class="col-sm-9">
                                <h4><?php echo ucfirst($author); ?></h4>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                            </div>
                        </div>
                    </div>
                    
                    <?php 
                        $c_query = "select * from comments where status = 'approve' and post_id = $post_id order by id desc";
                        $c_run = mysqli_query($con, $c_query);
                        if(mysqli_num_rows($c_run) > 0 ){
                    ?>
                    
                    <div class="comment">
                       <h3>Comments</h3>
                       
                       <?php
                        while($c_row = mysqli_fetch_array($c_run)){
                            $c_id = $c_row['id'];
                            $c_name = $c_row['name'];
                            $c_username = $c_row['username'];
                            $c_image = $c_row['image'];
                            $c_comment = $c_row['comment'];    
                        ?>
                       
                       <hr>
                        <div class="row single-comment">
                            <div class="col-sm-2">
                                <img src="img/<?php echo $c_image; ?>" alt="" class="img-circle">
                            </div>
                            <div class="col-sm-10">
                                <h4><?php echo ucfirst($c_name); ?></h4>
                                <p><?php echo $c_comment; ?></p>
                            </div>
                        </div>
                        <?php } ?>
                        
                    </div>
                    
                    <?php  } 
                    
                    if(isset($_POST['submit'])){
                        $cs_name = $_POST['name'];
                        $cs_email = $_POST['email'];
                        $cs_website = $_POST['website'];
                        $cs_comment = $_POST['comment'];
                        $cs_date = time();
                        if(empty($cs_name) or empty($cs_email) or empty($cs_comment)){
                            $error_msg = "All (*) fields are Required.";
                        }
                        else{
                            $cs_query = "INSERT INTO `comments` (`id`, `date`, `name`, `username`, `post_id`, `email`, `website`, `image`, `comment`, `status`) VALUES (NULL, '$cs_date', '$cs_name', 'user', '4', '$cs_email', '$cs_website', 'unknown.png', '$cs_comment', 'pending')";
                            if(mysqli_query($con, $cs_query)){
                                $msg = "Comment submited and waiting for Approval";
                             $cs_name = "";
                             $cs_email = "";
                             $cs_website = "";
                             $cs_comment = "";
                        }
                            else{
                                $error_msg = "Comments has not been submited";
                            }
                        }
                    }
                    
                    ?>
                    <div class="comment-box">
                        <div class="row">
                            <div class="col-xs-12">
                                <form action="" method="post">
                                    <div class="form-group">
                                        <label for="full-name">Full Name:*</label>
                                        <input type="text" id="full-name" name = "name" class="form-control" placeholder="Full Name" value="<?php if(isset($cs_name)) {echo $cs_name;} ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email Address:*</label>
                                        <input type="text" id="email" name = "email" class="form-control" placeholder="Email address" value="<?php if(isset($cs_email)) {echo $cs_email;} ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="website">Website:</label>
                                        <input type="text" id="website" name="website" class="form-control" placeholder="Website Url" value="<?php if(isset($cs_website)) {echo $cs_website;} ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="comment">Comment:*</label>
                                        <textarea id="comment" cols="30" rows="10" name="comment" placeholder="Your Comment should be here" class="form-control"><?php if(isset($cs_comment)) { echo $cs_comment;} ?></textarea>
                                    </div>
                                    <input type="submit" name="submit" class="btn btn-primary" value="Submit Comment">
                                    <?php 
                                    if(isset($error_msg)){
                                        echo "<span class='pull-right' style = 'color:red'>$error_msg</span>";
                                    }
                                    else if(isset($msg)){
                                        echo "<span class='pull-right' style = 'color:green'>$msg</span>";
                                    }
                                    
                                    ?>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                </div>

                <div class="col-md-4">
                    <?php require_once('inc\sidebar.php'); ?>
                </div>
            </div>
        </div>
    </section>
  <?php require_once('inc\footer.php');?>   
  