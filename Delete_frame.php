<?php
@include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();

    $id_user = $_SESSION['id_user'];
    $id_frame = intval($_POST['id_frame']);
    $delete = "DELETE FROM tb_frames WHERE id_frame = '$id_frame' AND id_user = '$id_user'";

    if (mysqli_query($conn, $delete)) {
        echo "Card excluído com sucesso.";
    } else {
        echo "Erro na exclusão do card: " . mysqli_error($conn);
    }

    $deleteCards = "DELETE FROM tb_cards WHERE id_frame = '$id_frame'";
    $result = mysqli_query($conn, $deleteCards);
} else {
    echo "Acesso não autorizado.";
}
?>
