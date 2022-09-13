$(document).ready(function() {
  $('#table-promocao').DataTable({
      "processing": true,
      "serverSide": true,
      "ajax": {
          "url": "src/promocao/modelo/list-promocao.php",
          "type": "POST"
      },
      "columns": [{
              "data": 'ID',
              "className": 'text-center'
          },
          {
            "data": 'TITULO',
            "className": 'text-center'
          },
          {
            "data": 'DESCRICAO',
            "className": 'text-center'
          },
          {
            "data": 'DATA_INICIO',
            "className": 'text-center'
          },
          {
            "data": 'DATA_FIM',
            "className": 'text-center'
          },
          {
            "data": 'DATA_SORTEIO',
            "className": 'text-center'
          },
          {
            "data": 'VALOR_RIFA',
            "className": 'text-center'
          },
          {
            "data": 'ARRECADACAO',
            "className": 'text-center'
          },
          {
              "data": 'ID',
              "orderable": false,
              "searchable": false,
              "className": 'text-center',
              "render": function(data, type, row, meta) {
                  return `
                  <div class="d-flex">
                    <button id="${data}" class="btn btn-success btn-sm btn-view"><i class="fa fa-eye"></i></button>
                    <button id="${data}" class="btn btn-info btn-sm btn-edit mx-2"><i class="fa fa-pencil"></i></button>
                    <button id="${data}" class="btn btn-danger btn-sm btn-delete"><i class="fa fa-trash"></i></button>
                  </div>
                  `
              }
          }
      ]
  })
})