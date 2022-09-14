<?php

//Realizar a conexão com o banco de dados 
include("../../conexao/conn.php");

//Obter a requisição para geração da tabela
$requestData = $_REQUEST;

//Obter as colunas que estão sendo requiridas 
$colunas = $requestData['columns'];

//Preparar o comando sql para obter dos registros existentes no banco de dados
$sql = "SELECT ID, NOME FROM VENDEDOR WHERE 1=1 ";

//Obter o total de registros existentes na tabela do banco de dados
$resultado = $pdo->query($sql);
$qtdeLinhas = $resultado->rowCount();

//Verificar se existe algum filtro determinado pelo usuario
$filtro = $requestData['search']['value'];
if(!empty($filtro)){
    //Montar a expressão logica em sql para filtrar a nossa tabela 
    $sql .= " AND (ID LIKE '$filtro%' ";
    $sql .= " OR NOME LIKE '$filtro%') ";
}

//Obter o total de registros existentes na tabela do banco de dados de acordo com o filtro
$resultado = $pdo->query($sql);
$totalFiltrados = $resultado->rowCount();

//Obter o valor para a ordenação ORDER BY
$colunaOrdem = $requestData['order'][0]['column'];
$ordem = $colunas[$colunaOrdem]['data'];
$direcao = $requestData['order'][0]['dir'];

//Obter os valores para LIMIT
$inicio = $requestData['start'];
$tamanho = $requestData['length'];

//Gerando a nossa ordenação na consulta sql 
$sql .= "ORDER BY $ordem $direcao LIMIT $inicio, $tamanho";
$resultado = $pdo->query($sql);
$dados = array();
while($row = $resultado->fetch(PDO::FETCH_ASSOC)){
    $dados[] = array_map('utf8_encode', $row);
}

//Contruir o nosso objeto JSON no padrao DataTables
$json_data = array(
        "draw" => intval($requestData['draw']),
        "recordsTotal" => intval($qtdeLinhas),
        "recordsFiltered" => intval($totalFiltrados),
        "data" => $dados
);
echo json_encode($json_data);