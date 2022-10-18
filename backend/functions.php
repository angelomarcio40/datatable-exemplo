<?php

// linha de codigo que desabilita warnings e erro do PHP
// error_reporting(0);
include_once 'include/conexao.php';



// // define que a variavel conn sera de uso global
// global $con;


// Arquivo de funcoes genericas que podem ser utilizadas em qq pagina

// funcao que valida o preenchimento de uma variavel
function validaCampoVazio($campo,$nomedocampo){
    // Exemplo simples de validação de preenchimento de variável
        
    if($campo == ''){
        // criar um array para armazenar a mensagem de erro
        $retorno = array(
            'retorno'=>'erro',
            'mensagem'=>'Preencha o campo '.$nomedocampo.'!'
        );
        // cria um variavel que ira receber o array acima convertido em JSON
        $json = json_encode($retorno, JSON_UNESCAPED_UNICODE);
        // retorno em formato JSON
        
        echo $json;
        exit;
        // encerra o script
        
    }
        

}

// funcao generica que executa uma query de adicionar, atualizar o remover registros
function insertUpdateDelete($sql,$mensagemretorno){

   
    $comando= $GLOBALS['con']->prepare($sql);

    $comando->execute();

    $retorno = array(
                    'retorno'=>'ok',
                    'mensagem'=>$mensagemretorno
                );

    // cria um variavel que ira receber o array acima convertido em JSON
    $json = json_encode($retorno, JSON_UNESCAPED_UNICODE);

    // retorno em formato JSON
    echo $json;


}


function pdocatch($erro){
     // Tratamento de erro ou excecao
    $retorno = array(
        'retorno'=>'erro',
        'mensagem'=>$erro->getMessage()
    );

    $json = json_encode($retorno, JSON_UNESCAPED_UNICODE);

    echo $json;
}


// funcao que verifica se o email do usuario ja esta cadastrado
function checkEmailUser($email){
    
    // comando SQL que será executado no banco
    $sql = "SELECT email FROM tb_usuarios WHERE email = '$email'";

    $comando=$GLOBALS['con']->prepare($sql);

    $comando->execute();

    $validaEmail = $comando->fetchAll(PDO::FETCH_ASSOC);

    // retorna a variavel validaEmail
    // quando utilizamos return = será retornado um valor pela funcao
    // quando utilizamos echo = é exibido uma informacao na tela
    if($validaEmail != null){
        $retorno = array(
            'retorno'=>'erro',
            'mensagem'=>'E-mail já cadastrado, verifique e tente novamente!'
        );

        // cria um variavel que ira receber o array acima convertido em JSON
        $json = json_encode($retorno, JSON_UNESCAPED_UNICODE);

        // retorno em formato JSON
        echo $json;
        exit;
    }

}

function geraTokenUsuario($email){

    $sql = "SELECT id FROM tb_usuarios WHERE email='$email'";

    $comando=$GLOBALS['con']->prepare($sql);

    $comando->execute();

    $dados = $comando->fetch(PDO::FETCH_ASSOC);

    $idUsuario = $dados['id'];

    // gera token de ativação de conta do usuario(unico)
    $token = md5(uniqid($email,true));

    $sql = "INSERT INTO tb_usuarios_token(fk_id_usuarios, token) VALUES ($idUsuario,'$token')";

    $comando=$GLOBALS['con']->prepare($sql);

    $comando->execute();

    // retorna o token gerado, ser enviado por email
    return $token;

}

?>
