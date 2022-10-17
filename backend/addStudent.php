<?php

// include do arquivo de funcao
    include 'functions.php';

    try{

        $nome = 'Thiago';
        $curso = 'Técnico em Informática';
        $periodo = 'NOite';
       
        $sql = "INSERT into tb_aluno(nome,curso,periodo)VALUES('$nome','$curso','$periodo')";

        $msg = "Aluno cadastrado com sucesso!";

        insertUpdateDelete($sql,$msg);

    }catch(PDOException $erro){

       pdocatch($erro);

    }
    // Fechar a conexao
    $con = null;
?>