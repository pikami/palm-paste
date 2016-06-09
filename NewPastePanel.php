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
      <button type="submit" class="btn btn-default">Submit</button>
    </form>
  </div>
</div>
