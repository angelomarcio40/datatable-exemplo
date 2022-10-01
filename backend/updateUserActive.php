<?php

// include do arquivo de conexão
    include 'functions.phpp';

try{

        $id = $_POST['id'];

        $sql = "UPDATE tb_datatable SET ativo = NOT ativo WHERE id = $id";

        $msg = "Usuário alterado com sucesso!";

        insertUpdateDelete($sql,$msg);

    }catch(PDOException $erro){
        
        pdocatch($erro);

    }

    // Fechar conexao
    $con = null;

    ?>