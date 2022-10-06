<?php

// Include conexao
include 'include/conexao.php';

try{

    $id = $_POST['id'];
    
    // Monta a query SQL
    $sql = "SELECT id,nome,email,telefone,cpf,data_cadastro,ativo FROM tb_datatable WHERE id = $id";
    // Prepara e execução
    $comando = $conexao->prepare($sql);
    // executa o comando
    $comando->execute();

    // Variavel que irá guardar o resultado da execução do comando
    $retorno = $comando->fetchAll(PDO::FETCH_ASSOC);

    $json = json_encode($retorno, JSON_UNESCAPED_UNICODE);

    echo $json;
    
}catch(PDOException $erro) {
    $retorno = array(
        'retorno'=>'erro',
        'mensagem'=>$erro->getMessage()
    );

    $json = json_encode($retorno, JSON_UNESCAPED_UNICODE);

    echo $json;
}

$con = null;
