// document.ready define scripts JS que serão executados assim que a página for carrgada, que a página estiver "pronta"
$(document).ready(function () {

    // Função que lista os usuário cadastrados
    listUser();

})


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

            result.retrono == 'ok' ? listUser() : ''

        })
}
// Final da função add usuário

// Função que lista os usuários cadastrados
const listUser = () => {
    const result = fetch('backend/listUser.php', {
        method: 'POST',
        body: ''
    })
        .then((response) => response.json())
        .then((result) => {

            let datahora = moment().format('DD/MM/YY HH:mm')

            $('#horario-atualizado').html(datahora)

            // destroi a tabela que foi iniciada
            $("#tabela").dataTable().fnDestroy();

            // limpa os dados da tabela
            $('#tabela-dados').html('')

            // Função que irá montar as linhas da tabela, o map é um tipo de laço (for)
            result.map(user => {
                $('#tabela-dados').append(`
                        <tr>
                            <td>${user.nome}</td>
                            <td>${user.email}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-primary"><i class="bi bi-pencil-square"></i></button>
                                <button type="button" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                    `)
            })

            $("#tabela").DataTable({
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.12.1/i18n/pt-BR.json",
                },
            });
        })
}