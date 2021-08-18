<?php
session_start();

echo'
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="/LaptopPlanet">Laptop Planet</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
            <a class="nav-link" href="/LaptopPlanet">Home<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="about.php">About</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="sell.php">Sell</a>
            
            <li class="nav-item">
            <a class="nav-link " href="contact.php">Contact</a>
            </li>
        </ul>
        <div class="row mx-2">';
  if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){   
     echo' 
     <a role="button" href="chat.php" class="btn btn-outline-success ml-2" >Your Conversation</a>
     <a role="button" href="partials/_logout.php" class="btn btn-outline-success ml-2" >Logout</a>
     <a role="button" href="userProfile.php" class="ml-2" ><img class="rounded-circle" src="img/default-user.jpg" alt="no image" height=40px width=30px></a>
      
     ';
    }
    else{
    echo'
         <button class="btn btn-outline-success ml-2" data-toggle="modal" data-target="#loginModal">Login</button>
         <button class="btn btn-outline-success ml-2" data-toggle="modal" data-target="#signupModal">SignUp</button>';
    }
 echo'</div>
      </div>
      </nav>';

    include "partials/loginmodal.php";
    include "partials/signupmodal.php";
    if(isset($_GET['signupsuccess']) && $_GET['signupsuccess']=="true"){
        echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
                <strong>Success!</strong> you can now login.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
              </div>';
    }
    if(isset($_GET['signupsuccess']) && $_GET['signupsuccess']=="false"){
        $showError = $_GET['error'];
        echo'<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
                <strong>ERROR!</strong> '.$showError.' 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
             </div>';
    }
    if(isset($_GET['loginsuccess']) && $_GET['loginsuccess']=="true"){
        echo'<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
                <strong>Success!</strong> You Are Loggeded in.  
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
             </div>';
    }
    if(isset($_GET['loginsuccess']) && $_GET['loginsuccess']=="false"){
        $showError = $_GET['error'];
        echo'<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
                <strong>ERROR!</strong> '.$showError.' 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
             </div>';
    }
?>