<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="loginModalLabel">Login To Laptop Planet</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <form action="partials/_handlelogin.php" method="post">
      <div class="modal-body">
     <div class="form-group">
        <label for="loginuser">Username</label>
        <input type="text" class="form-control" id="loginuser" name="loginuser" aria-describedby="emailHelp">
     </div>
     <div class="form-group">
        <label for="loginpassword">Password</label>
        <input type="password" class="form-control" id="loginpassword" name="loginpassword">
     </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Login</button>
      </div>
    </form>
    </div>
  </div>
</div>