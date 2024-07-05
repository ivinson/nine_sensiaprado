<?php
// Habilitar a exibição de erros
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Iniciar o buffer de saída
ob_start();

// Gerar o HTML
include('carta_convite_template.php');
$html = ob_get_clean();
require_once '../users/init.php';
$db = DB::getInstance();
$info = $db->query("SELECT * FROM convidados WHERE id = ?", [$_GET['id']])->first();

// dump($info);

// Ajuste para usar sintaxe de array
$html = str_replace('{{nome}}', $info->nome_completo, $html);

// Verifique se os arquivos de imagem existem e são legíveis
if (file_exists('logo_avon.png') && file_exists('logo_dagaz.png')) {
  $logo_natura = 'data:image/png;base64,' . base64_encode(file_get_contents('logo_avon.png'));
  $logo_dagaz = 'data:image/png;base64,' . base64_encode(file_get_contents('logo_dagaz.png'));

  $aviao_ida = 'data:image/png;base64,' . base64_encode(file_get_contents('aviao_ida.png'));
  $aviao_volta = 'data:image/png;base64,' . base64_encode(file_get_contents('aviao_volta.png'));
} else {
  // Lidar com o erro apropriadamente
  echo "Erro: Arquivos de imagem não encontrados.";
  exit;
}

$html = str_replace('{{logo_natura}}', $logo_natura, $html);
$html = str_replace('{{logo_dagaz}}', $logo_dagaz, $html);
$html = str_replace('{{aviao_ida}}', $aviao_ida, $html);
$html = str_replace('{{aviao_volta}}', $aviao_volta, $html);
//==============================================================================

// Substituir outros campos
// Verificar se $info->localizador é null e substituir por uma string vazia se for o caso
$localizador_ida = isset($info->localizador) ? $info->localizador : '';
$html = str_replace('{{localizador_ida}}', $localizador_ida, $html);
$html = str_replace('{{localizador_volta}}', $localizador_ida, $html);

// Repita para os outros campos conforme necessário
// -{{localizador_ida}}
// -{{eticket}}
// {{data_ida}}
// -{{cia_voo_ida}}
// {{origem_ida}}
// {{destino_ida}}
// {{saída_ida}}
// {{chegada_ida}}
$eticket = isset($info->eticket) ? $info->eticket : '';
$html = str_replace('{{eticket}}', $eticket, $html);

$cia_voo_ida = isset($info->cia_voo) ? $info->cia_voo : '';
$html = str_replace('{{cia_voo_ida}}', $cia_voo_ida, $html);

$cia_voo_volta = isset($info->cia_voo) ? $info->cia_voo : '';
$html = str_replace('{{cia_voo_volta}}', $cia_voo_volta, $html);

require '../vendor/autoload.php';

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

$nome = $info->nome_completo;
$nome = str_replace(' ', '_', $nome);
$output = $dompdf->output();
$pdfFilePath = $info->id . '_carta_convite_' . $nome . '.pdf';
file_put_contents($pdfFilePath, $output);

$db->query("UPDATE convidados SET arquivo_carta_convite = ? WHERE id = ?", [$pdfFilePath, $info->id]);


// Enviar por e-mail e whatsapp o pdf gerado
// enviarCarta($info->id);
echo "Carta gerada com sucesso! <a href='$pdfFilePath' target='_blank'>Clique aqui para baixar</a>";



// Enviar por e-mail e whatsapp o pdf gerado
function enviarCarta($idConvidado)
{

  $db = DB::getInstance();
  $info = $db->query("SELECT * FROM convidados WHERE id = ?", [$idConvidado])->first();
  $pdfFilePath =   $info->arquivo_carta_convite;
  // echo $pdfFilePath;



  // Obtendo o caminho atual
  $currentDirectory = getcwd();
  // echo "Diretório Atual: " . $currentDirectory . "\n"; // Para depuração

  // Caminho do arquivo a ser anexado (ajuste conforme necessário)
  // $filePath = $currentDirectory . '/caminho/para/seu/arquivo.pdf'; // Caminho relativo
  // // ou
  // $filePath = '/caminho/absoluto/para/seu/arquivo.pdf'; // Caminho absoluto

  // // Anexando o arquivo
  // if (file_exists($pdfFilePath)) {
  //     // $mail->addAttachment($pdfFilePath);
  //     echo "Achou: " . $pdfFilePath . "\n"; // Para depuração
  // } else {
  //     echo "Arquivo não encontrado: " . $pdfFilePath . "\n"; // Para depuração
  // }

  // // Enviar email, etc.




  // die();
  // Enviar por e-mail -----------------------------------
  $options = array(
    'fname' => $info->nome_completo,
    'email' => rawurlencode($info->email),
  );

  $subject = 'Destaques Natura 2024 - Suas informações de viagem chegaram!';
  $encoded_email = rawurlencode($info->email);
  $body =  email_body('_email_confirmacao_recebimento.php', $options);
  $email_sent = email($info->email, $subject, $body, null, $pdfFilePath);
  if (!$email_sent) {
    $errors[] = lang("ERR_EMAIL");
  }
  // Log ----------------------------------------------------
  logger("1", "Envio de carta - Email", "#" . $info->id . "# |" . $email_sent . " | O pdf foi enviado para " . $info->nome_completo . " no email " . $info->email . ".");
  //------------------------------------------------------------------------------------------------------------

  // Enviar por whatsapp ----------------------------------
  // $whatsappContato = '5511975757541';
  $whatsappContato = $info->whatsapp_contato;
  $curl = curl_init();

  // curl_setopt_array($curl, array(
  //   CURLOPT_URL => 'https://sync.triadgroup.com.br/api/messages/send',
  //   CURLOPT_RETURNTRANSFER => true,
  //   CURLOPT_ENCODING => '',
  //   CURLOPT_MAXREDIRS => 10,
  //   CURLOPT_TIMEOUT => 0,
  //   CURLOPT_FOLLOWLOCATION => true,
  //   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  //   CURLOPT_CUSTOMREQUEST => 'POST',
  //   CURLOPT_POSTFIELDS => '{
  //   "number": "' . $whatsappContato . '", 
  //   "openTicket": "0", 
  //   "queueId": "0", 
  //   "body": "*' . $info->nome_completo . ', aqui estão seus dados para a viagem!*\n\n🗓 *Data do Evento:* 18/06 a 21/06\n\n🛫\n\n🙋‍♂️*Dúvidas ou Assistência:*\nSe tiver qualquer dúvida ou necessidade de assistência, não hesite em nos contatar através do WhatsApp." 
  // }',
  //   CURLOPT_HTTPHEADER => array(
  //     'Content-Type: application/json',
  //     'Authorization: Bearer b0e2d3316346b2ba1d585cd7f4e77e8af3cc0349'
  //   ),
  // ));

  $curl = curl_init(); // Supondo que $curl já foi inicializado

  curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://sync.triadgroup.com.br/api/messages/send',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => array(
      'medias' => new CURLFILE($pdfFilePath), // Substitua pelo caminho correto do arquivo
      'number' => $whatsappContato,
      'openTicket' => '0',
      'queueId' => '0',
      'body' => '*' . $info->nome_completo . ', aqui estão seus dados para a viagem!*\n\n🗓 *Data do Evento:* 18/06 a 21/06\n\n🛫\n\n🙋‍♂️*Dúvidas ou Assistência:*\nSe tiver qualquer dúvida ou necessidade de assistência, não hesite em nos contatar através do WhatsApp.'
    ),
    CURLOPT_HTTPHEADER => array(
      'Authorization: Bearer b0e2d3316346b2ba1d585cd7f4e77e8af3cc0349'
    ),
  ));

  // Executar cURL, fechar a conexão, etc.


  $response = curl_exec($curl);
  curl_close($curl);
  echo $response;

  // logger("1", "Debug : Confirmação whatsapp", "#" . $id . "# | response: " . $response . " | A confirmação foi enviada para " . $nomeCompleto . ".");
  logger("1", "Carta convite - Whatsapp", "#" . $info->id . "# | A carta de  " . $info->nome_completo . " foi enviada no numero " . $whatsappContato . ".");
}
