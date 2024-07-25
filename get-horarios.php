<?php
require_once 'users/init.php'; // Inclua o arquivo init.php do UserSpice
$db = DB::getInstance(); // Obtenha uma instância do banco de dados

// Verifique se o parâmetro 'id_convite' está presente na URL
if (isset($_GET['id_convite'])) {
  $idConvite = $_GET['id_convite'];

  // Faça uma consulta ao banco de dados para obter os horários com base no id_convite
  $agendamentos = $db->query("SELECT * FROM agendamentos WHERE  qtd > 0 and convite = ?", [$idConvite])->results();
  // Verifique se foram encontrados horários
  if ($agendamentos) {
    foreach ($agendamentos as $agendamento) {
      echo '<option data-horario="' . $agendamento->horario . '" value="' . $agendamento->id . '">Commander - ' . $agendamento->horario . '  (' . $agendamento->qtd . ' vagas )' . '</option>';
    }
  } else {    
    echo 'Todos os horarios foram preenchidos.';
  }
} else {
  echo 'O parâmetro id_convite não foi fornecido.';
}
