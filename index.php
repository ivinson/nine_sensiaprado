<?php include 'users/init.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FESTIVAL DE INTERLAGOS - AGENDAMENTO DE TEST DRIVE</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vanilla-masker/1.1.1/vanilla-masker.min.js"></script>
    <style>
        html,
        body {
            max-width: 100%;
            overflow-x: hidden;
        }

        .spinner-border {
            width: 1rem;
            height: 1rem;
            border-width: 0.2em;
            vertical-align: middle;
            display: inline-block;
            margin-left: 10px;
        }

        .spinner-border.text-primary {
            color: #007bff;
        }

        .sr-only {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            border: 0;
        }

        valid-feedback {
            color: green !important;
        }
    </style>
</head>

<body>
    <section>
        <main class="container my-1" style="max-width: 750px;">
            <img src="assets/topo_ram.png" alt="Logo" class="img-fluid mb-4">
            <div style="padding:0px; padding-top:10px; padding-bottom:10px;">
                <div>
                    <div class="card mb-3 border-danger">
                        <div class="card-body text-dander">
                            <h1 class="text-center">FAÇA SEU AGENDAMENTO</h1>
                            <p class="small text-muted">
                                Nota: Para garantir a melhor experiência para todos,
                                só será permitido realizar o test-drive no horário que
                                consta no convite do convidado, mediante a apresentação
                                da CNH.
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

                <!-- CPF -->
                <div class="mb-3">
                    <label for="cpf" class="form-label">CPF <b>*</b></label>
                    <input required type="text" class="form-control" id="cpf" name="cpf">
                    <div class="invalid-feedback">
                        Ops! Observe o CPF informado.
                    </div>
                    <div class="valid-feedback">
                        CPF disponível.
                    </div>
                    <small id="cpfFeedback" class="text-muted">O CPF é obrigatório para a entrada.</small>
                    <div id="loading" class="spinner-border text-primary" role="status" style="display:none;">
                        <span class="sr-only">Verificando...</span>
                    </div>
                </div>
                <!-- validacao cpf -->
                <script>
                    function validarCPF(cpf) {
                        cpf = cpf.replace(/[^\d]+/g, '');
                        if (cpf.length !== 11 || /^(\d)\1+$/.test(cpf)) return false;

                        let soma = 0;
                        for (let i = 0; i < 9; i++) {
                            soma += parseInt(cpf.charAt(i)) * (10 - i);
                        }

                        let resto = 11 - (soma % 11);
                        if (resto === 10 || resto === 11) resto = 0;
                        if (resto !== parseInt(cpf.charAt(9))) return false;

                        soma = 0;
                        for (let i = 0; i < 10; i++) {
                            soma += parseInt(cpf.charAt(i)) * (11 - i);
                        }

                        resto = 11 - (soma % 11);
                        if (resto === 10 || resto === 11) resto = 0;
                        if (resto !== parseInt(cpf.charAt(10))) return false;

                        return true;
                    }

                    function verificarCPFNoBanco(cpf, callback) {
                        var xhr = new XMLHttpRequest();
                        xhr.open('GET', 'get-cpf.php?cpf=' + cpf, true);
                        xhr.onload = function() {
                            if (xhr.status === 200) {
                                callback(xhr.responseText);
                            }
                        };
                        xhr.send();
                    }

                    document.getElementById('cpf').addEventListener('blur', function(event) {
                        var cpfInput = document.getElementById('cpf');
                        var cpfFeedback = document.getElementById('cpfFeedback');
                        var loadingIndicator = document.getElementById('loading');
                        var cpf = cpfInput.value;

                        if (!validarCPF(cpf)) {
                            cpfInput.setCustomValidity('CPF inválido');
                            cpfInput.classList.add('is-invalid');
                            cpfFeedback.textContent = 'Informe um CPF válido.';
                            event.preventDefault();
                        } else {
                            cpfInput.setCustomValidity('');
                            cpfInput.classList.remove('is-invalid');
                            cpfFeedback.textContent = 'Verificando...';
                            loadingIndicator.style.display = 'inline-block';

                            verificarCPFNoBanco(cpf, function(response) {
                                loadingIndicator.style.display = 'none';
                                if (response.includes('ja cadastado')) {
                                    cpfInput.setCustomValidity('CPF já cadastrado');
                                    cpfInput.classList.add('is-invalid');
                                    cpfFeedback.textContent = 'CPF já cadastrado.';
                                    event.preventDefault();
                                } else {
                                    cpfInput.setCustomValidity('');
                                    cpfInput.classList.remove('is-invalid');
                                    cpfFeedback.textContent = 'CPF disponível.';
                                }
                            });
                        }
                    });
                </script>




                <!-- Telefone -->
                <div class="mb-3">
                    <label for="telefone" class="form-label">Telefone <b>*</b></label>
                    <input required type="text" class="form-control" id="telefone" name="telefone" placeholder="Ex: (00) 00000-0000">
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">E-mail <b>*</b></label>
                    <input required type="email" class="form-control" id="email" name="email">
                    <div class="invalid-feedback">
                        Informe seu email.
                    </div>
                </div>

                <!-- Data do Convite -->
                <div class="mb-3">
                    <label for="dataConvite" class="form-label">Data do Convite <b>*</b></label>
                    <select required class="form-select" id="dataConvite" name="dataConvite">
                        <option value="">Selecione... / Select...</option>
                        <option value="1">9 de agosto 2024</option>
                        <option value="2">10 de agosto 2024</option>
                        <option value="3">11 de agosto 2024</option>
                    </select>
                    <div class="invalid-feedback">
                        Informe a data do convite.
                    </div>
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        document.getElementById('dataConvite').addEventListener('change', function(event) {
                            var dataConvite = document.getElementById('dataConvite').value;
                            // var carroEscolhido = document.getElementById('carroEscolhido').value;
                            var errorMessage = document.getElementById('errorMessage');
                            errorMessage.classList.add('d-none');

                            if (dataConvite) {
                                fetch('get-horarios.php?id_convite=' + dataConvite)
                                    .then(response => {
                                        if (!response.ok) {
                                            throw new Error('Erro na resposta da requisição');
                                        }
                                        return response.text();
                                    })
                                    .then(data => {
                                        var horariosSelect = document.getElementById('carroEscolhido');
                                        horariosSelect.innerHTML = data;
                                    })
                                    .catch(error => {
                                        console.error('Erro na requisição:', error);
                                        errorMessage.textContent = 'Erro ao carregar os horários disponíveis.';
                                        errorMessage.classList.remove('d-none');
                                    });
                            }
                        });
                    });
                </script>


                <!-- Agendamento Carro -->
                <div class="mb-3">
                    <label for="carroEscolhido" class="form-label">Agendamento</label>
                    <select required class="form-select" id="carroEscolhido" name="carroEscolhido">
                        <option value="">Selecione... / Select...</option>
                        <option value="N">Não quero participar</option>
                        <?php
                        // $db = DB::getInstance();
                        // $response = $db->query("SELECT * FROM agendamentos WHERE  qtd > 0 ");
                        // $agendamentos = $response->results();
                        // foreach ($agendamentos as $agendamento) {
                        //     echo '<option data-horario="' . $agendamento->horario . '" value="' . $agendamento->id . '">Commander - ' . $agendamento->horario . '  (' . $agendamento->qtd . ' vagas )' . '</option>';
                        // }
                        ?>
                    </select>
                </div>

                <!-- Concessionária Convidando -->
                <div class="mb-3">
                    <label for="concessionaria" class="form-label">Concessionária Convidando <b>*</b></label>
                    <select required class="form-select" id="concessionaria" name="concessionaria">
                        <option value="">Selecione... / Select...</option>
                        <option value="DAHRUJ">DAHRUJ</option>
                        <option value="SINAL">SINAL</option>
                        <option value="OUTRA">OUTRA</option>
                    </select>
                    <div class="invalid-feedback">
                        Informe a concessionária convidando.
                    </div>
                </div>

                <div id="errorMessage" class="alert alert-danger d-none">Você não pode se inscrever em ambas as aulas no mesmo horário.</div>
                <br>
                <button type="submit" class="btn" style="font-size: larger; background-color: #000; color: #fff;">CONFIRMAR MINHA INSCRIÇÃO</button>
            </form>
        </main>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/styles.css" rel="stylesheet">

    <script>
        // document.addEventListener('DOMContentLoaded', function() {
        //     if (typeof VanillaMasker === 'undefined') {
        //         console.error('VanillaMasker is not loaded');
        //     } else {
        //         var phoneInput = document.getElementById('telefone');
        //         VMasker(phoneInput).maskPattern('(99) 99999-9999');
        //     }
        // });
    </script>
</body>

</html>