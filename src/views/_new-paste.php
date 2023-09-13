<div class="panel panel-default">
  <div class="panel-body">
    <?php
    $edit_mode = false;
    if (isset($_GET['page']) && $_GET['page'] == 'edit') {
      $edit_mode = true;
      printf('You are editing paste ' . $_GET['id']);
      printf('<form role="form" method="post" action="../post.php" onsubmit="document.getElementById(\'submit\').disabled=true;document.getElementById(\'submit\').value=\'Please wait...\';">');
    } else printf('<form role="form" method="post" action="post.php" onsubmit="document.getElementById(\'submit\').disabled=true;document.getElementById(\'submit\').value=\'Please wait...\';">');
    ?>
    <div class="form-group">
      <label for="title">Paste title:</label>
      <?php
      if ($edit_mode == true) {
        printf('<input type="title" class="form-control" value="' . $row['title'] . '" id="title" name="title">');
      } else printf('<input type="title" class="form-control" id="title" name="title">');
      ?>
    </div>
    <div class="form-group">
      <label for="text">New paste:</label>
      <?php
      if ($edit_mode == true) {
        echo '<textarea class="form-control" rows="5" id="text" name="text">' . $row['text'] . '</textarea>';
      } else printf('<textarea class="form-control" rows="5" id="text" name="text"></textarea>');
      ?>
    </div>
    <?php
    if ($edit_mode == true) {
      printf("<input type='hidden' name='type' value='edit_paste'></input>");
      printf("<input type='hidden' name='uid' value='" . $row['uid'] . "'></input>");
    } else printf("<input type='hidden' name='type' value='paste'></input>");
    ?>
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
              <?php
              if ($edit_mode == true)
                print '<option value="' . $row['highlight'] . '">Current (' . $row['highlight'] . ')</option>';
              ?>
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
              <?php
              print '<option value="0">Public</option>';
              if ($edit_mode == true && $row['exposure'] == 1)
                print '<option selected="selected" value="1">Unlisted</option>';
              else print '<option value="1">Unlisted</option>';
              include_once "includes/user.php";
              $userID = -1;
              if (isset($_COOKIE["pp_sid"]) && isset($_COOKIE["pp_skey"]))
                $userID = GetUsersIDBySession($_COOKIE["pp_sid"], $_COOKIE["pp_skey"]);
              if ($userID == -1)
                print '<option value="2" disabled>Private (Members only)</option>';
              else {
                if ($edit_mode === true && $row['exposure'] === 2)
                  print '<option selected="selected" value="2" >Private</option>';
                else print '<option value="2" >Private</option>';
              }
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