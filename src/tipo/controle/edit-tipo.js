$(document).ready(function() {
  $('#table-tipo').on('click', 'button.btn-edit', function(e) {
    e.preventDefault()
        // Limpar todas as informações ja existentes na modal
        $('.modal-title').empty()
        $('.modal-body').empty()

        // Incluir novos textos no cabeçalho na janela modal
        $('.modal-title').append('Editar registro')

        let ID = `ID=${$(this).attr('id')}`

        $('.btn-salvar').removeAttr('data-operation')

        $.ajax({
          type: 'POST',
          dataType: 'json',
          assync: true,
          data: ID,
          url: 'src/tipo/modelo/view-tipo.php',
          success: function (dado) {
            if(dado.tipo == 'success') {
              $('.modal-body').load('src/tipo/visao/form-tipo.html', function () {
                $('#NOME').val(dado.dados.NOME)
                $('#ID').val(dado.dados.ID)
              })
              $('.btn-salvar').show()
              $('#modal-tipo').modal('show')
            } else {
              Swal.fire({
                title: 'SysRifa',
                text: dados.mensagem,
                icon: dados.tipo,
                confirmButtonText: 'OK'
            })
            }
          }
        })
  })
})