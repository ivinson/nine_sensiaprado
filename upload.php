<?php

require_once 'users/init.php';
$db = DB::getInstance();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $target_dir = "uploads/";

    // convidado_id session
    $convidado_id = $_SESSION['convidado_id'];
    
    // Gerar um nome único para o arquivo
    $fileExt = strtolower(pathinfo($_FILES["fileUpload"]["name"], PATHINFO_EXTENSION));
    $newFileName = uniqid('img_', true) . '.' . $fileExt;
    $target_file = $target_dir . $newFileName;

    $uploadOk = 1;

    // Código para checar se o arquivo é realmente uma imagem, tamanho, etc.
    if ($uploadOk == 0) {
        echo "Desculpe, seu arquivo não foi enviado.";
    } else {
        if (move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $target_file)) {
            echo "O arquivo foi enviado com sucesso.";

           // Atualizar o caminho no banco de dados
           $updateData = array("foto" => $target_file);
           $db->update('convidados', $convidado_id, $updateData);
            
        } else {
            echo "Desculpe, houve um erro ao enviar seu arquivo.";
        }
    }
}
?>
