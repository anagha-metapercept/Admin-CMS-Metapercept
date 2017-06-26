<?php 
require_once('inc\top.php'); 
if(!isset($_SESSION["username"])){
    header('Location:login.php');
}

?>
  </head>
  <body id="profile">
      <div id="wrapper">
           <?php require_once('inc\header.php'); ?>
            <div class="container-fluid body-section">
                <div class="row">
                    <div class="col-md-3">.
                        <?php require_once('inc\sidebar.php');?>
                    </div>
                    <div class="col-md-9">
                        <h1><i class="fa fa-user"></i> Profile <small>Personal Details</small></h1><hr>
                        <ol class="breadcrumb">
                          <li><a href="index.php"><i class="fa fa-tachometer"></i> Dashboard</a></li>
                          <li class="active"><i class="fa fa-user"></i> Profile</li>
                        </ol>
                        
                        <div class="row">
                            <div class="col-xs-12">
                                <center><img src="img/profile-black.jpg" class="img-circle img-thumbnail" width="200px" alt="" id="profile-image"></center>
                                <br><br>
                                <a href="#" class="btn btn-primary pull-right">Edit Profile</a><hr>
                                <center>
                                    <h3>Profile Details</h3>
                                </center>
                                <br>
                                <table class="table table-bordered">
                                    <tr>
                                        <td width="20%"><b>User ID:</b></td>
                                        <td width="30%">12</td>
                                        <td width="20%"><b>Signup Date:</b></td>
                                        <td width="30%">12 Dec 15</td>
                                    </tr>
                                    <tr>
                                        <td width="20%"><b>First Name</b></td>
                                        <td width="30%">Anagha</td>
                                        <td width="20%"><b>Last Name:</b></td>
                                        <td width="30%">Deshpande</td>
                                    </tr>
                                    <tr>
                                        <td width="20%"><b>Username:</b></td>
                                        <td width="30%">anagha123</td>
                                        <td width="20%"><b>Email:</b></td>
                                        <td width="30%">anagha@gmail.com</td>
                                    </tr>
                                    <tr>
                                        <td width="20%"><b>Role:</b></td>
                                        <td width="30%">Admin</td>
                                        <td width="20%"><b></b></td>
                                        <td width="30%"></td>
                                    </tr>
                                </table>
                                <div class="row">
                                    <div class="col-lg-8 col-sm-12">
                                        <b>Details:</b>
                                        <div>Hello World..Hello World..Hello World..Hello World..Hello World..Hello World..Hello World..Hello World..Hello World..Hello World..Hello World..Hello World..Hello World..Hello World..Hello World..Hello World..Hello World..Hello World..Hello World..Hello World..Hello World..Hello World..Hello World..Hello World..Hello World..Hello World..Hello World..Hello World..Hello World..
                                        </div>
                                    </div>
                                </div>
                                <br>
                            </div>
                        </div>
                         
                    </div>
                </div>
            </div>

            <?php require_once('inc\footer.php'); ?>