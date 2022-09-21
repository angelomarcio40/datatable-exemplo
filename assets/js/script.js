// document.ready define scripts JS que serão executados assim que a página for carrgada, que a página estiver "pronta"
$(document).ready(function () {

    // Função que lista os usuário cadastrados
    listUser();

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
// Final da função add usuário

// Função que lista os usuários cadastrados
const listUser = () => {
    const result = fetch('backend/listUser.php', {
        method: 'POST',
        body: ''
    })
        .then((response) => response.json())
        .then((result) => {
            $('#tabela-dados').append(`]

            // Função que irá montar as linhas da tabela, o map é um tipo de laço(for)
            result.map(usuario=> {
        <tr>
                        <td>${usuarioi.nome}</td>
                        <td>${usuario.email}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-primary">Alterar</button>
                            <button type="button" class="btn btn-sm btn-danger">Exlcuir</button>
                        </td>
                    </tr>
        `)
        })
}