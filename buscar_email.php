<?php
require_once 'users/init.php';
$db = DB::getInstance();

if (isset($_POST['inputEmail'])) {
    $email = $_POST['inputEmail'];
    $user = $db->query("SELECT id, status_cadastro FROM convidados WHERE email = ? ", array($email));
    if ($user->count()) {
      // Pega o primeiro resultado
      $userFound = $user->first();
      // Retorna o ID do usuário
      
      // Inicia a sessão
      // session_start();
  
      // Define a variável de sessão com o ID do usuário validado
      $_SESSION['convidado_id'] = $userFound->id;
      echo json_encode(['status' => 'found', 'id' => $userFound->id, 'status_cadastro' => $userFound->status_cadastro]);
    } else {
      // Retorna 'not found' se o usuário não for encontrado
      echo json_encode(['status' => 'not found']);
    }
}
?>
