// document.ready define scrips JS que serão executados assim que a página for carregada, que a página estiver "pronta"
$(document).ready(function () {

  // Executa a função de listar usuarios
  listUser();

  // utilizacao da biblioteca input mask para criar mascara de telefone
  $('#telefone').inputmask('(99) 99999-99999')
  // inpútmask - campo cpf
  $('#cpf').inputmask('999.999.999-99')

  // exemplo de mascara de CEP
  // $('#cep').inputmask('99999-999')


});

// Função que add usuários
const addUser = () => {

  // Valida se o nome foi preenchido - usando JQUERY
  // let nome = $('#nome').val()
  // Valida se o nome foi preenchido - usando JS Vanilla
  // let nome = document.getElementById('nome').value 
  // if(nome == ''){
  //   Swal.fire({
  //     icon: 'error',
  //     title: 'Atenção!',
  //     text: 'Preencha o nome!'
  //   })
  //   return
  // }

  // Captura todo o formulário e ciar um formData
  let dados = new FormData($("#form-usuarios")[0]);

  // envio e recebimento de dados
  const result = fetch('backend/addUser.php',{
    method: 'POST',
    body: dados
  })
  .then((response)=>response.json())
  .then((result)=>{
    // Aqui é tratado o retorno ao front
    
      Swal.fire({
        title: 'Atenção',
        text: result.mensagem,
        icon: result.retorno == 'ok' ? 'success' : 'error'
      })

      // limpa os campos caso o retorno tenha sucesso
      // Utilização do IF ternario para redução de escrita de codigo
      result.retorno == 'ok' ? $('#form-usuarios')[0].reset() : ''

      // recarregar a tabela apos inserir o usuario
      result.retorno == 'ok' ? listUser() : ''
    
    
  })
};
// Final da função de add usuário


// Função que lista os usuários cadastrados
const listUser = () =>{

  const result = fetch('backend/listUser.php',{
    method: 'POST',
    body: ''
  })
  .then((response)=>response.json())
  .then((result)=>{
    // Aqui é tratado o retorno ao front
    let datahora = moment().format('DD/MM/YY HH:mm')

    $('#horario-atualizado').html(datahora)

     
    // destroi a tabela que foi iniciada
    $("#tabela").dataTable().fnDestroy()

    // limpa os dados da tabela
    $('#tabela-dados').html('')
    
    // Funcao que irá montar as linhas da tabela, o map é um tipo de laço (for)
    result.map(user=>{
        $('#tabela-dados').append(`
          <tr>
            <td>${user.nome}</td>
            <td>${user.email}</td>
            <td>${moment(user.data_cadastro).format('DD/MM/YY HH:mm')}</td>
            <td>
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="ativo" ${user.ativo == 1 ? 'checked' : ''} onchange="updateUserActive(${user.id})"> 
              </div>               
            </td>
            <td>
              <button type="button" class="btn btn-sm btn-primary" onclick="listUserID(${user.id})"><i class="bi bi-pencil-square"></i></button>
              <button type="button" class="btn btn-sm btn-danger"><i class="bi bi-trash" onclick="deleteUser(${user.id})"></i></button>
            </td> 
          </tr>    
        `)
    })


    // CSS dinâmico de botão para sim e não
    // <button type="button" class="btn btn-sm btn-${user.ativo==1 ? 'success' : 'danger'}">${user.ativo==1 ? 'Sim' : 'Não'}</button>

    

    // inicia a datatable
    $("#tabela").DataTable({
      language: {
        url: "//cdn.datatables.net/plug-ins/1.12.1/i18n/pt-BR.json"        
      }
    });
   
      
    
    
  })


}


// Função que altera o status de ativo do usuário


const updateUserActive = (id) => {

  const result = fetch(`backend/updateUserActive.php`, {
    method: "POST",
    body: `id=${id}`,
    headers: {
      'Content-type': 'application/x-www-form-urlencoded'
    }
  })
  .then((response) => response.json()) // retorna uma promise
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

  const result = fetch(`backend/deleteUser.php`, {
    method: "POST",
    body: `id=${id}`,
    headers: {
      'Content-type': 'application/x-www-form-urlencoded'
    }
  })
  .then((response) => response.json()) // retorna uma promise
  .then((result) => {
      Swal.fire({
        icon: result.retorno == 'ok' ? 'success' : 'error',
        title: result.mensagem,
        showConfirmButton: false,
        timer: 2000
      }) 
      
      // recarregar a lista de usuários
      listUser()  

  });

}


const listUserID = (id) =>{
  // lista os dados do usuário por ID, para alteração de dados
  // aqui teria que ser implementado toda a requisicao para o backend PHP
  // o modal terá que ser exibido dentro do result
  // .then((result) => {o codigo abaixo ficara aqui}
  const result = fetch(`backend/listUserID.php`, {
    method: "POST",
    body: `id=${id}`,
    headers: {
      'Content-type': 'application/x-www-form-urlencoded'
    }
  })
  .then((response) => response.json()) // retorna uma promise
  .then((result) => {

    // preenche os dados dentro do form de editar usuarios
    $('#edita-nome').val(result[0].nome)
    $('#edita-email').val(result[0].email)
    $('#edita-telefone').val(result[0].telefone)
    $('#edita-cpf').val(result[0].cpf)

    $('#edita-telefone').inputmask('(99) 99999-9999')
    $('#edita-cpf').inputmask('999.999.999-99')

    // exibe o modal apos preencher os dados para edicao
    const modalEditar = new bootstrap.Modal('#modal-editar-usuario')
    modalEditar.show()      

  }); 

}

const updateUser = () =>{
  // igualzinnnn o addUser
  // JS igual a função AddUser
  // PHP igual o AddUser.php
  
}



