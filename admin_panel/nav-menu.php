<?php require_once('inc\top.php'); ?>
<?php
if(!isset($_SESSION['username'])){
    header('Location:login.php');
}
?>
<?php
    if(isset($_POST['create_menu'])){
        $menu_heading = mysqli_real_escape_string($con, $_POST['heading']);
        $query = "INSERT INTO menus (heading) VALUES ('$menu_heading')";
        mysqli_query($con, $query);
        //header('Location: nav-menu.php');
    }
?>

<?php
$session_username = $_SESSION['username'];
if(isset($_POST['add_menu'])){
    if(isset($_POST['checkboxes'])){
        foreach($_POST['checkboxes'] as $id){
           $menu_id = $id;
            $menu_heading = mysqli_real_escape_string($con, $_POST['heading1']);
            $query = "select page_title from pages where id=".$id;
            $run = mysqli_query($con, $query);
            if(mysqli_num_rows($run) > 0){
               while($row = mysqli_fetch_array($run)){
                    $page_title = $row['page_title'];
               }
            }
        //$update_query = "UPDATE `nav_menu` SET `menu_name` = '$page_title' WHERE `menu_heading` = '$menu_heading'";
        $insert_query = "INSERT INTO nav_menu (menu_heading, menu_name) VALUES ('$menu_heading', '$page_title')";
        mysqli_query($con, $insert_query);         
        }
    }
}
?> 
<?php
if(isset($_POST['add_menu'])){
   
}


?>

</head>
  <body>
      <div id="wrapper">
           <?php require_once('inc\header.php'); ?>

            <div class="container-fluid body-section">
                <div class="row">
                    <div class="col-md-2">.
                        <?php require_once('inc\sidebar.php'); ?>
                    </div>
                    <div class="col-md-10">
                       <form action="" method="post" enctype="multipart/form-data">
                        <h2><i class="fa fa-file"></i> Menus</h2><hr>
                          <!--Tab for Add Menu and Edit Menu-->	
                         <div id="exTab3" class="container">
                            <ul  class="nav nav-pills">
                                        <li class="tab active" id="create"><a  href="#1b" data-toggle="tab">Create New Menu</a>
                                        </li>
                                        <li class="tab" id="edit"><a href="#2b" data-toggle="tab">Edit Menu</a>
                                        </li>
                                    </ul>

                                        <div class="tab-content clearfix">
                                          <div class="tab-pane active" id="1b">
                                               <div class="row">
                                                   <div class="col-md-11">
                                                       <div class="menu_management">
                                                              <div class="menu_top">
                                                                  <label for="heading" style="padding:5px;"> Menu Heading : </label>
                                                                  <input type="text" style="padding:5px; margin:5px;" name="heading">
                                                                  <input type="submit" class="btn btn-primary pull-right" name="create_menu" value="Create Menu" style="margin:5px;">
                                                               </div>
                                                              
                                                               <div class="menu_body">
                                                                   <label for="heading" style="padding:5px;"><h4>Give your menu a name, then click Create Menu.</h4> </label>
                                                               </div>
                                                        </div>
                                                   </div>
                                               </div>
                                            </div>
                                            <div class="tab-pane" id="2b">
                                                <div class="manage_menu"><label for="heading">First select menu and Edit menu below</label></div>
                                                       <div class="col-md-3">
                                                           <div class="page-list" id="page_list">
                                                               <div class="bs-example">
                                                                    <div class="panel-group" id="accordion">
                                                                        <div class="panel panel-default">
                                                                            <div class="panel-heading">
                                                                                <h4 class="panel-title">
                                                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Pages</a>
                                                                                </h4>
                                                                            </div>
                                                                            <div id="collapseOne" class="panel-collapse collapse in">
                                                                                <div class="panel-body">
                                                                                 <?php
                                                                                  $query = "select * from pages order by id desc"; 
                                                                                $run = mysqli_query($con, $query);    
                                                                                 if(mysqli_num_rows($run) > 0){
                                                                                    while($row = mysqli_fetch_array($run)){
                                                                                    $id = $row['id'];
                                                                                    $page_title = $row['page_title'];
                                                                                ?>
                                                                             <input type="checkbox" class = "checkboxes" name="checkboxes[]" value= "<?php echo $id; ?>" >
                                                                             <input type="text" name="page_title1" id="page_title" value = "<?php echo $page_title; ?>" readonly>
                                                                                <br>
                                                                                <?php
                                                                                    }
                                                                                 }
                                                                                ?>    
                                                                               </div>
                                                                            </div>
                                                                        </div>
                                                                        <input type="checkbox" id="selectallboxes"><span> Select All</span>
                                                                        <input type="submit" id = "add_menu" class="btn btn-primary pull-right" name="add_menu" value="Add to Menu">
                                                                        <br>
                                                                     </div>
                                                               </div>  
                                                           </div>
                                                       </div>
                                                       <div class="col-md-9">
                                                           <div class="menu_management">

                                                                   <div class="menu_top">
                                                                      <label for="heading" style="padding:5px;"> Menu Name : </label>
                                                                      <input type="submit" class="btn btn-primary btn-md pull-right" name="save_menu" value="Save Menu">
                                                                      <select name="heading1" id="" class="heading1">
                                                                        <option value="--">--</option>
                                                                        <?php
                                                                         $menu_query = "SELECT * FROM `menus`"; 
                                                                         $menu_run = mysqli_query($con, $menu_query);    
                                                                         while($row = mysqli_fetch_array($menu_run)){
                                                                                $heading1 = $row['heading'];
                                                                        ?>
                                                                         
                                                                            <option value="<?php echo $heading1; ?>"><?php echo $heading1; ?></option>
                                                                        
                                                                       <?php
                                                                            }
                                                                         ?>
                                                                        </select>
                                                                        <input type="submit" id = "edit_menu" class="btn btn-primary" name="edit_menu" value="Edit Menu">
                                                                   </div>
                                                                   <div class="menu_body">
                                                                       <label for="heading" style="padding:5px;"><h4>Menu Structure </h4> </label>
                                                                        
                                                                          <?php
                                                                       if(isset($_POST['heading1'])){
                                                                        $heading = $_POST['heading1'];
                                                                         $query1 = "select * from nav_menu where menu_heading = '$heading'"; 
                                                                         $run1 = mysqli_query($con, $query1); 
                                                                            while($row1 = mysqli_fetch_array($run1)){
                                                                            $id = $row1['id'];
                                                                            $menu_name = $row1['menu_name'];
                                                                                echo "<li>". $row1['menu_name'] ."</li>";
                                                                            }
                                                                       }
                                                                       ?>
                                                                   </div>

                                                           </div>
                                                       </div>
                                                   
                                            </div>
                                    
                                        </div>
                              </div>
                              <!--Tab ends here-->
                       
                        </form>
                    </div>
                </div>
            </div>
      </div> 
      
      
<?php require_once('inc\footer.php'); ?>
