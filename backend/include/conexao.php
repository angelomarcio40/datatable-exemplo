<?php

try{
    define('SERVIDOR', 'localhost');
    define('USUARIO', 'root');
    define('SENHA','');
    define('BASEDADOS', 'db_sistema_datatable');

   
        $con    = new PDO("mysql:host=".SERVIDOR.";dbname=".BASEDADOS.";charset=utf8",USUARIO,SENHA);
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        // echo "conectado";
}catch(PDOException $e){
        echo "Não foi possível conectar:" . $e->getMessage();       
}
