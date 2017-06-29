  
<?php
$session_role1 = $_SESSION['role'];

$get_comment = "SELECT * FROM comments WHERE status = 'pending'";
$get_comment_run = mysqli_query($con, $get_comment);
$num_rows = mysqli_num_rows($get_comment_run);
?>
  
  <div class="list-group">
  <a href="index.php" class="list-group-item active">
     <i class="fa fa-tachometer"></i>
      Dashboard
  </a>
  <a href="pages.php" class="list-group-item"> 
      <i class="fa fa-file-text"></i> All Pages 
  </a>  
  <a href="posts.php" class="list-group-item"> 
      <i class="fa fa-file"></i> All Posts 
  </a>
   <a href="media.php" class="list-group-item">
      <i class="fa fa-database"></i> Media
  </a>
  <a href="services.php" class="list-group-item">
      <i class="fa fa-cog"></i> Services
  </a>
  
  <?php
      if($session_role1 == 'admin'){
      ?>
  <a href="#" class="list-group-item">
      <?php
      if($num_rows > 0){
          echo "<span class='badge'>$num_rows</span>";
      }
      ?>
      <i class="fa fa-comment"></i> Comments  
  </a>
  <a href="categories.php" class="list-group-item">
     
      <i class="fa fa-folder-open"></i> Categories  
  </a>
  <a href="users.php" class="list-group-item">
     
      <i class="fa fa-users"></i> Users
  </a>
  
  <?php 
      } 
      ?>
</div>