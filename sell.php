<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <style>
     .main{
       min-height:500px;
     }
    </style>
    <title>Laptop Planet - Sell And Buy Laptop Is Now Easy</title>
  </head>
  <body>
  <?php include "partials/_dbconnect.php";
        include "partials/_header.php";
        if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD']=='POST'){
          $laptopid = $_POST['laptopid'];
          $submitted = false;
          $sql = "UPDATE `laptop` SET `submitted`= '$submitted' WHERE `id`='$laptopid' ";
          $result = mysqli_query($conn,$sql);
          if($result){
            echo'<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
                  <strong>Success!</strong>Laptop has been removed successfully.
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
                 </div>';
          }
          
        }

        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
            echo'
            <div class="container my-3 d-flex justify-content-center border border-dark">
            <form name="frmImage" enctype="multipart/form-data" action="partials/_handlelaptop.php" method="post" >
            <h2 class="container">Sell Laptop : With Details</h2><br>
            <div class="container form-group ">
                <label>Upload Image Of your Laptop:</label><br />
                <input name="laptopimg" type="file" required/> 
            </div>
            <div class="container form-group ">
            <label>Laptop Name</label><br>
            <input type="text" class="w-100" name="name_laptop" id="name_laptop" required ><br>
            <label>Laptop info</label><br>
            <input type="area" class="w-100" name="info_laptop" id="info_laptop" required ><br>
            <input type="radio" name="Submit" id="submit" class="my-2">Submit Laptop <br>
            
            <input type="submit" value="Submit" class="btn btn-success my-2 " />
            </div>
            </form>
            </div>';
            echo'
            <div class="container">
            <h1 class="text-center">Your Product</h1>';
            // <!-- card is starting -->
            echo'<div class="row my-4">';
            $product_is_none = true;
            $userid = $_SESSION['userid'];
            $sql = "SELECT * FROM `laptop` WHERE `user_id` = '$userid' && `submitted`= true  ";
            $result = mysqli_query($conn,$sql);
            while($row = mysqli_fetch_assoc($result)){
              $product_is_none = false;
              $laptopid = $row['id'];
              $laptopname = $row['title'];
              $laptopdesc = $row['description'];
              echo'
              <div class="col-md-4 my-2">
              <div class="card my-3" style="width: 18rem;">
                <img src="data:image/jpg;charset=utf8;base64,'.base64_encode($row["imgData"]).'" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title"><a href="laptopinfo.php?laptopid='.$laptopid.'" >'.$laptopname.'</a></h5>
                  <p class="card-text">'.$laptopdesc.'</p>
                  <a href="laptopinfo.php?laptopid='.$laptopid.'" class="btn btn-primary">About Deal</a>
                  
                  
                  <div class="modal fade" id="confirmationmodal" tabindex="-1" aria-labelledby="confirmationmodal" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="loginModalLabel">Are You Sure! It\'s Sold?</h5>
                        </div>
                      <form action="'.$_SERVER['REQUEST_URI'].'" method="post">
                      <input type="hidden" name="laptopid" value="'.$laptopid.'">
                      <div class="modal-footer">
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-success">Yes</button>
                        </div>
                      </form>
                      </div>
                    </div>
                  </div>
                  


                  <button class="btn btn-primary my-2" data-toggle="modal" data-target="#confirmationmodal">Sold</button>
                  </div>
              </div>
              </div>
              </div>';
            }
            
            
            if($product_is_none){
              echo'
              <div class="jumbotron jumbotron-fluid my-5 main">
              <div class="container">
                <h1 class="display-4">Your Not Sell Any Product Yet</h1>
                <p class="lead"><b>Please Select Product First And Upload img </b></p>
              </div>
             </div>
              ';
            }
            echo'
            </div>
            ';
        }
        else{
          echo'
          <div class="jumbotron jumbotron-fluid my-5 main">
                    <div class="container">
                      <h1 class="display-4">You Are not Logged In!</h1>
                      <p class="lead"><b>Do Login To Sell Or See Your Item</b></p>
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