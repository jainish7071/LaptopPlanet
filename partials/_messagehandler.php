<!-- message handler -->
<?php
      include '_dbconnect.php';
      if($_SERVER['REQUEST_METHOD']=='POST'){
        session_start();
        $offer_id = $_GET['offerid'];
        $from_user_id = $_SESSION['userid'];
        $row_data = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM `offer` WHERE `id`='$offer_id'"));
        $to_user_id = $row_data['user_id'];
        $sent = true;
        $text_sent = $_POST['text'];
        $sql_sent = "INSERT INTO `messages`(`from_user_id`,`to_user_id`,`offer_id`,`sent`,`text`) VALUE ('$from_user_id','$to_user_id','$offer_id','$sent','$text_sent')"; 
        $result_sent = mysqli_query($conn,$sql_sent);
        $sent_success = $result_sent;
        // header("location: /LaptopPlanet/massages.php?Offer=".$offer_id."&&sent=".$sent_success." ");
      }
    ?>