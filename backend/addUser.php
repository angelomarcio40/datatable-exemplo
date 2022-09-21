<?php

// include do arquivo de conexão
    include 'include/conexao.php';

try{
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $confirmar = $_POST['confirmar'];

        if($senha != $confirmar){
            // cria uma variavel que ira receber o array acima convertido em JSON
            $retorno = array('retorno'=>'erro','mensagem'=>'Senhas não conferem, verifique e tente novamente');
            $json = json_encode($retorno, JSON_UNESCAPED_UNICODE);

            // retorno em formato JSON
            echo $json;
            // encerra script
            exit;
        }

        $sql = "INSERT INTO tb_datatable (nome, email, senha) VALUES ('$nome','$email','$senha')";

        $comando = $conexao->prepare($sql);

        $comando->execute();

            // cria uma variavel que ira receber o array acima convertido em JSON
            $retorno = array('retorno'=>'ok','mensagem'=>'Usuário adicionado com sucesso!');
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