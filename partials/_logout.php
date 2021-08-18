<?php
session_start();
echo'
<div class="d-flex align-items-center container">
  <strong>Loading...</strong>
  <div class="spinner-border ml-auto" role="status" aria-hidden="true"></div>
</div>
';
session_destroy();
header("location: /LaptopPlanet/index.php");
?>