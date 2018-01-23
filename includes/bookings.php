<?php
  $id = $_SESSION['id'];
  $locations = ["a", "b", "c"];
  $destinations = ["a", "b", "c"];
?>

<form class="central-content" action="index.php" method="post">
  <select class="input-field" name="location">
    <option class="placeholder" value="placeholder">Location</option>
    <?php foreach ($locations as $key => $value) {
      echo '<option value="'.$value.'"';
      if (isset($_POST['location'])) {
        if ($_POST['location'] === $value) {
          echo ' selected';
        }
      }
      echo '>'.$value.'</option>';
    } ?>
  </select>
  <select class="input-field" name="destination">
    <option class="placeholder" value="placeholder">Destination</option>
    <?php foreach ($destinations as $key => $value) {
      echo '<option value="'.$value.'"';
      if (isset($_POST['destination'])) {
        if ($_POST['destination'] === $value) {
          echo ' selected';
        }
      }
      echo '>'.$value.'</option>';
    } ?>
  </select>
  <input class="input-field" type="date" name="date"<?php if (isset($_POST)) {
    if (isset($_POST['date'])) {
      echo ' value='.$_POST['date'];
    }
  } ?>>
  <input class="input-field" type="number" name="passengers" min="1" max="9999" value="<?php
    if (isset($_POST['passengers'])) {
      echo $_POST['passengers'];
    } else {
      echo '1';
    }
  ?>">
  <input type="submit" class="last-child button" name="booking" value="Submit">
</form>

<?php
include 'db.php';

$query = "SELECT * FROM bookings WHERE userId = '{$id}'";
$result = mysqli_query($connection, $query);

if (!$result) {
  die('Query failed ' . mysqli_error($connection));
}

$bookings = array();
while ($row = mysqli_fetch_assoc($result)) {
  $bookings[] = $row;
}

if (count($bookings) > 0) {
?>
<table class="central-content">
<tr>
  <th>
    Location
  </th>
  <th>
    Destination
  </th>
  <th>
    Departure
  </th>
  <th>
    Passengers
  </th>
</tr>

<?php
}

foreach ($bookings as $row) {
?>

<tr>

<?php
foreach ($row as $key => $value) {
  if ($key === 'id' || $key === 'userId') {
    continue;
  }
?>

<td>
  <?php echo $value; ?>
</td>

<?php
}
?>

</tr>

<?php
} if (count($bookings) > 0) :
?>

</table>

<?php endif; ?>
