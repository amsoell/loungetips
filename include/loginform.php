<?php
  if (!strlen($_COOKIE['username'])>0) {
?>
    <p><?php print $errMsg; ?></p>  
    <form id="login" action="<?php print $_SERVER['PHP_SELF']; ?>" method="POST">
      <input type="hidden" name="action" value="login" />
      <label for="username">E-mail</label> <input id="username" name="username" value="" /><br />
      <label for="password">Password</label> <input id="password" name="password" type="password" value="" /><br />
      <button type="submit">Login</button><br />
    </form>
<?php
  }
?>