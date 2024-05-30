<?php
include 'includes/header.php';
?>

<section class="container">
  <h2 class='text-center'>Hello There</h2>
</section>

<?php

$sql = "SELECT * FROM temp_data;";

$results = mysqli_query($conn, $sql);

echo mysqli_num_rows($results);

$rows = mysqli_fetch_assoc($results);

echo print_r($rows);

foreach ($rows as $row) {
  echo $row['id'];
}
?>

<?php
include 'includes/footer.php';
?>