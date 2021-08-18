<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="Style.css">
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-46156385-1', 'cssscript.com');
      ga('send', 'pageview');
    </script>
    <title>Laptop Planet - Sell And Buy Laptop Is Now Easy</title>
  </head>
  <body>
  <?php include "partials/_dbconnect.php";?>
    <?php include "partials/_header.php";?>
    <!-- handling rating posting -->
    <?php
      $review_submit = false;
        if($_SERVER['REQUEST_METHOD'] == 'POST' ){
            $review  = $_POST['review'];
            $star = $_POST['star'];
            $user_id = $_SESSION['userid'];
            $laptopid = $_GET['laptopid'];
            $sql_review = "INSERT INTO `reviews` (`review`,`star`,`user_id`,`laptop_id`) VALUE ('$review','$star','$user_id','$laptopid')";
            $result_review = mysqli_query($conn,$sql_review);
            $review_submit = $result_review;
        }
        if($review_submit){
          echo'<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
                <strong>Success!</strong> Your Review Has been Recorded.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
              </div>';
        }
    ?>
    <?php
     $Loggedin  = false;
     if(isset($_SESSION['loggedin'])&&$_SESSION['loggedin']){
        $Loggedin = true;
     }
     else{
       $Loggedin = false;
     }
    $laptopid = $_GET['laptopid'];
    $sql = " SELECT * FROM `laptop` WHERE `id` = '$laptopid' ";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    $laptop_name = $row['title'];
    $laptop_desc = $row['description'];
    $laptop_user_id = $row['user_id'];
    echo'
    <div class="container my-4">
        <div class="jumbotron text-center">
            <div class="d-flex justify-content-center">
               <img src="data:image/jpg;charset=utf8;base64,'.base64_encode($row["imgData"]).'" class="rounded" alt="No Image Found" width=350px>
            </div>
            <p class="lead"><b>'.$laptop_name.'</b></p>
            <p>'.$laptop_desc.'</p>
            <hr class="my-4">';
    if($Loggedin){
      if($laptop_user_id != $_SESSION['userid']){
            echo'   <form action="massages.php">';//method="post"
            $sql2 = "SELECT * FROM `offer` WHERE `laptop_id` = '$laptopid'";
            $result2 = mysqli_query($conn,$sql2);
                while($row2 = mysqli_fetch_assoc($result2)){
                  $offer = $row2['offer'];
                  $offer_id = $row2['id'];
                echo'   <input type="radio" name="Offer" id="'.$offer_id.'" class="mb-3" value="'.$offer_id.'" >&nbsp;&nbsp; '.$offer.'<br>';
                }
                echo'   <button type="submit" class="btn btn-success my-3">Send Massege</button>
                        </form>'; 
      }
      else{
        echo'<p><b><i> "You Can Chat about your laptop from conversation"</i></b></p>';
      }
    }
    else{
    echo' <div class="container">
          <div class="container alert alert-warning " role="alert">
          <h1 class="text-dark">Fill Form To Get Offer</h1>
          <h6 class="mb-0 text-dark">you are not logged in! For fill form you need to logged in.</h6>
          </div>
          </div>';
    }
    $sql3 = "SELECT * FROM `reviews` WHERE `laptop_id` = '$laptopid'";
    $result3 = mysqli_query($conn,$sql3);
    (int)$sum_star = (int) 0;
    $number_rating = mysqli_num_rows($result3);
    while($row3 = mysqli_fetch_assoc($result3)){
      $star_rating  = $row3['star'];
      (int)$sum_star += (int)$star_rating ;
    }
    echo'</div>';  
    if($number_rating>0){
       $rating = $sum_star/$number_rating;
       echo'
            <h4>Rating : '.$rating.'<span class="fa fa-star checked"></span></h4>
            </div>';
    }
    else{
    echo' </div>
        <h4>Rating : No One Rated Yet Please Give Us Rating About It</h4>
    </div>';
    }
    $user_id = $_SESSION['userid'];
    $row_for_review_handle = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `reviews` WHERE (`laptop_id`='$laptopid' AND `user_id` = '$user_id')" ));
    if($row_for_review_handle == 1){
      $review_submit = true;
    }
    if(($Loggedin)&&($review_submit!=true)){
    echo'
    <div class="container">';;
    echo'
    <div class="container border border-dark my-2 bg-light">
     <form action="'.$_SERVER['REQUEST_URI'].'" method="post">
        <div class="stars my-2">
            <label for="Star" class="my-3"> <h3>Give Star :</h3></label> 
            <input class="star star-5" id="star-5-2" type="radio" name="star" value="5"/>
            <label class="star star-5" for="star-5-2"></label>
            <input class="star star-4" id="star-4-2" type="radio" name="star" value="4"/>
            <label class="star star-4" for="star-4-2"></label>
            <input class="star star-3" id="star-3-2" type="radio" name="star" value="3"/>
            <label class="star star-3" for="star-3-2"></label>
            <input class="star star-2" id="star-2-2" type="radio" name="star" value="2"/>
            <label class="star star-2" for="star-2-2"></label>
            <input class="star star-1" id="star-1-2" type="radio" name="star" value="1"/>
            <label class="star star-1" for="star-1-2"></label>
        </div>
        <br>
        <label for="Review" class="mb-2"><h3> Write A Review :</h3></label>
        <textarea name="review" id="review" cols="30" rows="1" class="w-100 my-2"></textarea>
        <button type="submit" class="btn btn-success my-2">Submit</button>
     </form>
    </div>';
    }
    echo'
    <div class="container border border-dark bg-warning">
    <h2 class="text-center">Reviews</h2>
    </div>';
    echo'</div>';
    if($number_rating>0){
      $sql_review_list = "SELECT * FROM `reviews` WHERE `laptop_id` = '$laptopid'";
      $result_review_list = mysqli_query($conn,$sql_review_list);
    while($row_review_list = mysqli_fetch_assoc($result_review_list)){
      $user_id = $row_review_list['user_id'];
      $sql4 = "SELECT `name` FROM `user` WHERE `id` = '$user_id'";
      $result4 = mysqli_query($conn,$sql4);
      $row4 = mysqli_fetch_assoc($result4);
      echo'
      <div class="media my-4 container">
          <img src="img/default-user.jpg" width="60px" class="mr-3" alt="No image">
          <div class="media-body">                
          <h5 class="mt-0"><a class="text-dark">'.$row4['name'].'</a></h5>
          '.$row_review_list["review"].'
          </div>
          <div class="font-weight-bold my-0"></div>
      </div>';
    }
    }
  else{
     echo'
     <div class="container">
     <div class="container alert alert-warning" role="alert">
     <h1 class="text-dark text-center">No Reviews Find</h1>
     </div>
     </div>
     ';
  }
    ?>

    <?php include "partials/_footer.php";?>
    

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

  
  </body>
</html>