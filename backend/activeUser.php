<?php

include 'include/conexao.php';

try{
    $token = $_GET['token'];

    $sql = "
    UPDATE
        tb_usuarios u
    INNER JOIN
        tb_usuario_tokent t
    ON
        t.fk_id_usuarios = u.id
    SET
        u.ativo =1
    WHERE
        t.token = '$token'
        ";

}catch(PDOException $erro){

}

?>