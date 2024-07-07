<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agradecimento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/styles.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
    <style>
        .whatsapp-btn {
            background-color: #25d366;
            /* Cor de fundo do WhatsApp */
            border-color: #25d366;
            /* Cor da borda */
            color: white;
            /* Cor do texto */
        }

        .whatsapp-btn:hover {
            background-color: #128c7e;
            /* Cor de fundo ao passar o mouse */
            border-color: #128c7e;
            /* Cor da borda ao passar o mouse */
        }

        .info-icon {
            color: #007bff;
            font-size: 24px;
            /* Tamanho do ícone */
            margin-right: 15px;
        }

        .danger-icon {
            color: red;
            font-size: 24px;
            /* Tamanho do ícone */
            margin-right: 15px;
        }

        .media-body {
            padding-top: 5px;
        }

        .list-unstyled {
            padding-left: 0;
            list-style: none;
        }

        @media (max-width: 768px) {
            .info-icon {
                font-size: 1.5rem;
                /* Tamanho do ícone para telas pequenas */
            }

            header img {
                max-width: 100%;
                height: auto;
            }
        }
    </style>
</head>

<body>


    <header class="container-fluid text-center">
        <img src="assets/high_level_invite_1.png" width="700px" height="auto" class="img-fluid" alt="Imagem Responsiva">
    </header>

    <div class="container py-0" style="max-width: 730px;">



        <?php

        require_once 'users/init.php';
        // session_start();
        $dados =    $_SESSION['data'];
        $db = DB::getInstance();

        if ($dados['aula_personal'] != 'N') {
            $horariopersonal = $db->query("SELECT horario FROM agendamentos WHERE  tipo = 'personal' AND id = " . $dados['aula_personal'])->first()->horario;
        }else{
            $horariopersonal = 'Não irá fazer aula personal';
        }

        if ($dados['aula_tenis'] != 'N') {
            $horarioTenis = $db->query("SELECT horario FROM agendamentos WHERE  tipo = 'tenis' AND id = " . $dados['aula_tenis'])->first()->horario;
        }else{
            $horarioTenis = 'Não irá fazer aula de tênis';
        }
        
        
        

        echo '<ul class="list-unstyled">';
        echo '<div class="alert alert-success" role="alert">';
        echo '<h1 class="alert-heading">INSCRIÇÃO RELIZADA!</h1>';
        echo '<p>
            Não esqueça seus horarios de aula, e se precisar de algo, estamos a disposição.            
        </p>';
        echo '<li><strong>Nome:</strong> ' . $dados['nome_completo'] . '</li>';
        echo '<li><strong>Email:</strong> ' . $dados['email'] . '</li>';
        echo '<li><strong>Telefone:</strong> ' . $dados['telefone'] . '</li>';
        echo '<li><strong>Apartamento:</strong> ' . $dados['apartamento'] . '</li>';
        echo '<li><strong>Horário de Chegada:</strong> ' . $dados['chegada'] . '</li>';
        echo '<li><strong>Aula Personal:</strong> ' . $horariopersonal . '</li>';
        echo '<li><strong>Aula de Tênis:</strong> ' . $horarioTenis  . '</li>';
        echo '</ul>';
        echo '</div>';
        echo '</div>';

        ?>


        <br>
        <br>
        <br>
    </div>

    <!-- <footer class="text-center p-3">
        Desenvolvido por Nine O'Clock 2024
    </footer> -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>