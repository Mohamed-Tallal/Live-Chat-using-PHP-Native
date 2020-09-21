<?php include 'include/header.php';
if($_COOKIE['cook']!=1){
  echo "<script>window.open('login.php','_self')</script>";
}
else{
    ?>
    <div class="container">
        
        <div class="row div_style" id="add_friend">
            <?php 
                       
            // start show user of application

                  $select_user = "SELECT * FROM user_login WHERE user_email != '$email_cook' ORDER BY user_id DESC";
                  $run_user = mysqli_query($connect, $select_user);
                 
                          while ($row = mysqli_fetch_array($run_user)) {
                                  echo '<div class="col-md-4 card_style" >
                                            <div class="card">
                                            <img src="images/'.$row['user_photo'].' "height="200px">
                                            <div class="card-body">
                                              <h5 class="card-title" style="text-align: center">'. $row['user_first'].' '.$row['user_last'].'</h5>
                                              <p class="card-text" style="text-align: center">'.$row['user_descripe'].'</p>
                                              <a href ="add_friend.php?add_NewFriend='.$row['user_email'].'" class="btn btn-primary" style="margin-left:100px">Add friend</a>
                                              </div>
                                            </div>
                                          </div>';
                              
                          }
                        
                         
            ?>
            
        </div>  
    </div>

    <!----- Start add friend  ---->
        <?php 
        if (isset($_GET['add_NewFriend'])) {
            $add_NewFriend =$_GET['add_NewFriend'];
            $select_friend = "SELECT * FROM  friend WHERE frind_send = '$add_NewFriend' && friend_2 = '$email_cook'";
            $run_frind = mysqli_query($connect, $select_friend); 
                $test_uniqe = mysqli_num_rows($run_frind);
                if ($test_uniqe == 1) {
                    echo "<script>window.open('add_friend.php','_self')</script>";
                } else {
                    $Send_request = "INSERT INTO friend(friend_1,friend_2,request,frind_send) 
                    VALUES ('$add_NewFriend','$email_cook','1','$add_NewFriend')";
                    $run_request =mysqli_query($connect, $Send_request);
                    if (isset($run_request)) {
                        echo "<script>window.open('add_friend.php','_self')</script>";
                    }
                }
            }
        

        ?>

            
    <!----- End add friend  ---->


     

    <?php
}
                          include 'include/footer.php';?>
