<?php

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

        include_once 'include/conexao.php';
    
        $comando = $conexao->prepare($sql);

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

?>