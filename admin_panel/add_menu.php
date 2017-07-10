<?php require_once('inc\top.php'); ?>
<?php
/*if(!isset($_SESSION['username'])){
    header('Location:login.php');
}*/
?>

<?php
//$session_username = $_SESSION['username'];
//if(isset($_POST['add_menu'])){
    //if(isset($_POST['checkboxes'])){
       
        foreach($_POST['checkboxes'] as $id){
           $menu_id = $id;
            $menu_heading = mysqli_real_escape_string($con, $_POST['heading']);
            $query = "select page_title from pages where id=".$id;
            $run = mysqli_query($con, $query);
             echo $insert_query;
            exit();
            if(mysqli_num_rows($run) > 0){
               while($row = mysqli_fetch_array($run)){
                    $page_title = $row['page_title'];
               }
            }
        //$update_query = "UPDATE `nav_menu` SET `menu_name` = '$page_title' WHERE `menu_heading` = '$menu_heading'";
        $insert_query = "INSERT INTO nav_menu (menu_heading, menu_name) VALUES ('$menu_heading', '$page_title')";
           
        mysqli_query($con, $insert_query);         
        }
    //}
//}
?> 