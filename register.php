<?php
$title = "Register";
include "includes/header.php";
?>
<form class="nav" action="login.php" method="post">
  <input class="input-field" type="text" name="username" placeholder="username" required>
  <input class="input-field" type="password" name="password" placeholder="password" required>
  <input class="button" type="submit" name="register" value="Register">
  <a href="index.php"><button class="button">Back</button></a>
</form>

  </body>
</html>
