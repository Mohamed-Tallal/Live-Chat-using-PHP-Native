<?php
 include 'include/sql.php';
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/images.png" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="login.css">
    <title>Sign Up </title>
</head>
<body>
  <style>
    body{
      background: url('images/pexels-photo-317356.jpg') no-repeat;
      background-size: cover;
    }
   
   
.center{
  margin: 20px 0px 30px 0px;
}

.label_style{
font-size: 18px;
}
.file{
  font-size: 18px;
  border:1px solid #D5DBDB;
  border-radius: 5px;
}
  </style>
  
  <div class="container">
        <div class="row center">
        <div class="col-lg-2">
        </div>
              <div class="col-lg-8">
                <div class="card">
                  <img height="330px"  src="images/black-and-white-wooden-welcome-sign-3643925.jpg" class="card-img-top" alt="...">
                 <!--------------- Start to add data from form to DB ------------------->

                 <?php if(isset($_POST['sign_up'])){
                        $user_first = @$_POST['user_first'];
                        $user_last = @$_POST['user_last'];
                        $user_email = @$_POST['user_email'];
                        $user_pass = @$_POST['user_pass'];
                        $confirm_pass = @$_POST['confirm_pass'];
                        $user_photo = @$_FILES['user_photo']['name'];
                        $user_photo_tmp = @$_FILES['user_photo'] ['tmp_name'];
                        move_uploaded_file($user_photo_tmp,"images/$user_photo");

                        // check if user dose not enter all informatio 

                        if(empty($user_first) || empty($user_pass) || empty($user_email) || empty($user_photo)){
                          echo '<div class="alert alert-danger" role="alert">
                                 Enter all information .
                                </div>';
                        }

                          // check if confirm password like password
                        
                        else{
                        if($user_pass != $confirm_pass ){
                          echo '<div class="alert alert-danger" role="alert">';
                          echo 'Your password does not match';
                          echo ' </div>';
                        }

                        // check if password less than 8 char

                        else if(strlen($user_pass) <8){
                          echo '<div class="alert alert-danger" role="alert">';
                          echo 'Password should be minimum 8 characters!';
                          echo ' </div>';
                        }

                        // check email not in database
                        
                        else{
                          $test = "SELECT * FROM user_login WHERE user_email = '$user_email'";
                          $run_test = mysqli_query($connect,$test);
                          $test_uniqe = mysqli_num_rows($run_test);
                          if($test_uniqe == 1){
                            echo '<div class="alert alert-danger" role="alert">';
                            echo 'This is email is already exist, try anther one . ';
                            echo ' </div>';
                          }
                          
                          // insert value in database

                          else{
                            $insert = "INSERT INTO user_login (user_first,user_last, user_email ,user_pass ,user_photo) 
                            VALUES ('$user_first' ,'$user_last' ,'$user_email' ,'$user_pass','$user_photo')";
                            $run_insert = mysqli_query($connect,$insert);
                            if(isset($run_insert)){
                              echo "<script>alert('Hi $user_first $user_last, your account has been created successfully.')</script>";
                            	echo "<script>window.open('login.php','_self')</script>";
                    
                            }
                          }

                        }
                      }
                    }
                  
                  ?>
                     <!--------------- End to add data from form to DB ------------------->
                  
                  <div class="card-body">
                    <form class="form_style" action="sign_up.php" method="post" enctype="multipart/form-data">
                       <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="inputEmail4" class="label_style">First Name</label>
                            <input type="text" class="form-control" placeholder="First Name" id="inputEmail4" name="user_first">
                          </div>
                          <div class="form-group col-md-6">
                            <label for="inputPassword4" class="label_style">Last Name</label>
                            <input type="text" class="form-control" placeholder="Last Name" id="inputPassword4" name="user_last">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="inputAddress" class="label_style">Email</label>
                          <input type="email" class="form-control" id="inputAddress" placeholder="Enter your email" name="user_email">
                        </div>
                        <div class="form-group">
                          <label for="exampleFormControlFile1" class="label_style">Photo</label>
                          <input type="file" class="form-control-file file" id="exampleFormControlFile1" name="user_photo" placeholder="Enter your photo">
                        </div>
                        <div class="form-group">
                          <label for="inputAddress2" class="label_style">Password</label>
                          <input type="password" class="form-control" id="inputAddress2" name="user_pass" placeholder="Enter your password">
                        </div>
                        <div class="form-group">
                          <label for="inputAddress2" class="label_style">Confirm Password</label>
                          <input type="password" class="form-control" id="inputAddress2" name="confirm_pass" placeholder="Enter your password">
                        </div>
                        <div class="form-group">
                          
                            <label for="inputAddress2">
                              Do you have account ? <a href="login.php" >Log in</a>
                            </label>
                          
                        </div>
                        <input type="submit" value="Sign Up" class="btn btn-outline-primary" name="sign_up">
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