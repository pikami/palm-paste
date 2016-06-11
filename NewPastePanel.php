<div class="panel panel-default">
  <div class="panel-body">
    <form role="form" method="post" action="post.php" onsubmit="document.getElementById('submit').disabled=true;document.getElementById('submit').value='Please wait...';">
      <div class="form-group">
        <label for="title">Paste title:</label>
        <input type="title" class="form-control" id="title" name="title">
      </div>
      <div class="form-group">
        <label for="text">New paste:</label>
        <textarea class="form-control" rows="5" id="text" name="text"></textarea>
      </div>
	  <input type='hidden' name='type' value='paste'></input>
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
	        <!-- Submit -->
            <button type="submit" class="btn btn-default">Submit</button>
          </div>
          <div class="col-sm-6">
            <!-- Expiry -->
	        <div class="form-group">
              <label for="expire">Expiration:</label>
              <select class="form-control" id="expire" name="expire">
                <option>Never</option>
                <option value="600">10 Minutes</option>
                <option value="3600">1 Hour</option>
                <option value="86400">1 Day</option>
              </select>
            </div>
	        <!-- END Expiry -->
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
