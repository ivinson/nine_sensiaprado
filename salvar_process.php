<?php
require_once 'users/init.php';
$db = DB::getInstance();
// $token = $_POST['token'];

$origem = $_POST['origem'];
$nomeCompleto = $_POST['nomeCompleto'];
$nomeSocial = $_POST['nomeSocial'];
$nomeCredencial = $_POST['nomeCredencial'];
$primeiroNomePassaporte = $_POST['primeiroNomePassaporte'];
$ultimoNomePassaporte = $_POST['ultimoNomePassaporte'];
$numeroPassaporte = $_POST['numeroPassaporte'];
$nomeOrganizacao = $_POST['nomeOrganizacao'];
$nomePosicao = $_POST['nomePosicao'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$autodeclaracaoDeRaca = $_POST['autodeclaracaoDeRaca'];
$identidadeDeGenero = $_POST['identidadeDeGenero'];
$orientacaoAfetivoSexual = $_POST['orientacaoAfetivoSexual'];
$recursosAcessibilidade = $_POST['recursosAcessibilidade'];
$numeroDeColaboradores = $_POST['numeroDeColaboradores'];
$participaDoPacto = $_POST['participaDoPacto'];
$origemConvite = $_POST['origemConvite'];



$data = array(
  'origem' => $origem,
  'nome_completo' => $nomeCompleto,                      
  'nome_preferido' => $nomeSocial,
  'nome_credencial' => $nomeCredencial,
  'primeiro_nome_passaporte' => $primeiroNomePassaporte,
  'ultimo_nome_passaporte' => $ultimoNomePassaporte,
  'numero_passaporte' => $numeroPassaporte,
  'empresa' => $nomeOrganizacao,
  'cargo' => $nomePosicao,
  'email' => $email,
  'telefone' => $telefone,
  'etnia' => $autodeclaracaoDeRaca,
  'identidade_de_genero' => $identidadeDeGenero,
  'orientacao_sexual' => $orientacaoAfetivoSexual,
  'eh_pcd' => $recursosAcessibilidade,
  'numero_de_colaboradores' => $numeroDeColaboradores,
  'eh_pacto' => $participaDoPacto,
  'origem_convite' => $origemConvite,
  'status_rsvp' => 'CONFIRMADO'
);


// atualizacao de convidado no banco de dados
logger("1", "Confirmação inserida", "Dados do participante " . json_encode($data));
$response =  $db->insert('convidados',  $data);
//-----------------------------------------------------------




