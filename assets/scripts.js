
// Path: assets/scripts.js
// funcao que valida o formulario de cadastro
//------------------------------------------------------------------------------
document.addEventListener('DOMContentLoaded', function () {


  document.getElementById('cadastroForm').addEventListener('submit', function (event) {
    event.preventDefault();
    event.stopPropagation();



    //verificar se horarios de aula de tenis e personal sao as mesmas antes de continuar
    var aulaPersonal = document.getElementById('aulaPersonal').value;
    var aulaTenis = document.getElementById('aulaTenis').value;
    var errorMessage = document.getElementById('errorMessage');

    if (aulaPersonal && aulaTenis && aulaPersonal === aulaTenis) {
      errorMessage.classList.remove('d-none');
    } else {
      errorMessage.classList.add('d-none');
      // Mostrar swal ao iniciar o envio
      Swal.fire({
        // icon: 'error',
        title: 'Atenção!',
        text: 'Você não pode se inscrever em ambas as aulas no mesmo horário, e deve preencher todos os dados obrigatórios.'
      });

      return false;

    }

  });



  var form = document.getElementById('cadastroForm');
  if (!form) return;

  var isSubmitting = false; // Variável para rastrear o status de envio
  form.addEventListener('submit', function (event) {

    event.preventDefault();
    if (form.checkValidity() === false) {
      event.stopPropagation();
    } else if (!isSubmitting) {

      isSubmitting = true; // Indica que um envio está em progresso

      var submitButton = event.target.querySelector('button[type="submit"]');
      submitButton.disabled = true;
      submitButton.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Enviando informações...'; // Adiciona ícone de carregamento e texto

      // Mostrar swal ao iniciar o envio
      Swal.fire({
        title: 'Enviando informações...',
        text: 'Por favor, aguarde.',
        didOpen: () => {
          Swal.showLoading()
        },
        allowOutsideClick: false,
        allowEscapeKey: false,
        allowEnterKey: false
      });

      fetch('salvar_process.php', {
        method: 'POST',
        body: new FormData(form)
      })
        .then(response => {
          isSubmitting = false;
          console.log(response);
          if (response.status === 200) {
            // Fechar swal após o envio bem-sucedido
            Swal.close();
            window.location.href = 'obrigado.php';
          } else {
            console.error('#1: Erro ao processar o formulário - Status: ', response.status);
            submitButton.disabled = false;
            submitButton.innerHTML = 'CONFIRMAR MEUS DADOS'; // Restaura o texto original do botão
            // Fechar swal e mostrar erro
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'Erro ao processar o formulário. Tente novamente.'
            });
          }
        })
        .catch(error => {
          isSubmitting = false;
          console.error('#2: Erro ao enviar o formulário', error);
          submitButton.disabled = false;
          submitButton.innerHTML = 'CONFIRMAR MEUS DADOS'; // Restaura o texto original do botão
          // Fechar swal e mostrar erro
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Erro ao enviar o formulário. Tente novamente.'
          });
        });


    }
    form.classList.add('was-validated');
  }, false);
});



//------------------------------------------------------------------------------
// Funções de validação
//------------------------------------------------------------------------------

// funcao para validar o email via regex
function validateEmailFormat(email) {
  var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return emailRegex.test(email);
}

//------------------------------------------------------------------------------
// Função que valida o email
//------------------------------------------------------------------------------
function validaEmail() {
  var email = document.getElementById('inputEmail').value;
  if (!validateEmailFormat(email)) {
    alert("Formato de email inválido");
    return false;
  }

  var form = document.getElementById('emailForm');

  fetch('buscar_email.php', {
    method: 'POST',
    body: new FormData(form)
  })
    .then(response => response.json()) // Processa a resposta como JSON
    .then(data => {
      if (data.status === "found") {
        // alert(data.status_cadastro);

        // Aproveita o ID retornado
        let userId = data.id;

        if (data.status_cadastro === "preenchido") {
          // Redireciona para a página de agradecimento
          window.location.href = 'obrigado.php?action=atualizado&token=' + userId;
        } else {
          // Redireciona para a página de atualização
          window.location.href = 'atualiza.php?token=' + userId;
        }

      } else if (data.status === "not found") {
        // Exibe um alerta se o email não for encontrado
        alert("Email não encontrado! ");
      } else {
        // Lidar com outros possíveis erros
        console.error('Erro desconhecido ao processar o formulário');
      }
    })
    .catch(error => {
      console.error('Erro ao enviar o formulário', error);
    });
}

//------------------------------------------------------------------------------
// Função que atraves do CEP busca o endereço
//------------------------------------------------------------------------------
// Primeiro, inclua o SweetAlert em seu HTML se ainda não o fez
// <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

function buscarEndereco() {
  const cep = document.getElementById('cep').value;

  // Mostrar swal ao iniciar a busca
  Swal.fire({
    title: 'Localizando endereço...',
    text: 'Por favor, aguarde.',
    didOpen: () => {
      Swal.showLoading()
    },
    allowOutsideClick: false,
    allowEscapeKey: false,
    allowEnterKey: false
  });

  fetch(`https://viacep.com.br/ws/${cep}/json/`)
    .then(response => response.json())
    .then(data => {
      document.getElementById('endereco').value = data.logradouro;
      document.getElementById('bairro').value = data.bairro;
      document.getElementById('cidade').value = data.localidade;
      document.getElementById('uf').value = data.uf;

      // Fechar swal após preencher os campos
      Swal.close();
    })
    .catch(error => {
      console.error('Erro ao buscar endereço:', error);

      // Fechar swal e mostrar erro
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Erro ao buscar o endereço. Tente novamente.'
      });
    });
}
//------------------------------------------------------------------------------
//------ Função para validar o CPF
//------
function validarCPF(cpf) {
  cpf = cpf.replace(/[^\d]+/g, ''); // Remove caracteres não numéricos

  if (cpf === '' || cpf.length !== 11 || /^(\d)\1+$/.test(cpf)) return false;

  let soma = 0;
  let resto;

  for (let i = 1; i <= 9; i++)
    soma += parseInt(cpf.substring(i - 1, i)) * (11 - i);

  resto = (soma * 10) % 11;
  if ((resto === 10) || (resto === 11)) resto = 0;
  if (resto !== parseInt(cpf.substring(9, 10))) return false;

  soma = 0;
  for (let i = 1; i <= 10; i++)
    soma += parseInt(cpf.substring(i - 1, i)) * (12 - i);

  resto = (soma * 10) % 11;
  if ((resto === 10) || (resto === 11)) resto = 0;
  if (resto !== parseInt(cpf.substring(10, 11))) return false;

  return true;
}

//------ Função para mostrar a mensagem de erro
// Função para mostrar a mensagem de erro
function mostrarErroCPF() {
  const inputCPF = document.getElementById('cpf');
  const feedback = inputCPF.nextElementSibling;

  if (!validarCPF(inputCPF.value)) {
    inputCPF.classList.add('is-invalid');
    feedback.style.display = 'block';
  } else {
    inputCPF.classList.remove('is-invalid');
    feedback.style.display = 'none';
  }
}



//------ Função para validar o numeros celular
function validarNumeroWhatsApp() {
  const numero = document.getElementById('whatsappContato').value.replace(/[^\d]/g, ''); // Remove caracteres não numéricos
  const feedback = document.getElementById('whatsappContato').nextElementSibling;

  // Altere '11' para o número mínimo de dígitos esperado
  // e '11' para o número máximo de dígitos esperado
  if (numero.length < 11 || numero.length > 11) {
    feedback.style.display = 'block';
    return false;
  } else {
    feedback.style.display = 'none';
    return true;
  }
}
