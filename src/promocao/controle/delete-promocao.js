$(document).ready(function() {
  $('#table-promocao').on('click', 'button.btn-delete', function(e) {
    e.preventDefault()

    let ID = `ID=${$(this).attr('id')}`

    Swal.fire({
      title: 'SysRifa',
      text: 'Deseja realmente excluir este registro?',
      icon: 'question',
      showCancelButton: true,
      confirmButtonText: 'Sim',
      cancelButtonText: 'Não' 
    }).then((result) => {
      if(result.value) {
        $.ajax({
          type: 'POST',
          dataType: 'json',
          assync: true,
          data: ID,
          url: 'src/promocao/modelo/delete-promocao.php',
          success: function (dados) {
              Swal.fire({
                title: 'SysRifa',
                text: dados.mensagem,
                icon: dados.tipo,
                confirmButtonText: 'OK'
            })
            $('#table-promocao').DataTable().ajax.reload()
          }
        })
      }
    })
  })
})