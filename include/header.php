<!DOCTYPE html>
<?php
session_start();
include "include/sql.php";

$email_cook = $_COOKIE['user_email'];


?>
<?php 

 ?>
<html>
<head>
  <title>Account Setting</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <link rel="shortcut icon" href="images/images.png" />

  <style>
    .friend-drawer {
      padding: 10px 15px;
      display: flex;
      vertical-align: baseline;
      transition: .3s ease;
      }

.profile-image {
      width: 65px;
      height: 65px;
     }
</style>  
</head>
<style>
  body{
    overflow-x: hidden;
  }
  #nav_style{
    background-color: #e3f2fd !important ;
     margin-bottom: 50px;padding-left:50px
  }
  #li_style{
    font-size: 18px;
  }
</style>
<body>
  <!-- Navbar content -->

  <nav class="navbar navbar-expand-lg navbar-light bg-light" id="nav_style" >
                      <div class="friend-drawer">
                      <?php 
                                $email_cook = $_COOKIE['user_email'];
                                   $user_main = "SELECT * FROM user_login WHERE user_email='$email_cook'";
                                   $run_main = mysqli_query($connect,$user_main);
                                   if(isset($run_main)){
                                       $row_main = mysqli_fetch_array($run_main);
                               ?>
                                <img class="profile-image" style="height: 50px;" src="images/<?php echo $row_main['user_photo'] ?>" alt="Profile img">
                                    <div style="padding: 15px 0px 0px 18px">
                                        <h6><?php echo $row_main['user_first'].' ' .$row_main['user_last']?></h6>
                                    </div>
                                 <span style="padding: 6px 0px 0px 80px; font-size:20px;"></span>
                            </div>  
                              <?php  
                                }
                               
                               ?>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Main <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="user.php">Account Settings</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="add_friend.php">Add Friend</a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link" href="logout.php">Log out</a>
      </li>
      
    </ul>
  </div>
</nav>
 
