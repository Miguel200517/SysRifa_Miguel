<?php

    // Obter conexão com o banco de dados
    include('../../conexao/conn.php');

    // Obter os dados enviados do formulário via $_REQUEST
    $requestData = $_REQUEST;

    // Verificação de campos obrigatórios do formulário
    if(empty($requestData['NOME'])) {
        // Caso a variável venha vazia do formulário, retornar um erro
        $dados = array(
            "tipo" => 'error',
            "mensagem" => 'Existe(m) campo(s) obrigatório(s) não preenchido(s).'
        );
    } else {
        // Caso os campos obrigatórios venha, preenchidos iremos realizar o cadastro
        $ID = isset($requestData['ID']) ? $requestData['ID'] : '';
        $operacao = isset($requestData['operacao']) ? $requestData['operacao'] : '';

        // Verificação para cadastro ou atualização de registro
        if($operacao == 'insert') {
            // Comandos para INSERT no banco de dados ocorrerem
            try{
                $stmt = $pdo->prepare('INSERT INTO TIPO (NOME) VALUES (:a)');
                $stmt->execute(array(
                    ':a' => utf8_decode($requestData['NOME'])
                ));
                $dados = array(
                    "tipo" => 'success',
                    "mensagem" => 'Registro salvo com sucesso.'
                );
            } catch(PDOException $e) {
                $dados = array(
                    "tipo" => 'error',
                    "mensagem" => 'Não foi possível salvar o registro:'.$e
                );
            }
        } else {
            // Se a nossa operação vir vazia então realizar um UPDATE
            try{
                $stmt = $pdo->prepare('UPDATE TIPO SET NOME = :a WHERE ID = :id');
                $stmt->execute(array(
                    ':id' => $ID,
                    ':a' => utf8_decode($requestData['NOME'])
                ));
                $dados = array(
                    "tipo" => 'success',
                    "mensagem" => 'Registro atualizado com sucesso.'
                );
            } catch(PDOException $e) {
                $dados = array(
                    "tipo" => 'error',
                    "mensagem" => 'Não foi possível atualizar o registro:'.$e
                );
            }
        }
    }

    // Converter o nosso array de retorno em uma representação de JSON
    echo json_encode($dados);