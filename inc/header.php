
 <nav class="navbar navbar-inverse navbar-fixed navbar-fixed-top">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">
          <div class="col-xs-4"><img src="img/Logo1.png" class="img-responsive" alt="logo" width="80%" height="80%"></div>
          <div class="col-xs-8"></div>
      </a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="index.php"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-list-alt" aria-hidden="true"></i> Services <span class="caret"></span></a>
          <ul class="dropdown-menu">
           <?php
              $query = "select * from services order by id DESC";
              $run = mysqli_query($con, $query);
              if(mysqli_num_rows($run) > 0){
                  while($row = mysqli_fetch_array($run)){
                      $service = ucfirst($row['service_name']);
                      $id= $row['id'];
                      echo "<li><a href='software_development.php?service_id=".$id."'>$service</a></li>";
                  }
              }
              else{
                  echo "<li><a href='#'>No Services yet</a></li>";
              }
              ?>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-list-alt" aria-hidden="true"></i> Categories <span class="caret"></span></a>
          <ul class="dropdown-menu">
           <?php
              $query = "select * from catagories order by id DESC";
              $run = mysqli_query($con, $query);
              if(mysqli_num_rows($run) > 0){
                  while($row = mysqli_fetch_array($run)){
                      $category = ucfirst($row['catagory']);
                      $id= $row['id'];
                      echo "<li><a href='index.php?cat=".$id."'>$category</a></li>";
                  }
              }
              else{
                  echo "<li><a href='#'>No categories yet</a></li>";
              }
              ?>
          </ul>
        </li>
        <li><a href="contact-us.php"><i class="fa fa-phone" aria-hidden="true"></i> Contact Us</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
