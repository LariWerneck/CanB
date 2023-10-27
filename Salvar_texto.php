<?php
@include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    
    $id_user = $_SESSION['id_user'];
    $id_card = intval($_POST['id_card']);
    $texto = mysqli_real_escape_string($conn, $_POST['texto']);
    $update = "UPDATE tb_cards SET ds_card = '$texto' WHERE id_card = '$id_card' AND id_user = '$id_user'";

    if (mysqli_query($conn, $update)) {
        echo "Texto atualizado com sucesso.";
    } else {
        echo "Erro na atualização do texto: " . mysqli_error($conn);
    }
} else {
    echo "Acesso não autorizado.";
}
?>