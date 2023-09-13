<div class="container">
  <div class="panel panel-default">
    <div class="panel-heading">Register</div>
    <div class="panel-body">
      <!-- Panel Content -->
      <form class="form-horizontal" role="form" method="POST" action="login">
        <div class="form-group">
          <label class="control-label col-sm-2" for="user">Username:</label>
          <div class="col-sm-10">
            <input type="user" class="form-control" id="user" placeholder="Enter username" name="user">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2" for="pwd">Password:</label>
          <div class="col-sm-10">
            <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd">
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <input type='hidden' name='type' value='register'></input>
            <button type="submit" class="btn btn-default">Submit</button>
          </div>
        </div>
      </form>
      <!-- END Panel Content -->
    </div>
  </div>
</div>