<?php
@include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();

    $id_frame = intval($_POST['id_frame']);
    $newText = mysqli_real_escape_string($conn, $_POST['newText']);
    $update = "UPDATE tb_frames SET nm_frame = '$newText' WHERE id_frame = '$id_frame'";

    if (mysqli_query($conn, $update)) {
        echo "Nome do card atualizado com sucesso.";
    } else {
        echo "Erro na atualização do nome do card: " . mysqli_error($conn);
    }
}
?>
