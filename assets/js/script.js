// document.ready define scripts JS que serão executados assim que a página for carrgada, que a página estiver "pronta"
$(document).ready(function () {

    // Função que lista os usuário cadastrados
    listUser();

    $('#telefone').mask("(00) 0000 00000")

})


// Função que add usuários
const addUser = () => {

    // Exemplo - Valida se o nome foi preenchido - usando JQUERY
    // let nome = $('#nome').val()
    // if(nome == ''){
    //     Swal.fire({
    //         icon: 'error',
    //         title: 'Atenção!',
    //         text: 'Preencha o nome!'
    //     })
    //     return
    // }

    // Valida se nome foi preenchido - usando JS Vanilla
    // let nome = document.getElementById('nome').value

    // Captura foto e formulário e cria um formData
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
                            <td>${moment(user.data_cadastro).format('DD/MM/YY HH:mm')}</td>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="ativo" ${user.ativo==1 ? 'checked' : ''} onchange="updateUserActive(${user.id})">
                                </div>
                            </td>
                            <td>${user.data_cadastro}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-primary"><i class="bi bi-pencil-square"></i></button>
                            <button type="button" class="btn btn-sm btn-danger"><i class="bi bi-trash" onclick="deleteUser(${user.id})"></i></button>
                            </td>
                        </tr>
                    `)
            })

            // CSS dinâmico do botão
            // <button type="button" class="btn btn-sm btn-${user.ativo==1 ? 'success' : 'danger'}">${user.ativo==1 ? 'Sim' : 'Não'}

            $("#tabela").DataTable({
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.12.1/i18n/pt-BR.json",
                },
            });
        })
}

// Função que altera status de ativo do usuario

const updateUserActive = (id) => {
    const result = fetch(`backend/updateUserActive.php`,{
        method: "POST",
        body: `id=${id}`,
        headers: {
            'Content-type': 'application/x-www-form-urlencoded'
        }
    })
    .then((response) => response.json()) //retorna uma promise
    .then((result) => {
        Swal.fire({
            icon: result.retorno == 'ok' ? 'success' : 'error',
            title: result.mensagem,
            showConfirmButton: false,
            timer: 2000
        })
    });

}

const deleteUser = (id) => {
    const result = fetch(`backend/deleteUser.php`,{
        method: "POST",
        body: `id=${id}`,
        headers: {
            'Content-type': 'application/x-www-form-urlencoded'
        }
    })
    .then((response) => response.json()) //retorna uma promise
    .then((result) => {
        Swal.fire({
            icon: result.retorno == 'ok' ? 'success' : 'error',
            title: result.mensagem,
            showConfirmButton: false,
            timer: 2000
        }) 
        
        // recarregar a lista de usuarios
        listUser()
    });

}