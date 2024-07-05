<?php
require_once 'users/init.php';
$db = DB::getInstance();
$id = $_GET['token'];
$convidado = $db->get('convidados', array('id', '=', $id))->first();


?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PVE </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/vanilla-masker@1.2.0/build/vanilla-masker.min.js"></script>

    <link href="assets/styles.css" rel="stylesheet">

    <script src="assets/scripts.js"></script>
</head>

<body>
    <header class="container-fluid" style="max-width: 750px;">
        <img src="assets/high_level_invite_1.png" class="img-fluid" alt="Imagem Responsiva">
    </header>

    <main class="container my-4" style="max-width: 750px;">

        <div style="padding:20px; padding-top:10px; padding-bottom:10px;">
            <div>
                <!-- Nossos números para esse evento
                    Receptivo por telefone – 11 4210-5082
                    Whats – 11 97824-8304 -->

                Olá <b><?php echo strtoupper($convidado->nome_completo); ?></b>,<br>
                Para confirmar sua presença, preencha os campos abaixo.
                <br>Em caso de dúvidas entre em contato através do WhatsApp&nbsp;
                <a href="https://wa.me?5511xxxxxxxxx"><b>(11) xxxxx-xxxx</b></a>.
            </div>
        </div>

        <form id="cadastroForm" novalidate method="post" enctype="multipart/form-data">

            <!-- Hidden Token Input -->
            <input required type="hidden" name="token" id="token" value="<?= $id ?>">

            <!-- Nome Completo -->
            <div class="mb-3">
                <label for="nomeCompleto" class="form-label">Nome Completo / Full Name </label>
                <input required name="nomeCompleto" type="text" class="form-control" id="nomeCompleto" value="<?php echo $convidado->nome_completo; ?>">
                <div class="invalid-feedback">
                    Por favor, informe seu nome completo. / Inform your full name.
                </div>
            </div>

            <!-- Nome Social -->
            <div class="mb-3">
                <label for="nomeSocial" class="form-label">Nome Social / Social Name</label>
                <input required value="<?= $convidado->nome_preferido ?>" type="text" class="form-control" id="nomeSocial" name="nomeSocial">
                <div class="invalid-feedback">
                    Informe seu nome social. / Inform your social name.
                </div>
            </div>
            
            <!-- Nome para Reconhecimento -->
            <div class="mb-3">
                <label for="nomeCredencial" class="form-label">Nome para credencial / Name for badge </label>
                <input required value="<?= $convidado->nome_preferido ?>" type="text" class="form-control" id="nomeCredencial" name="nomeCredencial">
                <div class="invalid-feedback">
                Informe o nome para crencial. / Inform the name for badge.
                </div>
            </div>

            <!-- Primeiro nome conforme passaporte -->
            <div class="mb-3">
                <label for="primeiroNomePassaporte" class="form-label">Primeiro nome conforme passporte / First name as stated in your passport </label>
                <input required value="<?= $convidado->nome_preferido ?>" type="text" class="form-control" id="primeiroNomePassaporte" name="primeiroNomePassaporte">
                <div class="invalid-feedback">
                Informe seu primeiro nome conforme passporte / Inform your first name as stated in your passport.
                </div>
            </div>

            <!-- Último nome conforme passaporte -->
            <div class="mb-3">
                <label for="ultimoNomePassaporte" class="form-label">Último nome conforme passaporte / Last name as stated in your passport </label>
                <input required value="<?= $convidado->nome_preferido ?>" type="text" class="form-control" id="ultimoNomePassaporte" name="ultimoNomePassaporte">
                <div class="invalid-feedback">
                Informe seu último nome conforme passporte / Inform your last name as stated in your passport.
                </div>
            </div>

            <!-- Número do passaporte -->
            <div class="mb-3">
                <label for="numeroPassaporte" class="form-label">Número do passaporte / Passport number </label>
                <input required value="<?= $convidado->nome_preferido ?>" type="text" class="form-control" id="numeroPassaporte" name="numeroPassaporte">
                <div class="invalid-feedback">
                Informe o número do passaporte / Inform the passport number
                </div>
            </div>

            <!-- Organização -->
            <div class="mb-3">
                <label for="nomeOrganizacao" class="form-label">Organização /  Organization </label>
                <input required value="<?= $convidado->nome_preferido ?>" type="text" class="form-control" id="nomeOrganizacao" name="nomeOrganizacao">
                <div class="invalid-feedback">
                Informe sua Organização / Inform your Organization.
                </div>
            </div>

            <!-- Posição -->
            <div class="mb-3">
                <label for="nomePosicao" class="form-label">Posição /  Job Title </label>
                <input required value="<?= $convidado->nome_preferido ?>" type="text" class="form-control" id="nomePosicao" name="nomePosicao">
                <div class="invalid-feedback">
                Informe sua Posição / Inform your Job Title.
                </div>
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">E-MAIL Corporativo / Corporative E-MAIL</label>
                <input required value="<?= $convidado->email ?>" type="email" class="form-control" id="email" name="email">
                <!-- <input type="hidden" name="emailhdd" value="<?= $convidado->email ?>"> -->
                <div class="invalid-feedback">
                    Informe seu email Corporativo / Inform your corporative E-MAIL.
                </div>
            </div>

            <!-- Telefone -->
            <div class="mb-3" id="telefoneDiv">
                <label for="telefone" class="form-label">Telefone (com código de país e de área) / Mobile number (with country and area codes):</label>
                <input type="text" class="form-control" id="telefone" name="telefone" placeholder="Ex: (00) 00000-0000">
            </div>

            <!-- Autodeclaração de Raça -->
            <div class="mb-3">
                <label for="autodeclaracaoDeRaca" class="form-label">Autodeclaração de Raça / Self-Declaration of Race</label>
                <select class="form-select" id="autodeclaracaoDeRaca" name="autodeclaracaoDeRaca" required>
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
                <label for="identidadeDeGenero" class="form-label">Autodeclaração de Indentidade de Gênero / Self-Declaration of Gender</label>
                <select required class="form-select" id="identidadeDeGenero" name="identidadeDeGenero">
                    <option value="">Selecione... / Select...</option>
                    <option value="XXXX">XXXX</option>
                    <option value="XXXX">XXXX</option>
                    <option value="XXXX">XXXX</option>
                    <option value="XXXX">XXXX</option>
                    <option value="XXXX">XXXX</option>
                </select>
                <div class="invalid-feedback">
                    Informe sua Identidade de Gênero / Inform your Self-Declaration of Gender.
                </div>
            </div>

            <!-- Orientação Afetivo-Sexual -->
            <div class="mb-3">
                <label for="orientacaoAfetivoSexual" class="form-label">Autodeclaração de Orientação Afetivo-Sexual / Affective-Sexual Orientation</label>
                <select required class="form-select" id="orientacaoAfetivoSexual" name="orientacaoAfetivoSexual">
                    <option value="">Selecione... / Select...</option>
                    <option value="XXXX">XXXX</option>
                    <option value="XXXX">XXXX</option>
                    <option value="XXXX">XXXX</option>
                    <option value="XXXX">XXXX</option>
                    <option value="XXXX">XXXX</option>
                </select>
                <div class="invalid-feedback">
                    Informe sua Orientação Afetivo-Sexual / Inform your Affective-Sexual Orientation.
                </div>
            </div>

            <!-- É PCD? -->
            <div class="mb-3">
                <label for="recursosAcessibilidade" class="form-label">Possui alguma deficiência e necessita de algum tipo de acessibilidade / You have some disability and need some kind of accessibility?</label>
                <select required class="form-select" id="recursosAcessibilidade" name="recursosAcessibilidade" onchange="toggleOutro(this)">
                    <option value="">Selecione... / Select...</option>
                    <option value="interprete_libras">Intérprete de libras</option>
                    <option value="materiais_baixa_visao">Materiais adaptados para baixa visão</option>
                    <option value="assentos_especiais">Assentos especiais</option>
                    <option value="outro">Outro:</option>
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
                <label for="numeroDeColaboradores" class="form-label">Sua empresa tem mais de 250 colaboradores? / Does your organization has more than 250 employees?</label>
                <select required class="form-select" id="numeroDeColaboradores" name="numeroDeColaboradores">
                    <option value="">Selecione... / Select...</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>

            <!-- Participa do pacto? -->
            <div class="mb-3">
                <label for="participaDoPacto" class="form-label">Sua empresa é participante do Pacto Global da ONU - Rede Brasil? / Is your company participant of United Nations Global Compact - Brazil Network?</label>
                <select required class="form-select" id="participaDoPacto" name="participaDoPacto">
                    <option value="">Selecione... / Select...</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                </select>
            </div>

            <!-- Por onde recebeu o convite -->
            <div class="mb-3">
                <label for="nomePosicao" class="form-label">Por onde recebeu o convite para o evento? / Where did you receive the invitation for the event?</label>
                <input required value="<?= $convidado->nome_preferido ?>" type="text" class="form-control" id="nomePosicao" name="nomePosicao">
            </div>

            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">LGPD – Termos e Condições</h5>
                    <p class="card-text">Autorização de imagem</p>
                    <div class="mb-3 form-check">
                        <input required type="checkbox" class="form-check-input" id="autorizacaoImagem" name="autorizacaoImagem">
                        Declaro que Li e Autorizo a utilização de minha imagem para este evento nos <a href="#" data-bs-toggle="modal" data-bs-target="#myModal"> termos aqui presente.</a>
                    </div>

                    <p class="small text-muted">Os contatos serão utilizados exclusivamente para confirmação de presença e envio de informações sobre o evento. As informações não serão utilizadas posteriormente.</p>
                </div>
            </div>

            <script>
                function toggleTelefone(value) {
                    var telefoneDiv = document.getElementById('telefoneDiv');
                    telefoneDiv.style.display = (value === 'Sim') ? 'block' : 'none';
                }
            </script>

            <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">LGPD & Autorização de Uso de Imagem</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <b>

                            </b>

                            <p>Ao registrar-se para participar deste evento, você, identificado(a) pelo preenchimento dos seus dados pessoais neste formulário, concede à [Nome da Organização], inscrita no CNPJ sob o nº [inserir CNPJ], localizada em [endereço completo], o direito de uso de sua imagem, voz e demais elementos característicos, captados durante as atividades do evento denominado [Nome do Evento].</p>

                            <p>Este consentimento inclui o direito de reproduzir, divulgar e exibir suas imagens, em partes ou no todo, em materiais como, mas não limitado a, fotografias, vídeos e transmissões ao vivo, para fins de divulgação e promoção das atividades da organização. As imagens poderão ser utilizadas em impressos, publicações digitais, redes sociais, sites, e outros meios de comunicação, sem restrição de prazo, número de exibições ou território.</p>

                            <p>Por este instrumento, você declara que a autorização foi dada gratuitamente, sem que haja quaisquer ônus ou compensação pela utilização das imagens e que esta autorização não representa compromisso de veiculação nem de pagamento.</p>

                            <p>Você reconhece e concorda que as imagens podem ser editadas e adaptadas conforme necessário pela [Nome da Organização] sem necessidade de nova autorização. Este consentimento é irrevogável e global, e confirma sua compreensão de que não terá direito a qualquer compensação financeira pela utilização das imagens que são objeto deste documento.</p>

                            <p>Você poderá solicitar, a qualquer momento, a revogação deste consentimento, mediante notificação escrita à organização, sujeito à observância dos prazos legais e contratuais aplicáveis.</p>

                            <p>Este documento é regido pela Lei Geral de Proteção de Dados (LGPD), Lei nº 13.709/2018, e pelo marco civil da internet, Lei nº 12.965/2014, assegurando a proteção de seus dados pessoais e o direito à privacidade.</p>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn " style="background-color: #283e46; color: #fff;">CONFIRMAR MEUS DADOS</button>
        </form>

    </main>
    <br>
    <br>
    <br>

    <footer class="text-center p-3">
        Desenvolvido por Nine O'Clock 2024
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var whatsappInput = document.getElementById('telefone');
            if (whatsappInput) {
                VMasker(whatsappInput).maskPattern("(99) 99999-9999");
            }
        });
    </script>