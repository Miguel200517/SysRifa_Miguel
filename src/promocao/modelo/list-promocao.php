<?php

include('../../conexao/conn.php');

  
$requestData = $_REQUEST;
 
$colunas = $requestData['columns'];

$sql = "SELECT ID, TITULO, DESCRICAO, DATA_INICIO, DATA_FIM, DATA_SORTEIO, VALOR_RIFA, ARRECADACAO FROM PROMOCAO WHERE 1=1 ";

  $resultado = $pdo->query($sql);
  $qtdeLinhas = $resultado->rowCount();
  
  
  $filtro = $requestData['search']['value'];
  if( !empty( $filtro ) ){
      
      $sql .= " AND (ID LIKE '$filtro%' ";
      $sql .= " OR TITULO LIKE '$filtro%') ";
  }
  
  
  $resultado = $pdo->query($sql);
  $totalFiltrados = $resultado->rowCount();
  
 
  $colunaOrdem = $requestData['order'][0]['column']; 
  $ordem = $colunas[$colunaOrdem]['data']; 
  $direcao = $requestData['order'][0]['dir']; 
  
  
  $inicio = $requestData['start']; 
  $tamanho = $requestData['length']; 
  
  
  $sql .= " ORDER BY $ordem $direcao LIMIT $inicio, $tamanho ";
  $resultado = $pdo->query($sql);
  $dados = array();
  while($row = $resultado->fetch(PDO::FETCH_ASSOC)){
    $row['ARRECADACAO'] = $row['ARRECADACAO']==0 ? '---' : $row['ARRECADACAO'];
    $dados[] = array_map('utf8_encode', $row);
  }
  
  $json_data = array(
      "draw" => intval($requestData['draw']),
      "recordsTotal" => intval($qtdeLinhas),
      "recordsFiltered" => intval($totalFiltrados),
      "data" => $dados
  );


  
  echo json_encode($json_data);