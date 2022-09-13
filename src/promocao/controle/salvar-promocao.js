$(document).ready(function() {
  $('.btn-salvar').click(function(e) {
      e.preventDefault()

      let dados = $('#form-promocao').serialize()

      dados += `&operacao=${$('.btn-salvar').attr('data-operation')}`

      $.ajax({
          type: 'POST',
          dataType: 'JSON',
          assync: true,
          data: dados,
          url: 'src/promocao/modelo/salvar-promocao.php',
          success: function(dados) {
              Swal.fire({
                  title: 'SysRifa',
                  text: dados.mensagem,
                  icon: dados.tipo,
                  confirmButtonText: 'OK'
              })

              $('#modal-promocao').modal('hide')
              $('#table-promocao').DataTable().ajax.reload()
          }
      })
  })
})