<?php
require_once 'users/init.php';
$db = DB::getInstance();

$nomeCompleto = $_POST['nomeCompleto'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$apartamento = $_POST['apartamento'];
$chegada = $_POST['chegada'];
$aulaPersonal = $_POST['aulaPersonal'];
$aulaTenis = $_POST['aulaTenis'];
$quantidade = $_POST['quantidade'];
$cpf = $_POST['cpf'];

$data = array(
  'nome_completo' => $nomeCompleto,
  'email' => $email,
  'telefone' => $telefone,
  'apartamento' => $apartamento,
  'chegada' => $chegada,
  'aula_personal' => $aulaPersonal,
  'aula_tenis' => $aulaTenis,
  'status_rsvp' => 'CONFIRMADO',
  'quantidade' => $quantidade,
  'cpf' => $cpf
);
// session_start();
// $_SESSION['data'] = $data;
//-----------------------------------------------------------
// atualizacao de convidado no banco de dados
logger("1", "Confirmação inserida", "Dados do participante " . json_encode($data));
$response =  $db->insert('convidados',  $data);
//-----------------------------------------------------------
// Atualizar a quantidade de vagas disponíveis na tabela agendamentos
if ($aulaPersonal != 'N') {
  $response = $db->query("UPDATE agendamentos SET qtd = qtd - 1 WHERE id = $aulaPersonal");
}
if ($aulaTenis != 'N') {
  $response = $db->query("UPDATE agendamentos SET qtd = qtd - 1 WHERE id = $aulaTenis");
}

 // devolver ao ajax os dados do convidado
echo json_encode($data);
