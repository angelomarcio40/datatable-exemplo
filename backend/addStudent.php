<?php

// include do arquivo de conexão
    include 'functions.php';

try{

        $nome= 'Angelo';
        $curso = 'Técnico em Informática';
        $periodo = 'Noite';

        $sql = "INSERT into tb_aluno(nome,curso,periodo)VALUES('$nome','$curso','$periodo')";

        $msg = "Aluno cadastrado com sucesso!";

        insertUpdateDelete($sql,$msg);

    }catch(PDOException $erro){
        
        pdocatch($erro);

    }

    // Fechar conexao
    $con = null;

    ?>