<?php

// include do arquivo função
include 'include/conexao.php';

try {
    $token = $_GET['token'];
    // Exemplo de UPDATE utilizando INNER JOIN
    // Altera o usuário para Ativo = 1 usando como base o token de ativação
    $sql = "
    UPDATE
        tb_usuarios u
    INNER JOIN
        tb_usuarios_token t
    ON
        t.fk_id_usuarios = u.id
    SET
        u.ativo =1
    WHERE
        t.token = '$token'
        ";


    $comando = $con->prepare($sql);
    $comando->execute();
    // rowCount() é uma função que retorna o número de linhas afetadas com o SQL executado
    // Ex: 9 registros foram removidos
    // EX: e registros froam atualizados
    $retorno = $comando->rowCount();
} catch (PDOException $erro) {
    $retorno = 0;
}

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Senac - Ativação de Cadastro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<body>

    <div class="container-sm mt-4">
        <div class="card">
            <div class="alert <?php echo $retorno != 0 ? 'alert-sucess' : 'alert-danger'; ?>" role="alert">
                <?php $retorno != 0 ? 'Cadastro ativado com sucesso!' : 'Erro ao ativar cadastro';
                ?>
                <P>Cadastro ativado com sucesso!</p>
                <a href="../index.html">
                    <button type="button" class="btn btn-primary">Acessar Sistema</button>
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>