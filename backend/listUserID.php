<?php

// include conexao
include 'include/conexao.php';

try{

    $id = $_POST['id'];

    // monta a query SQL
    $sql = "SELECT id,nome,email,telefone,cpf,data_cadastro,ativo FROM tb_usuarios WHERE id = $id";

    // prepara a execucao
    $comando = $con->prepare($sql);

    // executa o comando
    $comando->execute();

    // variavel que ira guardar o resulta da execucao do comando
    $retorno = $comando->fetchAll(PDO::FETCH_ASSOC);

    $json = json_encode($retorno, JSON_UNESCAPED_UNICODE);

    echo $json;
     



}catch(PDOException $erro){
    $retorno = array(
                    'retorno'=>'erro',
                    'mensagem'=>$erro->getMessage()
    );
    
    $json = json_encode($retorno, JSON_UNESCAPED_UNICODE);

    echo $json;
}

$con= null;

?>