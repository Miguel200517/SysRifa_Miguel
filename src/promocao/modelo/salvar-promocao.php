<?php

    // Obter conexão com o banco de dados
    include('../../conexao/conn.php');

    // Obter os dados enviados do formulário via $_REQUEST
    $requestData = $_REQUEST;

    // Verificação de campos obrigatórios do formulário
    if(empty($requestData['TITULO']) && empty($requestData['DESCRICAO']) && empty($requestData['DATA_INICIO']) && empty($requestData['DATA_FIM']) && empty($requestData['DATA_SORTEIO']) && empty($requestData['VALOR_RIFA'])) {
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
                $stmt = $pdo->prepare('INSERT INTO PROMOCAO (TITULO, DESCRICAO, DATA_INICIO, DATA_FIM, DATA_SORTEIO, VALOR_RIFA) VALUES (:a, :b, :c, :d, :e, :f)');
                $stmt->execute(array(
                    ':a' => utf8_decode($requestData['TITULO']),
                    ':b' => utf8_decode($requestData['DESCRICAO']),
                    ':c' => ($requestData['DATA_INICIO']),
                    ':d' => ($requestData['DATA_FIM']),
                    ':e' => ($requestData['DATA_SORTEIO']),
                    ':f' => ($requestData['VALOR_RIFA']),
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
                $stmt = $pdo->prepare('UPDATE PROMOCAO SET TITULO = :a, DESCRICAO = :b, DATA_INICIO = :c, DATA_FIM = :d, DATA_SORTEIO = :e, VALOR_RIFA = :f WHERE ID = :id');
                $stmt->execute(array(
                    ':id' => $ID,
                    ':a' => utf8_decode($requestData['TITULO']),
                    ':b' => utf8_decode($requestData['DESCRICAO']),
                    ':c' => ($requestData['DATA_INICIO']),
                    ':d' => ($requestData['DATA_FIM']),
                    ':e' => ($requestData['DATA_SORTEIO']),
                    ':f' => ($requestData['VALOR_RIFA']),
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