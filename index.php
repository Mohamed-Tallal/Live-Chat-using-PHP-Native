<?php
session_start();
include "include/sql.php";
if(@$_COOKIE['cook']!=1){
  echo "<script>window.open('login.php','_self')</script>";
}
else{
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">	
    <link rel="shortcut icon" href="images/images.png" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
   <link rel="stylesheet" href="css/main.css">
    <title>Main Page </title>
  <style>
   @media (max-width: 767px){
        #idbar{
          margin-bottom:20px
        }
      }
  
  </style>
</head>
<?php if (isset($_GET['chat'])) {
        $chat = $_GET['chat']; ?>
<body onload="main_page('<?php echo $chat?>')">
<?php
    } ?>
<div class="container">
    <div class="row" style="margin: 50px 0px">

                <!-------------Start frind nav  ---------------->

        <div class="col-lg-5" id='idbar'>
                <div class="card">
                        <div class="card-body">
                          
                        
                           <div class="friend-drawer">
                               <?php
                                $email_cook = $_COOKIE['user_email'];
    $user_main = "SELECT * FROM user_login WHERE user_email='$email_cook'";
    $run_main = mysqli_query($connect, $user_main);
    if (isset($run_main)) {
        $row_main = mysqli_fetch_array($run_main); ?>
                                <img class="profile-image" src="images/<?php echo $row_main['user_photo'] ?>" alt="Profile img">
                                    <div style="padding: 8px 0px 0px 18px">
                                        <h6><?php echo $row_main['user_first'].' ' .$row_main['user_last']?></h6>
                                        <p class="text-muted"><?php echo $row_main['user_descripe']?></p>
                                    </div>
                                 <span style="padding: 6px 0px 0px 80px; font-size:20px;"><a href="user.php" style="color:#000"><i class="fas fa-cog"></i></a></span>
                            </div>  
                              <?php
    } ?>
                         
                             
                            <hr>

         <!-------------Start Search about friend ---------------->

                           
         <!-------------End Search about friend ---------------->

         <!------------- Start friend chat  ---------------->
                           <div class="div_style">
                               <?php
                  $select_friend = "SELECT * FROM  friend WHERE friend_2='$email_cook'";
    $run_frind = mysqli_query($connect, $select_friend);
    $ah = array();
    $ah5 = array();
    $ah_photo =array();
    $ah_statues =array();
    $ah_name = array();
    $ah1 =-1;
    $ah2 =-1;
    $select_user = "SELECT * FROM user_login ";
    $run_user = mysqli_query($connect, $select_user);
            
    while ($row = mysqli_fetch_array($run_user)) {
        $ah5[]=$row['user_email'];
        $ah_photo[] = $row['user_photo'];
        $ah_statues[] =$row['statues'];
        $ah_name[]= $row['user_first'].' '.$row['user_last'];
        $ah2++;
    }
    while ($friend = mysqli_fetch_array($run_frind)) {
        $ah[]=$friend['friend_1'];
        $ah1++;
    }
    for ($i = 0 ;$i <=$ah1 ;$i++) {
        for ($a = 0 ;$a <=$ah2 ;$a++) {
            if ($ah5[$a] == $ah[$i]) {
                echo '
                                <div class="friend-drawer">
                            <a href="index.php?chat='.$ah5[$a].'" ><img class="profile-image" src="images/'.$ah_photo[$a].'" alt="Profile img"></a>
                                    <div style="padding: 8px 0px 0px 18px">
                                    <a href="index.php?chat='.$ah5[$a].'" style="color:#000;"> <h6>'.$ah_name[$a].'</h6> </a>';
                if ($ah_statues[$a] == 'online') {
                    echo ' <p class="text-muted"><span style="color: #3498DB;padding:5px;font-size:10px">
                                       <i class="fas fa-circle"></i>  </span>
                                      '.$ah_statues[$a].'</p>';
                } else {
                    echo ' <p class="text-muted">
                                           '.$ah_statues[$a].'</p>';
                }
                echo '
                                    </div>
                            </div> 
                            <hr>
                                
                                ';
            }
        }
    } ?>
                               
                          
                           </div> 
                        </div>
                </div>
        </div>
                 <!------------- End friend chat  ---------------->

            <!-------------End frind nav  ---------------->
        <!-------------Start chat contant  ---------------->

                    <div class="col-lg-7">
                        <div class="card">
                                <div class="card-body">
                                <?php
                                if (isset($_GET['chat'])) {
                                    $chat = $_GET['chat'];
                                    $select_chat = "SELECT * FROM user_login WHERE user_email ='$chat'";
                                    $run_chat = mysqli_query($connect, $select_user);
                                    while ($row_caht = mysqli_fetch_array($run_chat)) {
                                        if ($row_caht['user_email'] == $chat) {
                                            echo '<div class="friend-drawer">
                                        <img class="profile-image" src="images/'.$row_caht['user_photo'].'" alt="Profile img">
                                            <div style="padding: 8px 0px 0px 18px">
                                                <h6>'.$row_caht['user_first'].' '.$row_caht['user_last'].'</h6>
                                                <p class="text-muted">'.$row_caht['user_descripe'].'</p>
                                            </div>
                                    </div>';
                                        }
                                    }
                                } else {
                                    $user_main = "SELECT * FROM user_login WHERE user_email='$email_cook'";
                                    $run_main = mysqli_query($connect, $user_main);
                                    if (isset($run_main)) {
                                        $row_main = mysqli_fetch_array($run_main); ?>
                               <div class="friend-drawer">
                                <img class="profile-image" src="images/<?php echo $row_main['user_photo'] ?>" alt="Profile img">
                                    <div style="padding: 8px 0px 0px 18px">
                                        <h6><?php echo $row_main['user_first'].' ' .$row_main['user_last']?></h6>
                                        <p class="text-muted"><i class="far fa-comment-alt"></i></p>
                                    </div>
                            </div>  
                                </div>
                              <?php
                                    }
                                } ?>
                                    <hr>
                                    <div class="chat" id="chat_box">
                                     

                                 </div>
                            
                                            <!------------- Add massage  ---------------->
                                            <div class="row" style="padding-top: 20px">
                                                <div class="col-9">
                                                    <div class="form-group"  style="padding-left: 30px">
                                                        <textarea class="form-control" id="message" rows="2"></textarea>
                                                    </div>			  
                                                </div>
                                                    <div class="col-3" > 
                                                       <?php if (isset($_GET['chat'])) {
                                    $chat = $_GET['chat']; ?>
                                                        <button type="button" class="btn btn-primary" onclick="main_page('<?php echo $chat ?>')"><?php
                                } ?>
                                                        <i class="far fa-paper-plane" style="font-size: 15px; padding:0px 5px  "></i>Send  </button>
                                                    </div>
                                            </div>
                        </div>
                    </div> 

        <!-------------End chat contant  ---------------->

    </div>
</div>

<script>
    function main_page(chat){
        var main_pag =new XMLHttpRequest();
        var chatBox = document.getElementById('message').value;
        main_pag.onreadystatechange=function(){
            if (main_pag.readyState == 4 && main_pag.status == 200) {
                document.getElementById('chat_box').innerHTML=main_pag.responseText;
                document.getElementById('message').value='';
            }
        }
        main_pag.open('get','ajax.php?chat='+chat+'&&message='+chatBox,true);
        main_pag.send();
    }
</script>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
<?php
}
?>