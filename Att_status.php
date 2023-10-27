<?php
@include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id_card = intval($_POST['id_card']);
  $novo_status = $_POST['novo_status'];

    $update = "UPDATE tb_cards SET ds_status = '$novo_status' WHERE id_card = '$id_card'";

    if (mysqli_query($conn, $update)) {
        echo "Status atualizado com sucesso.";
    } else {
        echo "Erro na atualização do status: " . mysqli_error($conn);
    }
} 

?>
