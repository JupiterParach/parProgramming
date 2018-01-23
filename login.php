<?php
include "includes/header.php";
include "includes/db.php";

  $username = $_POST["username"];
  $password = $_POST["password"];
  $username = mysqli_real_escape_string($connection, $username);
  $password = mysqli_real_escape_string($connection, $password);

  if (isset($_POST["login"])) {
    session_start();

    $query = "SELECT * FROM users WHERE username = '{$username}' ";
    $select_user_query = mysqli_query($connection, $query);

    if (!$select_user_query) {
      die('Query failed') . mysql_error($connection);
    }

    while ($row = mysqli_fetch_array($select_user_query)) {
      $db_id = $row['id'];
      $db_username = $row['username'];
      $db_password = $row['password'];
    }

    $password = hash('sha256', $password);

    if ($db_username === $username && $db_password === $password) {
      $_SESSION['username'] = $db_username;
      $_SESSION['id'] = $db_id;
    }
    header("Location: index.php");
  }
  elseif (isset($_POST["register"])) {
    session_start();

    $query = "SELECT * FROM users WHERE username = '{$username}' ";
    $select_user_query = mysqli_query($connection, $query);

    if (!$select_user_query) {
      die('Query failed') . mysql_error($connection);
    }
    while ($row = mysqli_fetch_array($select_user_query)) {
      $db_username = '';
      $db_username = $row['username'];
    }
    if (isset($db_username)) {
      if ($db_username === $username) {
        echo '<script>alert("Username taken"); document.location.href = "register.php";</script>';
        die();
      }
    }
    $password = hash('sha256', $password);

    $query = "INSERT INTO users(username, password)"; // Vart vi lägger in det
    $query .= "VALUES ('$username', '$password')"; // VAD vi lägger in

    $result = mysqli_query($connection, $query);

    $query = "SELECT * FROM users WHERE username = '{$username}' ";
    $find_query = mysqli_query($connection, $query);

    if (!$find_query) {
      die('Query failed') . mysqli_error($connection);
    }
    while ($row = mysqli_fetch_array($find_query)) {
      $db_id = $row['id'];
    }

    if (!$result) {
      die("Query failed!" . mysqli_error());
    }
    $_SESSION['username'] = $username;
    $_SESSION['id'] = $db_id;
    echo "<script type='text/javascript'>alert('Registration successful'); document.location.href = 'index.php';</script>";
  }
?>
</body>
</html>
