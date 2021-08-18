
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="Style.css">
    <style>
     .main{
       min-height:500px;
     }
    </style>
    <title>Laptop Planet - Sell And Buy Laptop Is Now Easy</title>
  </head>
  <body>
  <?php include "partials/_dbconnect.php";?>
    <?php include "partials/_header.php";?>
    <!-- message handler -->
     <?php
      $sent_success = false;
      if($_SERVER['REQUEST_METHOD']=='POST'){
        $offer_id = $_GET['Offer'];
        $from_user_id = $_SESSION['userid'];
        if(isset($_GET['recieverid'])){
          $to_user_id = $_GET['recieverid'];
        }
        else{
        $row_data = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM `offer` WHERE `id`='$offer_id'"));
        $to_user_id = $row_data['user_id'];
        }
        $sent = true;
        $text_sent = $_POST['text'];
        $sql_sent = "INSERT INTO `messages`(`from_user_id`,`to_user_id`,`offer_id`,`sent`,`text`) VALUE ('$from_user_id','$to_user_id','$offer_id','$sent','$text_sent')"; 
        $result_sent = mysqli_query($conn,$sql_sent);
        $sent_success = $result_sent;
      }
     ?>
    
    <?php
      if($sent_success){
        echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
                <strong>Success!</strong> Your Massage Sent Successfully.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
              </div>';
      }
        echo"<div class='main'>";
        $messages_are_there = false;
        $offerid = $_GET['Offer'];
        $user_id_sender = $_SESSION['userid'];
        
        if(isset($_GET['recieverid'])){
          $user_id_receiver = $_GET['recieverid'];
        }
        else{
          $sql = "SELECT * FROM `offer` WHERE `id` = '$offerid'";
          $result = mysqli_query($conn,$sql);
          $row = mysqli_fetch_assoc($result);
          $user_id_receiver = $row['user_id'];
        }
        $row_data=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM `user` WHERE `id`='$user_id_receiver'"));
        $row_data2=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM `offer` WHERE `id`='$offerid'"));
        echo'
        <div class="container alert alert-dark " role="alert">
        <h1 class="text-light">'.$row_data["name"].'</h1>
        <h6 class="mb-0 text-light">'.$row_data2["offer"].'</h6>
        </div>
        ';
        
        $sql_message = "SELECT * FROM `messages` WHERE (`offer_id`='$offerid' AND (`from_user_id`='$user_id_receiver' OR`from_user_id`='$user_id_sender') AND (`to_user_id`='$user_id_receiver' OR `to_user_id`='$user_id_sender')) ORDER BY `time_stamp`";
        $result_message = mysqli_query($conn,$sql_message);
        while($row_message = mysqli_fetch_assoc($result_message)){
          $messages_are_there = true;
          $sender_id = $row_message['from_user_id'];
          $reciever_id = $row_message['to_user_id'];
          $text = $row_message['text'];
          $time = $row_message['time_stamp'];
          if($user_id_sender==$sender_id){
            echo'
              <div class="container1 darker  sender">
              <img src="img/default-user.jpg" alt="Avatar" class="right">
              <p>'.$text.'</p>
              <span class="time-left">'.$time.'</span>
              </div>
            ';
          }
          else{
            echo'
              <div class="container1  receiver">
              <img src="img/default-user.jpg" alt="Avatar">
              <p>'.$text.'</p>
              <span class="time-right">'.$time.'</span>
              </div>
            ';
          }

          }
        
        if(!$messages_are_there){
        echo'<div class="container">
        <div class="container alert alert-warning " role="alert">
        <h1 class="text-dark">No Conversation Is There</h1>
        <h6 class="mb-0 text-dark">Please Send Message To Start The Conversation</h6>
        </div>
        </div>';
        }
      
    echo'
    <form action="' .$_SERVER['REQUEST_URI'].' " method="post">
    <li class="list-inline-item massage send_massage">
      <input type="text" class="input" name="text" id="text" >
    </li>
    <li class="list-inline-item send_massage1">
      <button type="submit" class="btn btn-success">Send</button>
    </li>
    </form>';
    echo'</div>';
    ?>
    

    
   
    <?php include "partials/_footer.php";?>
    

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

  
  </body>
</html>