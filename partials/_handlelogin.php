<?php
$showError = "false";
if($_SERVER['REQUEST_METHOD'] == "POST"){
    include '_dbconnect.php';
    $username = $_POST['loginuser'];
    $pass = $_POST['loginpassword'];

    $sql = "SELECT * FROM `user` WHERE `name` = '$username' ";
    $result = mysqli_query($conn,$sql);
    $numRows = mysqli_num_rows($result);
    if($numRows==1){
        $row = mysqli_fetch_assoc($result);
         if(password_verify($pass,$row['password'])){
             session_start();
             $_SESSION['loggedin']=true;
             $_SESSION['username']=$username;
             $_SESSION['userid']=$row['id'];
             echo'<div class="d-flex align-items-center container">
                  <strong>Loading...</strong>
                  <div class="spinner-border ml-auto" role="status" aria-hidden="true"></div>
                  </div>';
             header("location: /LaptopPlanet/index.php?loginsuccess=true");
             exit();
            }
            else{
                $showError = "Inserted password is wrong! Kindly check the password";
            }
        }
        else{
            $showError = "user does not exist,please signup First";
        }
        echo'<div class="d-flex align-items-center container">
             <strong>Loading...</strong>
             <div class="spinner-border ml-auto" role="status" aria-hidden="true"></div>
             </div>';
        header("location: /LaptopPlanet/index.php?loginsuccess=false&error=$showError");

}


?>