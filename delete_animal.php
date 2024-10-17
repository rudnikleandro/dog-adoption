<?php

include 'conn.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
}

$id = $_GET['id'];

$sql = "UPDATE dogs SET deleted_at = NOW() WHERE id = $id";
if ($conn->query($sql) === TRUE) {
    header('Location: admin_panel.php?page=list_animal&message=Animal excluído com sucesso!');
} else {
    echo "Erro ao excluir o animal: " . $conn->error;
}

?>