<?php 
require_once('inc\top.php'); 
if(!isset($_SESSION["username"])){
    header('Location:login.php');
}

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
                        <h1><i class="fa fa-plus-square"></i> Add Posts <small>Add New post</small></h1><hr>
                        <ol class="breadcrumb">
                          <li><a href="index.html"><i class="fa fa-tachometer"></i> Dashboard</a></li>
                          <li class="active"><i class="fa fa-plus-square"></i> Add Post</li>
                        </ol>
                
                        <div class="row">
                            <div class="col-xs-12">
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="title">Title:*</label>
                                        <input type="text" name="title" placeholder="Type Post Title Here" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <a href="media.php" class="btn btn-primary">Add Media</a>
                                    </div>
                                    <div class="form-group">
                                        <textarea name="post-data" id="textarea" class="form-control" cols="30" rows="10"></textarea>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="file">Post Image:*</label>
                                                <input type="file" name="image" >
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="categories">Categories:*</label>
                                               <select class="form-control" name="categories" id="categories">
                                                   <option value="">Cat1</option>
                                                   <option value="">Cat2</option>
                                               </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="tags">Tags:*</label>
                                               <input type="text" name="tags" placeholder="Your Tags Here" class="form-control">
                                            </div>
                                        </div>
                                         <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="status">Status:*</label>
                                               <select class="form-control" name="status" id="status">
                                                   <option value="publish">Publish</option>
                                                   <option value="draft">Draft</option>
                                               </select>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php require_once('inc\footer.php'); ?>