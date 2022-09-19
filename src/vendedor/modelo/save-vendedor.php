<?php
    //Obter nossa conexão com o banco de dados
    include('../../conexao/conn.php');

    //Obter os dados enviados do formulario via $_REQUEST
    $requestData = $_REQUEST;

    //Verificção de campos obrigatórios do formulario
    if(empty($requestData['NOME'])){
        //Caso a variavel venha vazia do formulario, iremos retornar um erro
        $dados = array(
            "Tipo" => 'error', 
            "mensagem" => 'Existe(m) campo(s) obrigatório(s) não preenchido(s).'
        );
    }else {
        //Caso os campos obrigatório venham preenchido, iremos realizar o cadastro 
        $ID = isset($requestData['ID']) ? $requestData['ID'] :'';
        $operacao = isset($requestData['operacao']) ? $requestData['operacao'] : '';

        //Verificação para cadastro ou atualização de requistro 
        if($operacao == 'insert'){
            //Comandos para o INSERT no banco de dados se ocorerem
            try{
                $stmt = $pdo->prepare('INSERT INTO VENDEDOR (NOME, CELULAR, LOGIN, SENHA, TIPO_ID) VALUES (:a, 
                :b, :c, :d, :e)');
                $stmt->execute(array(
                    ':a' => $requestData['NOME'],
                    ':b' => $requestData['CELULAR'],
                    ':c' => $requestData['LOGIN'],
                    ':d' =>  md5($requestData['SENHA']),
                    ':e' => $requestData['TIPO_ID']
                ));
                $dados = array(
                    "tipo" => 'sucess', 
                    "mensagem" => 'Registro salvo com sucesso!' 
                ); 
            } catch(PDOException $e) {
                $dados = array(
                    "tipo" => 'error', 
                    "mensagem" => 'Não foi passível salvar o registro:'.$e 
                );
            }
        } else {
            //Se a nossa operação vir vazia, então iremos realizar UPDATE
            try{
                $stmt = $pdo->prepare('UPDATE VENDEDOR SET NOME = :a, CELULAR = :b, LOGIN = :c, SENHA = :d, TIPO_ID = :e WHERE ID = :id');
                $stmt->execute(array(
                    ':id' => $ID,
                    ':a' => $requestData['NOME'],
                    ':b' => $requestData['CELULAR'],
                    ':c' => $requestData['LOGIN'],
                    ':d' =>  md5($requestData['SENHA']),
                    ':e' => $requestData['TIPO_ID']
                ));
                $dados = array(
                    "tipo" => 'success', 
                    "mensagem" => 'Registro atualizado com sucesso!' 
                ); 
            } catch(PDOException $e) {
                $dados = array(
                    "tipo" => 'error', 
                    "mensagem" => 'Não foi passível atualizar o registro:'.$e 
                );
            }
        }
    }

//Converter o nosso array de retorno em uma representação JSON
echo json_encode($dados);