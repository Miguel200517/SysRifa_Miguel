<?php

    include('../../conexao/conn.php');

    //Obter os dados do formulário html
    $requestData = $_REQUEST;

    //Verificação de campos obrigatórios
    if(empty($requestData['NOME'])){
        //Caso a variavel vier vazia, retornar erro
        $dados = array(
            "tipo" => 'erro',
            "mensagem" => 'Existem campos obrigatórios não preenchidos.'
        );
    } else{
    //Caso os campos vierem preenchidos, realizar o cadastro
        $ID = isset($requestData['ID']) ? $requestData['ID'] : '';
        $operacao = isset($requestData['operacao']) ? $requestData['operacao'] : '';
    
    // Verificação  para cadastro ou realização de registro
        if($operacao == 'insert') {
            //Comandos para o INSERT no banco de dados ocorrerem
            try {
                $stmt = $pdo->prepare('INSERT INTO VENDEDOR (NOME, CELULAR, LOGIN, SENHA, TIPO_ID) VALUES (:a, :b, 
                :c, :d, :e)');
                $stmt->execute(array(
                    ':a' => ($requestData['NOME'],
                    ':b' => ($requestData['CELULAR'],
                    ':c' => ($requestData['LOGIN'],
                    ':d' => md5($requestData['SENHA'],
                    ':e' => ($requestData['TIPO_ID'])
                ));
                $dados = array(
                    "tipo" => 'success',
                    "mensagem" => 'Registro salvo com sucesso.'
                );
            } catch (PDOException $e) {
                $dados = array(
                    "tipo" => 'erro',
                    "mensagem" => 'Não foi possível salvar o registro: ' .$e
                );
            }
        } else {
            //Se a nossa operação vier vazia, realizar UPDATE
            try {
                $stmt = $pdo->prepare('UPDATE VENDEDOR SET NOME = :a, CELULAR = :b, LOGIN = :c,
                SENHA = :d, TIPO_ID = :e WHERE ID = :id');
                $stmt->execute(array(
                    ':id' => $ID,
                    ':a' => ($requestData['NOME'],
                    ':b' => ($requestData['CELULAR'],
                    ':c' => ($requestData['LOGIN'],
                    ':d' => md5($requestData['SENHA'],
                    ':e' => ($requestData['TIPO_ID'])
                ));
                $dados = array(
                    "tipo" => 'success',
                    "mensagem" => 'Registro atualizado com sucesso.'
                );
            } catch (PDOException $e) {
                $dados = array(
                    "tipo" => 'erro',
                    "mensagem" => 'Não foi possível atualizar o registro: ' .$e
                );
            }
        }    
    }

    //Converter o nosso array de retorno em uma representação JSON
    echo json_encode($dados);