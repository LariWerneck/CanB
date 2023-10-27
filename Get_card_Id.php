<?php
@include 'config.php';

$query = "SELECT MAX(id_card) as last_id FROM tb_cards";
$result = mysqli_query($conn, $query);
$last_id = 0;

if ($result && mysqli_num_rows($result) > 0) {
  $row = mysqli_fetch_assoc($result);
  $last_id = intval($row['last_id']);
}
else
{
  $last_id = 0;
}

echo $last_id;
?>
