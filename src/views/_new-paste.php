<form class="row g-3" role="form" method="post" action="<?php echo $BASE_DIR ?>post.php" onsubmit="">
  <?php
  $edit_mode = false;
  if (isset($_GET['page']) && $_GET['page'] == 'edit') {
    $edit_mode = true;
    printf('You are editing paste ' . $_GET['id']);
  }
  ?>

  <div class="col-md-12">
    <label for="title" class="form-label">Paste Title</label>
    <input class="form-control" id="title" name="title">
  </div>

  <div class="col-md-12">
    <label for="text" class="form-label">Content</label>
    <textarea class="form-control" id="text" name="text" rows="5"></textarea>
  </div>

  <input type='hidden' id="action-type" name='type' value='paste'></input>
  <?php
  if ($edit_mode == true) {
    printf("<input type='hidden' name='uid' value='" . $pasteInfo['uid'] . "'></input>");
  }
  ?>

  <div class="col-md-6">
    <div class="form-check">
      <!-- Posting as guest -->
      <label class="form-check-label" for="asguest">
        Post as guest
      </label>
      <input class="form-check-input" type="checkbox" id="asguest" name="asguest">
    </div>
    <!-- Submit -->
    <button type="submit" class="btn btn-primary">Submit</button>
  </div>

  <div class="col-md-6">
    <!-- Expiry -->
    <label for="expire">Expiration:</label>
    <select class="form-select" id="expire" name="expire">
      <option>Never</option>
      <option value="600">10 Minutes</option>
      <option value="3600">1 Hour</option>
      <option value="86400">1 Day</option>
      <option value="2592000">1 Month</option>
    </select>
    <!-- Syntax Highlight -->
    <label for="syntax">Syntax Highlight:</label>
    <select data-placeholder="None" class="form-select" id="syntax" name="syntax">
      <?php
      if ($edit_mode == true)
        print '<option value="' . $pasteInfo['highlight'] . '">Current (' . $pasteInfo['highlight'] . ')</option>';
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
    <!-- Type -->
    <label for="exposure">Type:</label>
    <select class="form-select" id="exposure" name="exposure">
      <?php
      print '<option value="0">Public</option>';
      if ($edit_mode == true && $pasteInfo['exposure'] == 1)
        print '<option selected="selected" value="1">Unlisted</option>';
      else print '<option value="1">Unlisted</option>';
      include_once "includes/user.php";
      $userID = -1;
      if (isset($_COOKIE["pp_sid"]) && isset($_COOKIE["pp_skey"]))
        $userID = GetUsersIDBySession($_COOKIE["pp_sid"], $_COOKIE["pp_skey"]);
      if ($userID == -1)
        print '<option value="2" disabled>Private (Members only)</option>';
      else {
        if ($edit_mode === true && $pasteInfo['exposure'] === 2)
          print '<option selected="selected" value="2" >Private</option>';
        else print '<option value="2" >Private</option>';
      }
      ?>
    </select>
  </div>

  <script>
    const onSubmit = () => {
      document.getElementById('submit').disabled = true;
      document.getElementById('submit').value = 'Please wait...';
    }

    const pasteData = {
      title: "<?php echo $pasteInfo['title'] ?>"
      text: "<?php echo $pasteInfo['text'] ?>",
      uid: "<?php echo $pasteInfo['uid'] ?>",
      highlight: "<?php echo $pasteInfo['highlight'] ?>",
      exposure: "<?php echo $pasteInfo['exposure'] ?>",
    };

    if ($edit_mode == true) {
      printf("document.getElementById(\"action-type\").value = 'edit_paste';");
    }
  </script>
</form>