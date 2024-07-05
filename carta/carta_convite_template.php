<!DOCTYPE html>
<html lang="pt">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Carta Convite - {{nome}}</title>
  <style>
    body {
      font-size: 12px;
      font-family: Arial, sans-serif;
      /* background-color: #f4f4f4; */
      margin: 0;
      padding: 20px;
    }



    .container {
      /* background-color: #fff; */
      padding: 0px 20px 20px 20px;
      margin-bottom: 20px;
      /* border: 1px solid #000; */
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 0px;
    }

    th,
    td {
      padding: 10px;
      border: 1px solid #000;
      text-align: left;
    }

    th {
      background-color: #ffe4b3;
      color: #000;
    }

    .title,
    .flight-title {
      background-color: #ffe4b3;
      /* color: white; */
      text-align: center;
      padding: 10px;
      font-size: 20px;
    }

    .highlight {
      background-color: #ffe4b3;
    }

    /* .flight-container {
      background-image: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAA...');
      background-repeat: no-repeat;
      background-position: top center;
      padding-top: 40px;
    } */

    .section-title {
      background-color: #ffe4b3;
      /* color: white; */
      padding: 5px;
      margin-top: 20px;
    }

    .flight-section {
      margin-top: 20px;
      font-size: 10px;
    }
  </style>
</head>

<body>

<div class="header">
  <table style="width: 100%; border-collapse: collapse; border: none;">
    <tr>
      <td style="text-align: left; width: 50%; border: none;">
        <img src="{{logo_dagaz}}" width="200" height="auto" alt="Dagaz Logo">
      </td>
      <td style="text-align: right; width: 50%; border: none;">
        <img src="{{logo_natura}}" style="width: 100px; height: auto;" alt="Natura & Avon Logo">
      </td>
    </tr>
  </table>
</div>


  <div class="container">

    <div class="personal-info-section" style=" padding: 10px; color: black; margin-top: 20px;">
      <h2 style="text-align: center;">Prezado(a) {{nome}}</h2>
      <p>Parabens! Você conquistou a viagem para participar do Evento Destaques em Atibaia de 22 a 24 de Maio e está recebendo sua passagem e informações de hospedagem.</p>

      <h3><b>Orientação para embarque:</b></h3>
      <p>Favor comparecer com no mínimo 02h de antecedência do horário de seu voo no Check-in da Cia aérea, com o localizador e o número do e-ticket abaixo.</p>

      <h3><b>Documentação necessária:</b></h3>
      <p>Carteira de Identidade (RG) original emitido pela Secretaria de Segurança Pública (SSP) de seu estado com menos de 10 anos de expedição (recomendável) ou carteira de habilitação original com foto. Verifique se seu nome está conforme documento que utilizará para embarcar.</p>
      <p>É importante lembrar que é necessário apresentar o documento no momento do embarque, caso contrário, não poderá embarcar.</p>

      <h3><b>Bagagens:</b></h3>
      <p>Por favor, leve sua bagagem devidamente identificada;<br>
        A franquia de bagagem para o voo doméstico Brasil é de 23kg;<br>
        01 bagagem de mão por pessoa de até 10kg dentro das medidas (20x40x55cm)</p>

      <p>Pedimos que verifique se as informações pessoais estão corretas e qualquer problema, entre em contato conosco!</p>
    </div>
    
    <div class="flight-section" id="aereo" style="display:{{display_aereo}};">
      <!-- <div class="title">Voos</div> -->
      <div> <img width="220px" src="{{aviao_ida}}"> </div>
      <div class="title" style="background-color: #FFA500;">IDA</div>
      <table>
        <tr>
          <th>Localizador</th>
          <th>E-ticket</th>
          <th>Data</th>
          <th>CIA/VOO</th>
          <th>Origem</th>
          <th>Destino</th>
          <th>Saída</th>
          <th>Chegada</th>
        </tr>
        <tr>
          <td>{{localizador_ida}}</td>
          <td>{{eticket}}</td>
          <td>{{data_ida}}</td>
          <td>{{cia_voo_ida}}</td>
          <td>{{origem_ida}}</td>
          <td>{{destino_ida}}</td>
          <td>{{saída_ida}}</td>
          <td>{{chegada_ida}}</td>
        </tr>
      </table>

      <div style="text-align: right;"> <img width="220px" src="{{aviao_volta}}"> </div>
      <div class="title" style="background-color: #FFA500;">VOLTA</div>
      <table>
        <tr>
          <th>Localizador</th>
          <th>E-ticket</th>
          <th>Data</th>
          <th>CIA/VOO</th>
          <th>Origem</th>
          <th>Destino</th>
          <th>Saída</th>
          <th>Chegada</th>
        </tr>
        <tr>
          <td>{{localizador_volta}}</td>
          <td>{{eticket}}</td>
          <td>{{data_volta}}</td>
          <td>{{cia_voo_volta}}</td>
          <td>{{origem_volta}}</td>
          <td>{{destino_volta}}</td>
          <td>{{saída_volta}}</td>
          <td>{{chegada_volta}}</td>
        </tr>
      </table>
    </div>

    <div class="pernoite-section" id="pernoite_ida" style="display:{{pdisplay_ernoite_ida}};">
      <div class="title"> PERNOITE HOTEL IDA</div>
      <p>Abaixo seguem informações sobre sua pernoite.<br>
        Reservamos o hotel abaixo para maior conforto em seu deslocamento até o evento.</p>

      <table>
        <tr>
          <th>Hotel</th>
          <td>{{hotel_pernoite_ida}}</td>
        </tr>
        <tr>
          <th>Endereço</th>
          <td>{{endereco_pernoite_ida}}</td>
        </tr>
        <tr>
          <th>Datas</th>
          <td><span class="highlight">Data de entrada</span> {{data_pernoite_ida}}<br>
            <span class="highlight">Data de saída</span> {{data_pernoite_ida}}
          </td>
        </tr>
        <tr>
          <th>Informações Despesas</th>
          <td>{{informacoes_despesas_pernoite_ida}}
        </tr>
      </table>
      <div class="title">PERNOITE HOTEL VOLTA</div>
      <p>Abaixo seguem informações sobre sua pernoite.<br>
        Reservamos o hotel abaixo para maior conforto em seu deslocamento até o evento.</p>
      <table>
        <tr>
          <th>Hotel</th>
          <td>{{hotel_pernoite_volta}}</td>
        </tr>
        <tr>
          <th>Endereço</th>
          <td>{{endereco_pernoite_volta}}</td>
        </tr>
        <tr>
          <th>Datas</th>
          <td><span class="highlight">Data de entrada</span> {{data_pernoite_volta}}<br>
            <span class="highlight">Data de saída</span> {{data_pernoite_volta}}
          </td>
        </tr>
        <tr>
          <th>Informações Despesas</th>
          <td>{{informacoes_despesas_pernoite_volta}}
        </tr>
      </table>
    </div>

    <div class="accommodation-section" style="display:{{display_hotel}}; padding: 10px; text-align: center; margin-top: 20px;">
      <h2>INFORMAÇÕES DE HOSPEDAGEM DO EVENTO</h2>
      <p>Hotel: {{hospedagem_evento_hotel}}</p>
      <p>Data entrada:{{hospedagem_evento_data_entrada}}</p>
      <p>Data saída:{{hospedagem_evento__data_saida}}</p>
      <p>HORARIO CHECK-IN {{hospedagem_evento_checkin}}</p>
      <p>Endereço:</p>
      <p>{{hospedagem_evento_endereco}}</p>
    </div>

    <div class="important-info-section" style=" display:{{display_infos}}; padding: 10px; text-align: center;  margin-top: 20px;">
      <h2><b>
          INFORMAÇÕES IMPORTANTES
        </b>
      </h2>
      <p>Você receberá um guia de viagem que possui diversas recomendações. Sobre trajes, atente-se em levar roupas e sapatos confortáveis para o dia (tênis, sapatilhas, botas ou calçados sem salto) e não esqueça de um casaco leve.<br>
        Já para a Noite de Reconhecimento recomendamos traje social, pois será uma grande festa.<br>
        Não se esqueça dos seus remédios de uso diário habitual.</p>

      <p>Próximo da data do evento você receberá um SMS e e-mail com um link para acesso ao aplicativo do evento, lá você terá acesso aos dados da sua logística e informações importantes do evento.</p>

      <p><b>
          Será um prazer te receber!<br>
          Boa viagem e aproveite!
        </b>
      </p>

      <p>Para dúvidas e informações sobre o evento, ligue para (11) 93946-7929 de segunda a sexta das 09h00 às 18h00<br>
        Para dúvidas com seu transporte durante o período do evento, contate (11) 95942-0122</p>
    </div>

  </div>
</body>

</html>