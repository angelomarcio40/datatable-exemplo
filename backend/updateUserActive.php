<?php

// include do arquivo de conexão
    include 'include/conexao.php';

try{

        $id = $_POST['id'];

        $sql = "UPDATE tb_datatable SET ativo = NOT ativo WHERE id = $id";

        $comando = $conexao->prepare($sql);

        $comando->execute();

            // cria uma variavel que ira receber o array acima convertido em JSON
            $retorno = array('retorno'=>'ok','mensagem'=>'Usuário alterado com sucesso!');
            $json = json_encode($retorno, JSON_UNESCAPED_UNICODE);

            // retorno em formato JSON
            echo $json;

    }catch(PDOException $erro){
        // Tratamento de erro ou exceção
        $retorno = array('retorno'=>'erro','mensagem'=>$erro->getMessage());

        $json = json_encode($retorno, JSON_UNESCAPED_UNICODE);

        echo $json;
    }

    // Fechar conexao
    $con = null;

    ?>
