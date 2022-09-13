$(document).ready(function() {
  $('#table-tipo').DataTable({
      "processing": true,
      "serverSide": true,
      "ajax": {
          "url": "src/tipo/modelo/list-tipo.php",
          "type": "POST"
      },
      "columns": [{
              "data": 'ID',
              "className": 'text-center'
          },
          {
              "data": 'NOME',
              "className": 'text-center'
          },
          {
              "data": 'ID',
              "orderable": false,
              "searchable": false,
              "className": 'text-center',
              "render": function(data, type, row, meta) {
                  return `
                  <button id="${data}" class="btn btn-success btn-sm btn-view"><i class="fa fa-eye"></i></button>
                  <button id="${data}" class="btn btn-info btn-sm btn-edit"><i class="fa fa-pencil"></i></button>
                  <button id="${data}" class="btn btn-danger btn-sm btn-delete"><i class="fa fa-trash"></i></button>
                  `
              }
          }
      ]
  })
})