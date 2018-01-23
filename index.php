
    <?php
      session_start();
      $cookie_name = "visited";
      setcookie($cookie_name, 'not first time', time() + (86400 * 30), "/");
      if (!$_SESSION):
        $title = "Login";
        include "includes/header.php";
        include "includes/form.php";
      else:
        $title = $_SESSION['username'];
        include "includes/header.php";

        if (isset($_POST['booking'])) {
          if ($_POST['location'] === 'placeholder' || $_POST['destination'] === 'placeholder' || $_POST['date'] === '') {
?>

<script>
  alert('Please fill in all fields');
</script>

<?php
          } else if ($_POST['passengers'] <  1 || $_POST['passengers'] > 9999) {
?>

<script>
  alert('Invalid passenger amount');
</script>

<?php
          } else if ($_POST['location'] === $_POST['destination']) {
?>

<script>
  alert("Invalid route");
</script>

<?php
          } else {
            include 'includes/db.php';
            $query = 'INSERT INTO bookings(location, destination, depDate, userId, passengers)';
            $query .= "VALUES ('".$_POST['location']."', '".$_POST['destination']
                    ."', '".$_POST['date']."', '".$_SESSION['id']."', '".$_POST['passengers']."')";

            $result = mysqli_query($connection, $query);

            if (!$result) {
              die('Query failed' . mysqli_error($connection));
            }
          }
        }
      ?>

<div class="nav">
  <a href="logout.php">
    <button class="button">Logout</button>
  </a>
</div>
<?php include 'includes/bookings.php' ?>

      <?php
      endif;
      ?>

  </body>
</html>
