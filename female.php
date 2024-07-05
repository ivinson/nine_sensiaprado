<?php   include 'users/init.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pacto Global</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
            <img src="assets/high_level_invite_2.png" alt="Logo" class="img-fluid mb-4">

            <?php
          
            // verificar se existe uma query string
            if (isset($_GET['p'])) {
                $token_patrocinador = $_GET['p'];
                $db = DB::getInstance();
                $patrocinadores = $db->query("select * from patrocinadores where identificador = '" . $token_patrocinador . "'")->results();

                $has_patrocinador = count($patrocinadores) > 0;
                if (!$has_patrocinador) {
                    // Não existe patrocinador, mostrando mensagem
            ?>
                    <!-- Card de Mensagem de Não Patrocinador -->
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Não existe um patrocinador com esse link</h5>
                            <p class="card-text">Por favor, verifique o link ou entre em contato conosco para assistência.</p>
                        </div>
                    </div>
                <?php
                    die();
                } else {
                    // Existe patrocinador, mostrando o restante da página
                    // Coloque o restante do código aqui
                }
            } else {
                // Não há link de patrocinador
                ?>
                <!-- Card de Mensagem de Link de Patrocinador Ausente -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Não existe link de patrocinador</h5>
                        <p class="card-text">Por favor, forneça um link de patrocinador válido ou procure a origem do seu convite.</p>
                    </div>
                </div>
            <?php
                die();
            }
            ?>




            <div style="padding:20px; padding-top:10px; padding-bottom:10px;">
                <div>
                    <h1 class="text-center">Confirme sua presença</h1>
                    <p class="text-center">Preencha o formulário abaixo para confirmar sua presença no evento.</p>
                </div>
            </div>
            <form id="cadastroForm" novalidate method="post" enctype="multipart/form-data">

                <!-- Hidden Token Input -->
                <input required type="hidden" name="origem" id="origem" value="<?= $token_patrocinador ?>">

                <!-- Nome Completo -->
                <div class="mb-3">
                    <label for="nomeCompleto" class="form-label">Nome Completo / Full Name <b>*</b></label>
                    <input required name="nomeCompleto" type="text" class="form-control" id="nomeCompleto" value="">
                    <div class="invalid-feedback">
                        Por favor, informe seu nome completo. / Inform your full name.
                    </div>
                </div>

                <!-- Nome Social -->
                <div class="mb-3">
                    <label for="nomeSocial" class="form-label">Nome Social / Social Name</label>
                    <input value="" type="text" class="form-control" id="nomeSocial" name="nomeSocial">
                    <div class="invalid-feedback">
                        Informe seu nome social. / Inform your social name.
                    </div>
                </div>

                <!-- Nome para Reconhecimento -->
                <div class="mb-3">
                    <label for="nomeCredencial" class="form-label">Nome para credencial / Name for badge <b>*</b></label>
                    <input required value="" type="text" class="form-control" id="nomeCredencial" name="nomeCredencial">
                    <div class="invalid-feedback">
                        Informe o nome para crencial. / Inform the name for badge.
                    </div>
                </div>

                <!-- Primeiro nome conforme passaporte -->
                <div class="mb-3">
                    <label for="primeiroNomePassaporte" class="form-label">Primeiro nome conforme passporte / First name as stated in your passport <b>*</b></label>
                    <input required value="" type="text" class="form-control" id="primeiroNomePassaporte" name="primeiroNomePassaporte">
                    <div class="invalid-feedback">
                        Informe seu primeiro nome conforme passporte / Inform your first name as stated in your passport.
                    </div>
                </div>

                <!-- Último nome conforme passaporte -->
                <div class="mb-3">
                    <label for="ultimoNomePassaporte" class="form-label">Último nome conforme passaporte / Last name as stated in your passport <b>*</b></label>
                    <input required value="" type="text" class="form-control" id="ultimoNomePassaporte" name="ultimoNomePassaporte">
                    <div class="invalid-feedback">
                        Informe seu último nome conforme passporte / Inform your last name as stated in your passport.
                    </div>
                </div>

                <!-- Número do passaporte -->
                <div class="mb-3">
                    <label for="numeroPassaporte" class="form-label">Número do passaporte / Passport number <b>*</b></label>
                    <input required value="" type="text" class="form-control" id="numeroPassaporte" name="numeroPassaporte">
                    <div class="invalid-feedback">
                        Informe o número do passaporte / Inform the passport number
                    </div>
                </div>

                <!-- Organização -->
                <div class="mb-3">
                    <label for="nomeOrganizacao" class="form-label">Organização / Organization <b>*</b></label>
                    <input required value="" type="text" class="form-control" id="nomeOrganizacao" name="nomeOrganizacao">
                    <div class="invalid-feedback">
                        Informe sua Organização / Inform your Organization.
                    </div>
                </div>

                <!-- Posição -->
                <div class="mb-3">
                    <label for="nomePosicao" class="form-label">Posição / Job Title <b>*</b></label>
                    <input required value="" type="text" class="form-control" id="nomePosicao" name="nomePosicao">
                    <div class="invalid-feedback">
                        Informe sua Posição / Inform your Job Title.
                    </div>
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">E-MAIL Corporativo / Corporative E-MAIL <b>*</b></label>
                    <input required value="" type="email" class="form-control" id="email" name="email">
                    <div class="invalid-feedback">
                        Informe seu email Corporativo / Inform your corporative E-MAIL.
                    </div>
                </div>

                <!-- Telefone -->
                <div class="mb-3" id="telefoneDiv">
                    <label for="telefone" class="form-label">Telefone (com código de país e de área) / Mobile number (with country and area codes): <b>*</b></label>
                    <input required type="text" class="form-control" id="telefone" name="telefone" placeholder="Ex: (00) 00000-0000">
                </div>

                <!-- Autodeclaração de Raça -->
                <div class="mb-3">
                    <label for="autodeclaracaoDeRaca" class="form-label">Autodeclaração de Raça / Self-Declaration of Race <b>*</b></label>
                    <select required class="form-select" id="autodeclaracaoDeRaca" name="autodeclaracaoDeRaca" required>
                        <option value="">Selecione... / Select...</option>
                        <option value="Branca">Branca / White</option>
                        <option value="Parda">Parda / Light Skin</option>
                        <option value="Preta">Preta / Black</option>
                        <option value="Amarela">Amarela / Yellow</option>
                        <option value="Indígena ">Indígena / Indigenous</option>
                    </select>
                    <div class="invalid-feedback">
                        Informe sua Raça / Inform your Race.
                    </div>
                </div>

                <!-- Indentidade de Gênero -->
                <div class="mb-3">
                    <label for="identidadeDeGenero" class="form-label">Autodeclaração de Indentidade de Gênero / Self-Declaration of Gender <b>*</b></label>
                    <select required class="form-select" id="identidadeDeGenero" name="identidadeDeGenero">
                        <option value="">Selecione... / Select...</option>
                        <option value="HOMEMCISGENERO">HOMEM CISGÊNERO - CISGENDER MAN</option>
                        <option value="HOMEMTRANS">HOMEM TRANS - TRANS MAN</option>
                        <option value="MULHERCISGENERO">MULHER CISGÊNERO - CISGENDER WOMAN</option>
                        <option value="MULHERTRANS">MULHER TRANS - TRANS WOMAN</option>
                        <option value="NAOBINARIO">NÃO BINÁRIO - NON - BINARY</option>
                        <option value="OUTRO">OUTRO - OTHER</option>
                        <option value="NAOQUERODECLARAR">NÃO QUERO DECLARAR - I DONT WANT TO DECLARE</option>
                    </select>
                    <div class="invalid-feedback">
                        Informe sua Identidade de Gênero / Inform your Self-Declaration of Gender.
                    </div>
                </div>

                <!-- Orientação Afetivo-Sexual -->
                <div class="mb-3">
                    <label for="orientacaoAfetivoSexual" class="form-label">Autodeclaração de Orientação Afetivo-Sexual / Affective-Sexual Orientation <b>*</b></label>
                    <select required class="form-select" id="orientacaoAfetivoSexual" name="orientacaoAfetivoSexual">
                        <option value="">Selecione... / Select...</option>
                        <option value="HETEROSSEXUAL">HETEROSSEXUAL</option>
                        <option value="HOMOSSEXUAL">HOMOSSEXUAL</option>
                        <option value="BISSEXUAL">BISSEXUAL</option>
                        <option value="OUTRO">OUTRO - OTHER</option>
                        <option value="NAOQUERODECLARAR">NÃO QUERO DECLARAR - DO NOT WANT TO DISCLOSE</option>
                    </select>
                    <div class="invalid-feedback">
                        Informe sua Orientação Afetivo-Sexual / Inform your Affective-Sexual Orientation.
                    </div>
                </div>

                <!-- É PCD? -->
                <div class="mb-3">
                    <label for="recursosAcessibilidade" class="form-label">Possui alguma deficiência e necessita de algum tipo de acessibilidade / You have some disability and need some kind of accessibility? <b>*</b></label>
                    <select required class="form-select" id="recursosAcessibilidade" name="recursosAcessibilidade" onchange="toggleOutro(this)">
                        <option value="">Selecione... / Select...</option>
                        <option value="Sim">Sim - Yes</option>
                        <option value="Nao">Não - No</option>
                    </select>
                    <input type="text" class="form-control mt-2" id="outroInputRecursoAcessibilidade" name="outroInputRecursoAcessibilidade" style="display: none;" placeholder="Especifique...">
                    <div class="invalid-feedback">
                        Por favor, selecione ou especifique o recurso necessário / Please select or specify the required resource.
                    </div>
                </div>

                <script>
                    function toggleOutro(select) {
                        var outroInputRestricaoAlimentarAcessibilidade = document.getElementById('outroInputRecursoAcessibilidade');
                        // Mostra o campo de entrada se a opção 'Outro' for selecionada
                        outroInputRestricaoAlimentarAcessibilidade.style.display = select.value === 'outro' ? 'block' : 'none';
                    }
                </script>

                <!-- Número de colaboradores da empresa -->
                <div class="mb-3">
                    <label for="numeroDeColaboradores" class="form-label">Sua empresa tem mais de 250 colaboradores? / Does your organization has more than 250 employees? <b>*</b></label>
                    <select required class="form-select" id="numeroDeColaboradores" name="numeroDeColaboradores">
                        <option value="">Selecione... / Select...</option>
                        <option value="Sim">Sim- Yes</option>
                        <option value="Nao">Não - No</option>
                    </select>
                </div>

                <!-- Participa do pacto? -->
                <div class="mb-3">
                    <label for="participaDoPacto" class="form-label">Sua empresa é participante do Pacto Global da ONU - Rede Brasil? / Is your company participant of United Nations Global Compact - Brazil Network? <b>*</b></label>
                    <select required class="form-select" id="participaDoPacto" name="participaDoPacto">
                        <option value="">Selecione... / Select...</option>
                        <option value="Sim">Sim - Yes</option>
                        <option value="Nao">Não - No</option>
                    </select>
                </div>

                <!-- Por onde recebeu o convite -->
                <div class="mb-3">
                    <label for="origemConvite" class="form-label">Por onde recebeu o convite para o evento? / Where did you receive the invitation for the event? <b>*</b></label>
                    <input required value="" type="text" class="form-control" id="origemConvite" name="origemConvite">
                </div>

                <div class="card mb-3">
                    <div class="card-body">
                        <!-- <h5 class="card-title">LGPD – Termos e Condições</h5> -->
                        <!-- <p class="card-text">Autorização de imagem</p> -->
                        <!-- <div class="mb-3 form-check">
                            <input required type="checkbox" class="form-check-input" id="autorizacaoImagem" name="autorizacaoImagem">
                            Declaro que Li e Autorizo a utilização de minha imagem para este evento nos termos aqui presente.
                        </div> -->

                        <p class="small text-muted">Ao confirmar sua presença, você aceita receber comunicações valiosas do Pacto Global da ONU - Rede Brasil / When confirming your presence, you agree to receive valuable communications from the United Nations Global Compact - Brazil Network.</p>
                    </div>
                </div>

                <script>
                    function toggleTelefone(value) {
                        var telefoneDiv = document.getElementById('telefoneDiv');
                        telefoneDiv.style.display = (value === 'Sim') ? 'block' : 'none';
                    }
                </script>


                <button type="submit" class="btn " style="background-color: #283e46; color: #fff;">CONFIRMAR MEUS DADOS</button>
            </form>

        </main>
    </section>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/vanilla-masker@1.2.0/build/vanilla-masker.min.js"></script>

    <link href="assets/styles.css" rel="stylesheet">
</body>

</html>