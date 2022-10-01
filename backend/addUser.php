<?php

    // include do arquivo de finctions
    include 'functions.php';

try{
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $confirmar = $_POST['confirmar'];
        
        // executa a função que verifica se o campo está preenchido
        validaCampoVazio($nome,'nome');
        validaCampoVazio($email,'email');
        validaCampoVazio($senha,'senha');
        validaCampoVazio($confirmar,'confirmar senha');

        
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

        $msg = "Usuário adicionado com sucesso!";

        insertUpdateDelete($sql,$msg);

    }catch(PDOException $erro){
        pdocatch($erro);
    }

    // Fechar conexao
    $con = null;
?>