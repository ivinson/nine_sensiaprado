<?php
require_once 'users/init.php';
$db = DB::getInstance();
// -----------------------------------------------------------
$nomeCompleto = $_POST['nomeCompleto'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$cpf = $_POST['cpf'];
$dataConvite = $_POST['dataConvite'];
$carroEscolhido = $_POST['carroEscolhido'];
$concessionaria = $_POST['concessionaria'];

$data = array(
  'nome_completo' => $nomeCompleto,
  'email' => $email,
  'telefone' => $telefone,
  'cpf' => $cpf,  
  'evento' => $dataConvite,
  'carro_escolhido' => $carroEscolhido,
  'concessionaria' => $concessionaria,
  'status_rsvp' => 'CONFIRMADO'  
);

//-----------------------------------------------------------
// atualizacao de convidado no banco de dados
logger("1", "Confirmação inserida", "Dados do participante " . json_encode($data));
$response =  $db->insert('convidados',  $data);

//-----------------------------------------------------------
// Atualizar a quantidade de vagas disponíveis na tabela agendamentos
if (  $carroEscolhido != '') {
  $response = $db->query("UPDATE agendamentos SET qtd = qtd - 1 WHERE id = $carroEscolhido");
}

// devolver ao ajax os dados do convidado
echo json_encode($data);
