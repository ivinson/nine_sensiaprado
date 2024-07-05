<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Natura </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/styles.css" rel="stylesheet">

    <script src="assets/scripts.js"></script>
</head>
<body>
    <header class="container-fluid">
        <img src="assets/top.png" class="img-fluid" alt="Imagem Responsiva">
    </header>

    <main class="container my-4" style="max-width: 750px;">
    <form id="cadastroForm" novalidate>
        <!-- Nome Completo -->
        <div class="mb-3">
            <label for="nomeCompleto" class="form-label">Nome Completo conforme documento para embarque no aeroporto</label>
            <input type="text" class="form-control" id="nomeCompleto" required>
            <div class="invalid-feedback">
                Por favor, informe seu nome completo.
            </div>
        </div>

        <!-- Meio de Transporte para o Evento -->
        <div class="mb-3">
            <label for="meioTransporte" class="form-label">Qual meio de transporte você utilizará para chegar ao evento?</label>
            <select class="form-select" id="meioTransporte" required>
                <option value="">Selecione...</option>
                <option value="aereo">Aéreo</option>
                <option value="carroProprio">Carro Próprio</option>
                <option value="transferEvento">Transfer do Evento no Ponto de Encontro em SP</option>
                <option value="outro">Outro</option>
            </select>
            <div class="invalid-feedback">
                Por favor, informe o meio de transporte para o evento.
            </div>
        </div>

        <!-- Especificar Outro Meio de Transporte -->
        <div class="mb-3">
            <label for="outroMeioTransporte" class="form-label">Se outro na pergunta acima, especificar</label>
            <input type="text" class="form-control" id="outroMeioTransporte">
        </div>



        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
</main>


    <footer class="text-center p-3">
        Desenvolvido por @Nineonclock 2024
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>