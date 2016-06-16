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
		    <!-- Posting as guest -->
			<div class="checkbox">
			  <label><input type="checkbox" name="asguest">Post as guest</label>
			</div>
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
                <option value="2592000">1 Month</option>
              </select>
            </div>
			<!-- Syntax Highlight -->
	        <div class="form-group">
              <label for="syntax">Syntax Highlight:</label>
              <select data-placeholder="None" class="form-control chosen-select" id="syntax" name="syntax">
			    <option value="plain">Plain</option>
			    <option value="applescript">AppleScript</option>
				<option value="as3">ActionScript3 (AS3)</option>
				<option value="bash">Bash</option>
				<option value="cf">ColdFusion</option>
				<option value="cpp">C++</option>
				<option value="csharp">C#</option>
				<option value="css">CSS</option>
				<option value="delphi">Delphi</option>
				<option value="diff">Diff</option>
				<option value="erlang">Erlang</option>
				<option value="groovy">Groovy</option>
				<option value="java">Java</option>
				<option value="javafx">JavaFX</option>
				<option value="jscript">JScript</option>
				<option value="perl">Perl</option>
				<option value="php">Php</option>
				<option value="powershell">PowerShell</option>
				<option value="python">Python</option>
				<option value="ruby">Ruby</option>
				<option value="sass">Sass</option>
				<option value="scala">Scala</option>
				<option value="sql">Sql</option>
				<option value="vb">VB</option>
				<option value="xml">Xml</option>
                
              </select>
            </div>
			<!-- Type -->
			<div class="form-group">
              <label for="exposure">Type:</label>
              <select class="form-control" id="exposure" name="exposure">
                <option value="0">Public</option>
                <option value="1">Unlisted</option>
				<?php
				  include_once "includes/user.php";
				  $userID = -1;
		          if(isset($_COOKIE["pp_sid"]) && isset($_COOKIE["pp_skey"]))
		            $userID = GetUsersIDBySession($_COOKIE["pp_sid"],$_COOKIE["pp_skey"]);
				  if($userID==-1)
				    print '<option value="2" disabled>Private (Members only)</option>';
				  else print '<option value="2" >Private</option>';
				?>
              </select>
            </div>
	        <!-- END Type -->
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
