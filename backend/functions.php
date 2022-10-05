<?php
 
// linha de codigo que desabilita warnings e erro de PHP
// error_reporting(0);
include_once 'include/conexao.php';
// define que a vriavel conexao sera de uso global
// global $conexao;

// Arquivo de funções genéricas que podem ser utiklizadas em qualque página

// Função que valida o preenchimeto de uma vriavel
function validaCampoVazio($campo,$nomedocampo){
        // Exemplo simples de validação de preenchimento de variável
        if($campo == ''){
        // cria uma variavel que ira receber o array acima convertido em JSON
        $retorno = array('retorno'=>'erro','mensagem'=>'Preencha o campo '.$nomedocampo.'!');
        $json = json_encode($retorno, JSON_UNESCAPED_UNICODE);

        // retorno em formato JSON
        echo $json;
        // encerra script
        exit;
    }
}

// função generica que excuta uma query de adicionar, atualizar o remover registros
function insertUpdateDelete($sql,$mensagemretorno){
    
        $comando = $GLOBALS['conexao']->prepare($sql);

        $comando->execute();

            // cria uma variavel que ira receber o array acima convertido em JSON
            $retorno = array('retorno'=>'ok','mensagem'=>$mensagemretorno);
            $json = json_encode($retorno, JSON_UNESCAPED_UNICODE);

            // retorno em formato JSON
            echo $json;
}

function pdocatch($erro){
    // Tratamento de erro ou exceção
    $retorno = array('retorno'=>'erro','mensagem'=>$erro->getMessage());

    $json = json_encode($retorno, JSON_UNESCAPED_UNICODE);

    echo $json;
}

// função que verifica se usuário esta cadastrado
function checkEmailUser($email){
    
    // monta comando SQL que será excutado no banco
    $sql = "SELECT email FROM tb_datatable WHERE email = '$email'";

    $comando=$GLOBALS['conexao']->prepare($sql);

    $comando->execute();

    $validaEmail = $comando->fetchAll(PDO::FETCH_ASSOC);

    // retorna variavel retorno
    // quando utilizamos return = será retornado um valor pela função
    // quando utilizamos echo = é exibido uma informação na tela
    if($validaEmail != null){

        $retorno = array(
            'retorno' => 'erro',
            'mensagem' => 'E-mail já cadastrado, verifique e tente novamente!'
        );

        $json = json_encode($retorno, JSON_UNESCAPED_UNICODE);
    
        echo $json;
        exit;
    }
}

?>