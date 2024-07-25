<?php include 'users/init.php';


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SENSIA - PARQUE PRADO</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vanilla-masker/1.1.1/vanilla-masker.min.js"></script>
    <style>
        /* Ensures that the body does not overflow the width of the viewport */
        html,
        body {
            max-width: 100%;
            overflow-x: hidden;
        }
    </style>
</head>

<body>
    <!-- Additional content section -->
    <section>
        <main class="container my-1" style="max-width: 750px;">
            <img src="assets/high_level_invite_1.png" alt="Logo" class="img-fluid mb-4">
            <div style="padding:20px; padding-top:10px; padding-bottom:10px;">
                <div>
                    <h1 class="text-center">Faça sua inscrição</h1>
                    <!-- <p class="text-center">Preencha o formulário abaixo para confirmar sua presença no evento.</p> -->
                    <div class="card mb-3 border-warning">
                        <div class="card-body text-warning">
                            <p class="small text-muted">
                                Nota: Para garantir a melhor experiência para todos, permitimos a inscrição em apenas 2 horários por apartamento. Por favor, escolha seus horários de acordo com essa regra.
                            </p>
                        </div>
                    </div>
                </div>
            </div>




            <form id="cadastroForm" novalidate method="post" enctype="multipart/form-data">


                <!-- Nome Completo -->
                <div class="mb-3">
                    <label for="nomeCompleto" class="form-label">Nome Completo <b>*</b></label>
                    <input required name="nomeCompleto" type="text" class="form-control" id="nomeCompleto" value="">
                    <div class="invalid-feedback">
                        Por favor, informe seu nome completo.
                    </div>
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">E-MAIL <b>*</b></label>
                    <input required value="" type="email" class="form-control" id="email" name="email">
                    <div class="invalid-feedback">
                        Informe seu email
                    </div>
                </div>

                

                <!-- Telefone -->
                <div class="mb-3" id="telefoneDiv">
                    <label for="telefone" class="form-label">Whatsapp (com código de país e de área) <b>*</b></label>
                    <input required type="text" class="form-control" id="telefone" name="telefone" placeholder="Ex: (00) 00000-0000">
                </div>

                <!-- apartamento -->
                <div class="mb-3" id="apartamentoDiv">
                    <label for="apartamento" class="form-label">Numero do Apartamento <b>*</b></label>
                    <input required type="text" class="form-control" id="apartamento" name="apartamento">
                </div>

                <!-- Hora de Chegada -->
                <div class="mb-3">
                    <label for="chegada" class="form-label">Que horas você pretende chegar? <b>*</b></label>
                    <select required class="form-select" id="chegada" name="chegada">
                        <option value="">Selecione... / Select...</option>
                        <option value="09h e 11h">Entre 09h e 11h</option>
                        <option value="12h e 14h">Entre 12h e 14h</option>
                        <option value="14h e 16h">Entre 14h e 16h</option>
                    </select>
                    <div class="invalid-feedback">
                        Informe o horário de chegada
                    </div>
                </div>


                <!-- Quantidade de pessoas -->
                <div class="mb-3">
                    <label for="quantidade" class="form-label">Além de você, quantas pessoas que residem na unidade irão comparecer  ao evento? <b>*</b></label>
                    <select required class="form-select" id="quantidade" name="quantidade">
                        <option value="">Selecione... / Select...</option>
                        <!-- 1 pessoa, 2 pessoas e 3 pessoas -->
                        <option value="1">1 pessoa</option>
                        <option value="2">2 pessoas</option>
                        <option value="3">3 pessoas</option>                        
                    </select>
                    <div class="invalid-feedback">
                        Informe o horário de chegada
                    </div>
                </div>

                <!-- Agendamento Aula de Personal -->
                <div class="mb-3">
                    <label for="aulaPersonal" class="form-label">Aula com personal na academia (8 vagas por hora/aula, 30 min cada)</label>
                    <select required class="form-select" id="aulaPersonal" name="aulaPersonal">
                        <option value="">Selecione... / Select...</option>
                        <option value="N">Não quero participar</option>
                        <?php
                        $db = DB::getInstance();
                        $response = $db->query("SELECT * FROM agendamentos WHERE tipo = 'RAM' AND qtd > 0 ");
                        $agendamentos = $response->results();
                        foreach ($agendamentos as $agendamento) {
                            echo '<option data-horario="' . $agendamento->horario . '" value="' . $agendamento->id . '">' . $agendamento->horario . '  (' . $agendamento->qtd . ' vagas )' . '</option>';
                        }
                        ?>
                    </select>
                </div>

                <!-- Agendamento Aula de Tênis -->
                <div class="mb-3">
                    <label for="aulaTenis" class="form-label">Aula de tênis na quadra (8 vagas por hora/aula, 30 min cada)</label>
                    <select required class="form-select" id="aulaTenis" name="aulaTenis">
                        <option value="">Selecione... / Select...</option>
                        <option value="N">Não quero participar</option>
                        <?php
                        $db = DB::getInstance();
                        $response = $db->query("SELECT * FROM agendamentos WHERE tipo = 'RAM II' AND qtd > 0 ");
                        $agendamentos = $response->results();
                        foreach ($agendamentos as $agendamento) {
                            echo '<option  data-horario="' . $agendamento->horario . '" value="' . $agendamento->id . '">' . $agendamento->horario . ' (' . $agendamento->qtd . ' vagas )' . '</option>';
                        }
                        ?>
                    </select>
                </div>

                <!-- cpf -->
                <div class="mb-3">
                    <label for="cpf" class="form-label">CPF DO PARTICIPANTE <b>*</b></label>
                    <input required value="" type="cpf" class="form-control" id="cpf" name="cpf">
                    <div class="invalid-feedback">
                        Informe seu cpf
                    </div>
                    <small class="text-muted">O CPF é obrigatório para a entrada nas aulas.</small>
                </div>

                <!-- <div class="card mb-3">
                    <div class="card-body">
                        <p class="small text-muted">Ao confirmar sua presença, você aceita receber comunicações valiosas do Pacto Global da ONU - Rede Brasil / When confirming your presence, you agree to receive valuable communications from the United Nations Global Compact - Brazil Network.</p>
                    </div>
                </div> -->

                <div id="errorMessage" class="alert alert-danger d-none">Você não pode se inscrever em ambas as aulas no mesmo horário.</div>
                <br>
                <button type="submit" class="btn " style="font-size: larger; background-color: #00261f; color: #fff;">CONFIRMAR MINHA INSCRIÇÃO</button>
            </form>
        </main>
    </section>
    <!-- <section class="text-center mt-5">
        <img src="assets/footer.png" alt="Logo" class="img-fluid mb-4" width="30%" height="auto">
        <p class="text-muted">© 2024 SENSIA - PARQUE PRADO. Todos os direitos reservados.</p>
    </section> -->

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>


    <script src="assets/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/styles.css" rel="stylesheet">


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Check if VanillaMasker is loaded
            if (typeof VanillaMasker === 'undefined') {
                console.error('VanillaMasker is not loaded');
            } else {
                // Apply mask to the phone number input
                var phoneInput = document.getElementById('telefone');
                VMasker(phoneInput).maskPattern('(99) 99999-9999');
            }
        });
    </script>

</body>

</html>