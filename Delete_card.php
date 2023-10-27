<?php
@include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_card = intval($_POST['id_card']);

    $delete = "DELETE FROM tb_cards WHERE id_card = $id_card";

    if (mysqli_query($conn, $delete)) {
        echo "Card excluído com sucesso.";
    } else {
        echo "Erro na exclusão do card: " . mysqli_error($conn);
    }
}
?>
