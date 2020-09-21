<?php 
session_start();
include "include/sql.php";
if($_COOKIE['cook']!=1){
  echo "<script>window.open('login.php','_self')</script>";
}
else{
    $email_cook = $_COOKIE['user_email'];
    $logout ="UPDATE user_login SET statues ='offline' WHERE user_email='$email_cook'";
    $logout_msg = mysqli_query($connect, $logout);
    if (isset($logout_msg)) {
    }
    if (isset($_COOKIE['user_email'])) {
        unset($_COOKIE['user_email']);
        unset($_COOKIE['cook']);
        setcookie('user_email', null, '/');
        setcookie('cook', -1, '/');

        echo "<script>window.open('login.php','_self')</script>";
        return true;
    } else {
        return false;
    }
}
?>