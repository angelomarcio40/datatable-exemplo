<?php

// include do arquivo de conexão
    include 'functions.php';

try{

        $id = $_POST['id'];

        $sql = "DELETE FROM tb_datatable WHERE id = $id";

        $msg = "Usuário deletado com sucesso!";

        insertUpdateDelete($sql,$msg);

    }catch(PDOException $erro){
       
        pdocatch($erro);
    }

    // Fechar conexao
    $con = null;

    ?>