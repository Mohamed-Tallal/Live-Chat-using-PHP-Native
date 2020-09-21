<?php

include 'include/sql.php'; 


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="images/images.png" />

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script> <title>log in </title>
  <style>
        body{
          background: url('images/pexels-photo-317355.jpg') no-repeat;
          background-size: cover;
        }
        #forget{
          border: none;
          background-color: #fff;
          color:#2E86C1;
        }
  </style>
</head>
<body>
<div class="container">
<div class="row">
  <div class="col-lg-3"></div>
  <div class="col-lg-6">
    <div class="card">
     <img height="330px" src="images/pexels-photo-292426.jpeg"> 
     <?php 
      if(isset($_POST['forget'])){
        $forget_email=$_POST['forget_email'];
        $forget_answer=$_POST['forget_answer'];
        if (empty($forget_email)) {
          echo "
  <div class='alert alert-danger'>
    <strong>If you want to change your password enter correct email</strong>
  </div>
  ";
      } elseif (empty($forget_answer)) {
          echo "
              <div class='alert alert-danger'>
                <strong>Enter your Secret answer</strong>
              </div>
              ";
      }else{
        $forget_user = "SELECT * from user_login where user_email ='$forget_email' AND forgotten_answer ='$forget_answer'";
        $forget_query = mysqli_query($connect,$forget_user);
        $user_forget = mysqli_num_rows($forget_query);
        if( $user_forget == 1 ){
          setcookie('user_email',$forget_email,time()+60*60*24);
          header("location:forget.php");

        }else{
          echo"<div class='alert alert-danger'>
          <strong>Your secret answer and email are not identical  </strong>
          </div>
          ";
        }
      }}
      

      if (isset($_POST['login'])) {
          $email = $_POST['user_email'];
          $pass = $_POST['user_pass'];
          if (empty($email)) {
              echo "
      <div class='alert alert-danger'>
        <strong>Enter your email</strong>
      </div>
      ";
          } elseif (empty($pass)) {
              echo "
      <div class='alert alert-danger'>
        <strong>Enter your password</strong>
      </div>
      ";
          }
           else {
        $select_user = "SELECT * from user_login where user_email ='$email' AND user_pass ='$pass'";

        $query = mysqli_query($connect, $select_user);

        $check_user = mysqli_num_rows($query);

        if ($check_user == 1) {
            $update ="UPDATE user_login SET statues ='online' WHERE user_email='$email'";
            $update_msg = mysqli_query($connect, $update );
            $get_user = "SELECT * FROM user_login where user_email='$email'";
            $run_user = mysqli_query($connect, $get_user);
            $row=mysqli_fetch_array($run_user);
            setcookie('user_email',$row['user_email'],time()+60*60*24);
            setcookie('cook',1,time()+60*60*24);

            echo "<script>window.open('index.php','_self')</script>";
        } else {
                    echo "
                        <div class='alert alert-danger'>
                          <strong>Check your email and password!</strong>
                        </div>
                        ";
                }
            }
        }
?> 
     <div class="card-body">
      <form action="login.php" method="POST">
        <div class="form-group">
          <label for="formGroupExampleInput">Email </label>
          <input type="email" class="form-control" id="formGroupExampleInput" name="user_email" placeholder="Example input placeholder">
        </div>
        <div class="form-group">
          <label for="formGroupExampleInput2">Password</label>
          <input type="password" class="form-control" id="formGroupExampleInput2" name="user_pass" placeholder="Another input placeholder">
        </div>
        <div class="form-group">
     
        <div class="form-group">
          <label for="formGroupExampleInput2" > If you don't have an account ? <a href="sign_up.php">Sign up</a> </label>
          
      </div>
      
      </div>
      <input type="submit" class="btn btn-outline-primary" value="Log in" name="login">
      <div class="form-group">
          <label for="formGroupExampleInput2" style="text-align: center;
          padding:15px 0px 0px 150px">Forget Password ?  </label>
     <button type="button" id="forget" data-toggle="modal" data-target=".bd-example-modal-lg">click here</button>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="card" >
                <div class="card-body">
                  <h5 class="card-title" >Forgot password</h5>
                  <hr>
                 
                  <form method="POST" action="login.php">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" name="forget_email" class="form-control" id="exampleInputEmail1" placeholder="Enter your email ">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1"> Secret answer</label>
                        <input type="text" name="forget_answer" class="form-control" id="exampleInputEmail1" placeholder="Enter your the secret answer ">
                      </div>
                      <input type="submit" class="btn btn-primary"  value="forgot password" name="forget">

                  </form>
                </div>
        </div>
    </div>
  </div>
</div>
    </div>
      </form>
      </div>

    </div>
  </div>
</div>
</div>


<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>