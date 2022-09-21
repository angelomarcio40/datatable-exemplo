// document.ready define scripts JS que serão executados assim que a página for carrgada, que a página estiver "pronta"
$(document).ready(function () {
    // inicia a datatable
    $('#tabela').DataTable({
        "language": {
            url: '//cdn.datatables.net/plug-ins/1.12.1/i18n/pt-BR.json'
        }
    });
});

// Função que add usuários
const addUser = () => {

    // Captura tofo o formulárionencria um formData
    let dados = new FormData($('#form-usuarios')[0]);

    // envio e recebimento de dados
    const result = fetch('backend/addUser.php', {
        method: 'POST',
        body: dados
    })
        .then((response) => response.json())
        .then((result) => {
            // Aqui  é tratado o retorno ao front
            Swal.fire({
                title: 'Atenção',
                text: result.mensagem,
                icon: result.retorno == 'ok' ? 'success' : 'error'
            })

            // limpa os campos caso o retorno tenha sucesso
            // utilização do IF ternario para redução de escrita de codigo
            result.retorno == 'ok' ? $('#form-usuarios')[0].reset() : ''

        })
}