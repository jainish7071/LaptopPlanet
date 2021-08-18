<?php
$showError = "false";
if($_SERVER['REQUEST_METHOD'] == "POST"){
    include '_dbconnect.php';
    $email = $_POST['signupemail'];
    $username = $_POST['username'];
    $pass = $_POST['signuppassword'];
    $cpass = $_POST['signupcpassword'];
    $location = $_POST['location'];
    
    $exitstSql = "SELECT * FROM `user` WHERE `name` = '$username'";
    $result = mysqli_query($conn,$exitstSql);
    $numRow = mysqli_num_rows($result);
    if($numRow > 0){
       $showError = "Username is already selected by someone else , please try some unique";
    }
    else{
        $exitstSql2 = "SELECT * FROM `user` WHERE `email` = '$email'";
        $result2 = mysqli_query($conn,$exitstSql2);
        $numrow = mysqli_num_rows($result2);
        if($numrow > 0){
        $showError = "Email already in use";
        }
        else{
           if($pass == $cpass){
                $hash = password_hash($pass , PASSWORD_DEFAULT);
                $sql = "INSERT INTO `user` (`name`,`email`, `password`,`location`) VALUES ('$username','$email', '$hash','$location')";
                $result = mysqli_query($conn ,$sql);
                if($result){
                   $showError = true;
                       echo'<div class="d-flex align-items-center text-light container">
                            <strong>Loading...</strong>
                            <div class="spinner-border ml-auto" role="status" aria-hidden="true"></div>
                            </div>';
                       header("location: /LaptopPlanet/index.php?signupsuccess=true");
                   exit();
                }
            }
            else{
              $showError =  "Password do not match";
            }
        }
    }
     echo'<div class="d-flex align-items-center text-light container">
                    <strong>Loading...</strong>
                    <div class="spinner-border ml-auto" role="status" aria-hidden="true"></div>
                  </div>';
     header("location: /LaptopPlanet/index.php?signupsuccess=false&error=$showError");

}


?>