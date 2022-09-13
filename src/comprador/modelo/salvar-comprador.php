<?php
    include('../../conexao/conn.php');

    $requestData = $_REQUEST;
    
    if(empty($requestData['NOME'])) {
        $dados = array(
            "tipo" => 'error',
            "mensagem" => 'Existe(m) campo(s) obrigatório(s) não preenchido(s).'
        );
    } else {
        $ID = isset($requestData['ID']) ? $requestData['ID'] : '';
        $operacao = isset($requestData['operacao']) ? $requestData['operacao'] : '';

        // Verificação para cadastro ou atualização de registro
        if($operacao == 'insert') {
            // Comandos para INSERT no banco de dados ocorrerem
            try{
                $stmt = $pdo->prepare('INSERT INTO COMPRADOR (NOME, CELULAR) VALUES (:a, :b)');
                $stmt->execute(array(
                    ':a' => utf8_decode($requestData['NOME']),
                    ':b' => utf8_decode($requestData['CELULAR'])
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
                $stmt = $pdo->prepare('UPDATE COMPRADOR SET NOME = :a, CELULAR = :b WHERE ID = :id');
                $stmt->execute(array(
                    ':id' => $ID,
                    ':a' => utf8_decode($requestData['NOME']),
                    ':b' => utf8_decode($requestData['CELULAR'])
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