<?php
// Carregar as credenciais do banco de dados
    $hostname = "sql212.epizy.com";
    $database = "epiz_32586463_RIFA";
    $user = "epiz_32586463";
    $password = "cE5sjmogb8ykr";

    try{
        $pdo = new PDO('mysql:host='.$hostname.';dbname='.$database, $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo 'Conexão com o banco de dados '.$database.', foi realizado com sucesso!';
    } catch (PDOException $e) {
        echo 'ERRO: '.$e->getMessage();
    }