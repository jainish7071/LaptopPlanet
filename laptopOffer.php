


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
   
    <title>Laptop Planet - Sell And Buy Laptop Is Now Easy</title>
  </head>
  <body>
  <?php include "partials/_dbconnect.php";?>
  <?php include "partials/_header.php";?>
  <?php
$showError = false;
if ($_GET['laptopsell']==true) {
    if ($_SERVER["REQUEST_METHOD"]=="POST") {
        include "partials/_dbconnect.php";
        $offer = $_POST['offer'];
        $submitted = ($_POST['Submit']=="on");
        $laptop_name = $_GET['laptop_name'];
        $_userid = $_SESSION['userid'];
        $sql = "SELECT `id` FROM `laptop` WHERE `title`='$laptop_name'";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($result);
        $laptop_id = $row['id'];
        $sql2 = "INSERT INTO `offer` (`user_id`,`laptop_id`,`offer`,`submitted`) VALUE 
        ('{$_userid}','{$laptop_id}','{$offer}','{$submitted}')";
        $result = mysqli_query($conn,$sql2);
        if($result){
            $showError = True;
        }
        else{
            $showError = "something went wrong ! please try again leter";
            header("location: /LaptopPlanet/index.php?laptopOffer=false&&error=$showError");
        }

    }
}
else{
$showError = "Please Upload File Again";
header("location: /LaptopPlanet/index.php?laptopOffer=false&&error=$showError");
}



?>
  <?php
    if ($showError==True) {
        echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
                    <strong>Success!</strong> you Succeessfully offered.You Can Add More.  
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
              </div>';
    }
  ?>
  <div class="container my-5"> 
  <div class="container my-3 py-3 border border-dark">
  <?php
  echo'
  <form action="' .$_SERVER['REQUEST_URI'].'" method="post">
    <div class="mb-3">
        <label for="Offer">Offer</label>
        <input type="text" class="form-control" name="offer" id="offer" aria-describedby="offer" required>
    </div>
    <div class="mb-3">
    <input type="radio" name="Submit" id="Submit"> Submitted
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    </form>';
  ?>
    </div> 
    </div>



  <?php include "partials/_footer.php";?>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    
  </body>
</html>