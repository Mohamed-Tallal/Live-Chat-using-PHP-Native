<?php
session_start();
include "include/sql.php";
if($_COOKIE['cook']!=1){
  echo "<script>window.open('login.php','_self')</script>";
}
else{
    echo "<script>window.open('main.php','_self')</script>";
}
include 'include/sql.php';
$chat = $_REQUEST['chat'];
$message= $_REQUEST['message'];
$email_cook = $_COOKIE['user_email'];
if (!empty($chat)) {
    if (!empty($message)) {
        $insert_message = "INSERT INTO message(msg_content,msg_from,msg_to) VALUES('$message','$email_cook','$chat') ";
        $run_insert = mysqli_query($connect, $insert_message);
        if (isset($run_insert)) {
        }
    }
    $select_message = "SELECT * FROM message WHERE msg_from ='$chat' || msg_to = '$chat' ";
    $run_message = mysqli_query($connect, $select_message);
    while ($row_message = mysqli_fetch_array($run_message)) {
        if ($row_message['msg_from'] == $email_cook || $row_message['msg_to'] == $email_cook) {
            if ($row_message['msg_from'] == $chat && $row_message['msg_to'] == $email_cook) {
                echo '<div class="receiver">
            <p>'.$row_message['msg_content'].'</p>
         </div>';
            } elseif ($row_message['msg_from'] == $email_cook && $row_message['msg_to'] == $chat) {
                echo '<div class="sender">'.$row_message['msg_content'].'</div>';
            }
        }
    }
}
/* if ($row_message['msg_to'] == $chat && $row_message['msg_from'] == $email_cook) {
            echo '<div class="sender">'.$row_message['msg_content'].'</div>';
            
        }elseif ($row_message['msg_to'] == $email_cook && $row_message['msg_from'] == $chat) {
            echo '<div class="sender">'.$row_message['msg_content'].'</div>';
        } */


?>