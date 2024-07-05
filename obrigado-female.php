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
        <img src="assets/high_level_invite_2.png" width="700px" height="auto" class="img-fluid" alt="Imagem Responsiva">
    </header>

    <div class="container py-0" style="max-width: 730px;">

        <div id="msgUpload"></div>

        <?php

        echo '<div class="alert alert-info" role="alert">';
        echo '<h1 class="alert-heading">Obrigado por se inscrever!</h1>';
        echo '<p>
            Sua inscrição foi realizada com sucesso / Your registration for the UN Global Compact side event has been completed.
            </p>';
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
