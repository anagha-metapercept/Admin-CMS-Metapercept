<?php require_once('inc\top.php'); ?>
  </head>
  <body>
      <div id="wrapper">
           <?php require_once('inc\header.php'); ?>

            <div class="container-fluid body-section">
                <div class="row">
                    <div class="col-md-3">.
                        <?php require_once('inc\sidebar.php'); ?>
                    </div>
                    <div class="col-md-9">
                        <h1><i class="fa fa-users"></i> Users    <small>View All Users</small></h1><hr>
                        <ol class="breadcrumb">
                          <li><a href="index.html"><i class="fa fa-tachometer"></i>Dashboard</a></li>
                          <li class="active"><i class="fa fa-users"></i>Users</li>
                        </ol>
                        
                        <?php $query = "select * from users order by id desc"; 
                        $run = mysqli_query($con, $query);
                        if(mysqli_num_rows($run) > 0){
                        ?>
                        
                        <div class="row">
                            <div class="col-sm-8">
                                <form action="">
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <div class="form-group">
                                                <select name="" id="" class="form-control">
                                                    <option value="delete">Delete</option>
                                                    <option value="author">Change to Author</option>
                                                    <option value="admin">Change to Admin</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xs-8">
                                            <input type="submit" class="btn btn-success" value="Apply">
                                            <a href="#" class="btn btn-primary">Add New</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th><input type="checkbox"></th>
                                    <th>Sr.No</th>
                                    <th>Date</th>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Image</th>
                                    <th>Password</th>
                                    <th>Role</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                               <?php 
                                while($row = mysqli_fetch_array($run)){
                                    $id = $row['id'];
                                    $first_name = ucfirst($row['first_name']);
                                    $last_name = ucfirst($row['last_name']);
                                    $email = $row['email'];
                                    $username = $row['username'];
                                    $role = $row['role'];
                                    $image = $row['image'];
                                    $date = getDate($row['date']);
                                    $day = $date['mday'];
                                    $month = substr($date['month'],0,3);
                                    $year = $date['year'];
                   
                                ?>
                               
                                <tr>
                                    <td><input type="checkbox"></td>
                                    <td><?php echo $id; ?></td>
                                    <td><?php echo "$day $month $year"; ?></td>
                                    <td><?php echo "$first_name $last_name"; ?></td>
                                    <td><?php echo $username; ?></td>
                                    <td><?php echo $email; ?></td>
                                    <td><img src="img/<?php echo $image; ?>" width="30px"></td>
                                    <td><?php echo "*******"; ?></td>
                                    <td><?php echo $role; ?></td>
                                    <td><a href="add-user.php?edit=<?php echo $id; ?>"><i class="fa fa-pencil"></i></a></td>
                                    <td><a href="users.php?del=<?php echo $id; ?>"><i class="fa fa-times"></i></a></td>
                                </tr>
                                <?php                  
                                }
                                ?>
                            </tbody>
                        </table>
                        <?php
                             }
                        else{
                            echo "<center><h2>No Users available Now.</h2></center>";
                        }
                        ?>
                    </div>
                </div>
            </div>

            <?php require_once('inc\footer.php'); ?>