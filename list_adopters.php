<?php

include 'conn.php';

$sql = "SELECT * FROM dogs";

$result = $conn->query($sql);

?>

<h2>Lista de Adotantes</h2>