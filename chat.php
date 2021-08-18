<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
     <style>
     .img{
        vertical-align: top;
        margin-top:10px;
     }
     .main{
       min-height:500px;
     }
     </style>
    <title>Laptop Planet - Sell And Buy Laptop Is Now Easy</title>
  </head>
  <body>
  <?php include "partials/_dbconnect.php";?>
  <?php include "partials/_header.php";
  echo'<div class="main">';
  $to_user_id = $_SESSION['userid'];
  $sql = "SELECT DISTINCT `offer_id`,`from_user_id` FROM `messages` WHERE `to_user_id` ='$to_user_id' ORDER BY `time_stamp` DESC";
  $result = mysqli_query($conn,$sql);
  $no_chat_is_their = true;
  while($row = mysqli_fetch_assoc($result)){
    $no_chat_is_their = FALSE;
    $sender_id = $row['from_user_id'];
    $offer_id = $row['offer_id'];
    $row_sender_name = mysqli_fetch_assoc(mysqli_query($conn,"SELECT `name` FROM `user` WHERE `id` = '$sender_id'"));
    $row_offer = mysqli_fetch_assoc(mysqli_query($conn,"SELECT `offer` FROM `offer` WHERE `id` = '$offer_id'"));
    $sender_name = $row_sender_name['name'];
    $offer_name = $row_offer['offer'];
  echo'
  <div class="container my-3">
  <a href="massages.php?Offer='.$offer_id.'&&recieverid='.$sender_id.'" style="text-decoration:none">
      <div class="container alert alert-success " role="alert">
      <img src="img/default-user.jpg" alt="no image" width=40px height=40px class="list-inline-item border border-dark img rounded-circle">
      <h1 class="text-dark list-inline-item">'.$sender_name.'</h1>
      <h6 class="mb-0 text-dark list-inline-item "> OFFER ---> '.$offer_name.'</h6>
      </div>
  </a>
  </div>';
  }
  if($no_chat_is_their){
    echo '
    <div class="jumbotron jumbotron-fluid my-5 main">
    <div class="container">
      <h1 class="display-4">No Conversation Yet</h1>
      <hr>
      <p class="lead"><b>Please connect with us to start chat</b></p>
    </div>
    </div>
    ';
  }
  echo'</div>';
  ?>


  <?php include "partials/_footer.php";?>
    

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

  
  </body>
</html>