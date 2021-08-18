<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
 
    <title>Laptop Planet - Sell And Buy Laptop Is Now Easy</title>
  </head>
  <body>
  <?php include "partials/_dbconnect.php";
        include "partials/_header.php";
        $userid = $_SESSION['userid'];
        $sql = "SELECT * FROM `user` WHERE `id` = '$userid'";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($result);
        $username = $row['name'];
        $email = $row['email'];
        $location = $row['location'];
  

    echo'
    <div class="container d-flex justify-content-center"> 
    
    <div class="container alert alert-success d-flex justify-content-center " role="alert">
    <div class="container d-flex justify-content-center border border-dark my-3">
    
       <div class="form-group container">
       <h2>Your Profile</h2><br>
       <img src="img/default-user.jpg" alt="no image" width=100px height=100px ><br><br>
       <div class="border border-dark my-2">
       <h3 class="text-dark my-2 mx-2">Username</h3>
       <h4 class="text-dark my-2 mx-2">'.$username.'</h4>
       </div>
       <div class="border border-dark my-2">
       <h3 class="mb-0 text-dark my-2 mx-2">Email</h3>
      <h4 class="text-dark my-2 mx-2">'.$email.'</h4>
       </div>
      <div class="border border-dark my-2">
      <h3 class="mb-0 text-dark my-2 mx-2">Location</h3>
      <h4 class="text-dark my-2 mx-2">'.$location.'</h4>
      </div>
       </div>
      
      
    </div>
    </div>
    </div>';

    ?>

    <?php include "partials/_footer.php";?>
    

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

  
  </body>
</html>