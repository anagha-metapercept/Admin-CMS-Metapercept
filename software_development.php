<?php require_once('inc\top.php'); ?>
<?php
if(isset($_GET['service_id'])){
    $service_id = $_GET['service_id'];
    
    $query = "select * from services where id = $service_id";
    $run = mysqli_query($con, $query);
    if(mysqli_num_rows($run) > 0){
        $row = mysqli_fetch_array($run);
        $id = $row['id'];
        $date = getDate($row['date']);
        $day = $date['mday'];
        $month = $date['month'];
        $year = $date['year'];
        $service_name = $row['service_name'];
        $featured_image = $row['featured_image'];
        $tag_line = $row['tag_line'];
        $description = $row['description'];
        $status = $row['status'];
    }
    else{
        header('Location: index.php');
    }
}
?>
</head>
<body>
    <?php require_once('inc\header.php'); ?>
    <div class="main-container">
        <div class="jumbotron">
            <div class="container">
                <img class = "img-responsive" src = "media/<?php echo $featured_image; ?>" alt="Software Develoment" height="500px" width="100%">
                    <div id="content" class="animated fadeInLeft"> 
                        <h1><span><?php echo $service_name; ?> </span></h1>
                        <p><?php echo $tag_line; ?></p>
                    </div>
            </div>
        </div>
        <div class="container">
            <div class="description">
                <p><?php echo $description; ?></p>
            </div>
        </div>
    </div>
    <?php require_once('inc\footer.php');?>   