$(document).ready(function() {
  $('#table-promocao').on('click', 'button.btn-edit', function(e) {
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
          url: 'src/promocao/modelo/view-promocao.php',
          success: function (dado) {
            if(dado.tipo == 'success') {
              $('.modal-body').load('src/promocao/visao/form-promocao.html', function () {
                $('#TITULO').val(dado.dados.TITULO)
                $('#DESCRICAO').val(dado.dados.DESCRICAO)
                $('#DATA_INICIO').val(dado.dados.DATA_INICIO)
                $('#DATA_FIM').val(dado.dados.DATA_FIM)
                $('#DATA_SORTEIO').val(dado.dados.DATA_SORTEIO)
                $('#VALOR_RIFA').val(dado.dados.VALOR_RIFA)
                $('#ID').val(dado.dados.ID)
              })
              $('.btn-salvar').show()
              $('#modal-promocao').modal('show')
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