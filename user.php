<?php include 'include/header.php';
if($_COOKIE['cook']!=1){
  echo "<script>window.open('login.php','_self')</script>";
}
else{
    ?>
  <div class="container">
  
<div class="row">
  <div class="col-sm-2">
  </div>
 
  <div class="col-sm-8">
    <form action="user.php" method="post" enctype="multipart/form-data">
          <table class="table table-bordered table-hover">
            <tr align="center">
              <td colspan="6" class="active"><h2>Change Account Settings</h2></td>
            </tr>

            <?php

          // Start Update Card when click in button update

            if (isset($_POST['update'])) {
                $user_first = @$_POST['user_first'];
                $user_last = @$_POST['user_last'];
                $user_pass = @$_POST['user_pass'];
                $user_descripe = @$_POST['user_descripe'];
                $forgotten_answer = @$_POST['forgotten_answer'];
                $user_photo = @$_FILES['user_photo']['name'];
                $user_photo_tmp = @$_FILES['user_photo']['tmp_name'];
                move_uploaded_file($user_photo_tmp, "images/$user_photo");
                if (empty($user_photo)) {
                    $update="UPDATE user_login SET user_first='$user_first' ,
              user_last='$user_last' ,user_pass='$user_pass',user_descripe ='$user_descripe',
              forgotten_answer='$forgotten_answer' WHERE user_email = '$email_cook' ";
                    $run_update = mysqli_query($connect, $update);
                    if (isset($run_update)) {
                        echo '<div class="alert alert-primary" role="alert">
                A simple primary alert—check it out!
              </div>';
                    }
                } else {
                    $update="UPDATE user_login SET user_first='$user_first' ,user_photo ='$user_photo',
              user_last='$user_last' ,user_pass='$user_pass',user_descripe ='$user_descripe',
              forgotten_answer='$forgotten_answer' WHERE user_email = '$email_cook' ";
                    $run_update = mysqli_query($connect, $update);
                    if (isset($run_update)) {
                        echo '<div class="alert alert-primary" role="alert">
                A simple primary alert—check it out!
              </div>';
                    }
                }
            }

    // End Update Card when click in button update

    //Start Add Default Value into input

    $select_user = "SELECT * FROM  user_login WHERE user_email ='$email_cook'";
    $run_user = mysqli_query($connect, $select_user);
    if (isset($run_user)) {
        $row_user = mysqli_fetch_array($run_user)
            
            ?>

                <!-- Start Change First Name  -->
            <tr>
              <td style="font-weight: bold;">Change Your First Name </td>
              <td>
              <input class="form-control" type="text" name="user_first" required="required" value="<?php echo $row_user['user_first']?>"/>
              </td>
            </tr>
                        <!-- End Change First Name  -->

                        <!-- Start Change Last Name  -->

            <tr>
              <td style="font-weight: bold;">Change Your Last Name </td>
              <td>
              <input class="form-control" type="text" name="user_last" required="required" value="<?php echo $row_user['user_last']?>"/>
              </td>
            </tr>
                            <!-- End Change Last Name  -->

                            <!-- Start Change Picture  -->
            <tr>
              <td style="font-weight: bold;">Change Your Photo </td>
              <td>
              <input type="file" class="form-control-file file" id="exampleFormControlFile1" name="user_photo">
              </td>
            </tr>
                            <!-- End Change Picture  -->



                          <!-- Start Change Password  -->

            <tr>
              <td style="font-weight: bold;">Password</td>
              <td>
              <input class="form-control" type="text" name="user_pass" required="required" value="<?php echo $row_user['user_pass']?>"></td>
            </tr>
                            <!-- End Change Password  -->

                            <!-- Start Change Forgotten Password  -->

            <tr>
              <td style="font-weight: bold;">Forgotten Password </td>
              <td>
              <input class="form-control" type="text" name="forgotten_answer" required="required" value="<?php echo $row_user['forgotten_answer']?>"></td>
            </tr>
                            <!-- End Change Forgotten Password  -->

                            <!-- Start Change Descripe your Self  -->

            <tr>
              <td style="font-weight: bold;">Descripe your Self </td>
              <td>
              <div class="form-group">
                <textarea class="form-control" id="exampleFormControlTextarea1" name="user_descripe" rows="2"><?php echo $row_user['user_descripe']?></textarea>
             </div> 
              </td>
            </tr>
                             <!-- End Change Descripe your Self  -->


                             <?php

                            //End Add Default Value into input
    } ?>

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

                          <?php
}
                          include 'include/footer.php';?>
