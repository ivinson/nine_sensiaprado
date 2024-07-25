<?php
require_once 'users/init.php'; // Inclua o arquivo init.php do UserSpice
$db = DB::getInstance(); // Obtenha uma instância do banco de dados

// Verifique se o parâmetro 'cpf' está presente na URL
if (isset($_GET['cpf'])) {
  $cpf = $_GET['cpf'];

  // Faça uma consulta ao banco de dados para obter os cpf e verificar se já existe
  $result = $db->query("SELECT cpf FROM convidados WHERE cpf = ?", [$cpf])->first();
  $cpf = $result ? $result->cpf : null;

   // Verifique se foram encontrados cpf
  if ($cpf) {    
    echo 'CPF ja cadastado.';
  } else {
    echo 'CPF disponivel.';
  }
} else {
  echo 'O parâmetro cpf não foi fornecido.';
}
