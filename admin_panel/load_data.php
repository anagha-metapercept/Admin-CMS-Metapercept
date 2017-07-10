<?php
 require_once('inc\top.php');
   
    $menu_heading = $_POST['heading'];
    
    $query1 = "select * from nav_menu where menu_heading = '$menu_heading'"; 
    $query_run = mysqli_query($con, $query1); 
    while($row_data=mysqli_fetch_array($query_run)){
        $menu = $row_data['menu_name'];
        $menu_level = $row_data['menu_level']; 
           if($menu_level == '1'){
                $class = 'menu-item-depth-1';
                 echo "<li class='".$class."'>".$menu."</li>";
            }
            else if($menu_level == '2'){
                $class = 'menu-item-depth-2';
                 echo "<li class='".$class."'>".$menu."</li>";
            }
    }
    //}

?>