<?php
$showError = "false";
if (count($_FILES)>0) {
    if(is_uploaded_file($_FILES['laptopimg']['tmp_name'])){
    include '_dbconnect.php';
    $imgData = addslashes(file_get_contents($_FILES['laptopimg']['tmp_name']));
    $imgProperties = getimageSize($_FILES['laptopimg']['tmp_name']);
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $laptop_name = $_POST['name_laptop'];
        $laptop_Desc = $_POST['info_laptop'];
        $laptop_submit = ($_POST['Submit']=="on");
        session_start();
        $sql = "INSERT INTO `laptop` (`user_id`,`title`,`description`,`seeking`,`submitted`,`imgType`,`imgData`) value
         ('{$_SESSION['userid']}','{$laptop_name}','{$laptop_Desc}',NULL,'{$laptop_submit}','{$imgProperties['mime']}','{$imgData}')";
        $result = mysqli_query($conn,$sql);
        header("location: /LaptopPlanet/laptopOffer.php?laptopsell=true&&laptop_name=$laptop_name");
        exit();
    }
    else{
        $showError = "Something Went Wrong Please Try Again";
    }
    }
}
else{
    $showError = "can't upload image right now please try again leter";
}

echo'<div class="d-flex align-items-center container">
             <strong>Loading...</strong>
             <div class="spinner-border ml-auto" role="status" aria-hidden="true"></div>
             </div>';
             header("location: /LaptopPlanet/laptopOffer.php?laptopsell=false&error=$showError");

?>