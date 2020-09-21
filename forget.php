<!DOCTYPE html>
<?php
session_start();
include "include/sql.php";
if($_COOKIE['cook']!=1){
  echo "<script>window.open('login.php','_self')</script>";
}
else{
    $dd =$_COOKIE['user_email']; ?>
<?php

 ?>
<html>
<head>
  <title>Forget Password</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
 
</head>
<style>
  
  #nav_style{
 margin-top: 80px;
  }
  #li_style{
    font-size: 18px;
  }
</style>
<body>
 
  <div class="container">
  
<div class="row" id="nav_style">
  <div class="col-sm-2">
  </div>
 
  <div class="col-sm-8">
    <form action="forget.php" method="post">
          <table class="table table-bordered table-hover">
            <tr align="center">
              <td colspan="6" class="active"><h2>Change Your Password </h2></td>
            </tr>

        
			<?php

if (isset($_POST['update'])) {
    $pass = $_POST['pass'];
    $confirm_pass =$_POST['confirm_pass'];
    if ($pass != $confirm_pass) {
        echo '<tr>';
        echo "
	     <div class='alert alert-danger'>
	          <strong>Your password not identical</strong>
	     </div>
	";
        echo '</tr>';
    } elseif (strlen($pass) <8) {
        echo '<div class="alert alert-danger" role="alert">';
        echo 'Password should be minimum 8 characters!';
        echo ' </div>';
    } else {
        $update="UPDATE user_login SET user_pass ='$pass' where user_email='$dd'";
        $run_update = mysqli_query($connect, $update);
        if (isset($run_update)) {
            echo "<script>window.open('login.php','_self')</script>";
        }
    }
} ?>
            

                <!-- Start Change First Name  -->
            <tr>
              <td style="font-weight: bold;"  id="li_style">Enter new password</td>
              <td>
              <input class="form-control" type="text" name="pass" required="required" />
              </td>
            </tr>
                        <!-- End Change First Name  -->

                        <!-- Start Change Last Name  -->

            <tr>
              <td style="font-weight: bold;" id="li_style">Confirm new password </td>
              <td>
              <input class="form-control" type="text" name="confirm_pass" required="required"/>
              </td>
            </tr>
                            <!-- End Change Last Name  -->

                            <!-- Start Change Picture  -->
           
            
            </tr>
                             <!-- End Change Descripe your Self  -->


                             

            <tr align="center">
              <td colspan="6">
              <input class="btn btn-info" style="width: 250px;" type="submit" name="update" value="Update"/>
              </td>
            </tr>
          </table>
        </form>

  </div>
  <div class="col-sm-2">

  </div></div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</body>
</html>

<?php
}?>