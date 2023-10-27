<?php
@include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    session_start();

    $id_user = $_SESSION['id_user'];
    $idframe = $_SESSION['id_frame'];
    $jsonData = file_get_contents("php://input");
    $data = json_decode($jsonData);

    if (isset($data->nm_card) && isset($data->id_kanban)) {
    $nm_card = mysqli_real_escape_string($conn, $data->nm_card);
    $id_kanban = intval($data->id_kanban);
    $ds_card = '';
    $insert = "INSERT INTO tb_cards (nm_card, ds_card, id_kanban, id_user, id_frame) VALUES ('$nm_card', '$ds_card', '$id_kanban', '$id_user', '$idframe')";
    if (mysqli_query($conn, $insert)) {
        echo "Card inserido com sucesso.";
    } else {
        echo "Erro na inserção do card: " . mysqli_error($conn);
    }
    } else {
    echo "Dados de JSON ausentes ou incorretos.";
    }
} 
else {
    echo "Acesso não autorizado.";
}
?>
