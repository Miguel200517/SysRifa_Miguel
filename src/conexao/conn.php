<?php
// Carregar as credenciais do banco de dados
    $hostname = "sql111.epizy.com";
    $database = "epiz_32863624_RIFA";
    $user = "epiz_32863624";
    $password = "jqNOQZ4aji4cPfA";

    try{
        $pdo = new PDO('mysql:host='.$hostname.';dbname='.$database, $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo 'Conexão com o banco de dados '.$database.', foi realizado com sucesso!';
    } catch (PDOException $e) {
        echo 'ERRO: '.$e->getMessage();
    }