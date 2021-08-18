<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <script src="../angular/angular.min.js"></script>
  <style>
    .main {
      min-height: 500px;
    }
  </style>
  <title>Laptop Planet - Sell And Buy Laptop Is Now Easy</title>
</head>

<body>
  <?php include "partials/_dbconnect.php"; ?>
  <?php include "partials/_header.php"; ?>
  <?php
  echo '
        <div class="container my-3 main">
        <div class="row my-4">
        <!-- card is starting -->';
  $sql = "SELECT * FROM `laptop` WHERE `submitted`= true ";
  $result = mysqli_query($conn, $sql);
  $noresult = true;
  while ($row = mysqli_fetch_assoc($result)) {
    $noresult = False;
    $userid = $row['user_id'];
    $laptopid = $row['id'];
    $laptopname = $row['title'];
    $laptopdesc = $row['description'];
    echo '
      <div class="col-md-4 my-2">
      <div class="card " style="width: 20rem;">
        <img src="data:image/jpg;charset=utf8;base64,' . base64_encode($row["imgData"]) . '" class="card-img-top" alt="Image Not Found" height="200px" >
        <div class="card-body">
          <h5 class="card-title"><a href="laptopinfo.php?laptopid=' . $laptopid . '">' . $laptopname . '</a></h5>
          <p class="card-text">' . substr($laptopdesc, 0, 32) . '...</p>
          <a href="laptopinfo.php?laptopid=' . $laptopid . '" class="btn btn-primary">Offers</a>
        </div>
        </div>
      </div>';
  }
  echo '</div>';
  if ($noresult) {
    echo '
      <div class="container my-4">
      <div class="jumbotron text-center">
            <p class="lead"><b>No Laptop Found For Sell</b></p>
            <hr class="my-4">
            <div class="container">
            <p>please appriciate our website and try to sell first laptop in our website . <br> please stay connected with us so when a new laptop is arived we send you notification</p>
        </div>
        </div>
        </div>
      ';
  }

  echo '
     </div>';
  ?>




  <?php include "partials/_footer.php"; ?>


  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>


</body>

</html>