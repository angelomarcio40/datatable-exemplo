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
            $retorno = array('Mensagem'=>'Senhas não conferem, verifique e tente novamente');
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
            $retorno = array('Mensagem'=>'Usuário adicionado com sucesso!');
            $json = json_encode($retorno, JSON_UNESCAPED_UNICODE);

            // retorno em formato JSON
            echo $json;

    }catch(PDOException $erro){

    }
?>