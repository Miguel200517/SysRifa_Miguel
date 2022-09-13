$(document).ready(function() {
  $('#table-promocao').on('click', 'button.btn-view', function(e) {
    e.preventDefault()
        // Limpar todas as informações ja existentes na modal
        $('.modal-title').empty()
        $('.modal-body').empty()

        // Incluir novos textos no cabeçalho na janela modal
        $('.modal-title').append('Visualizar registro')

        let ID = `ID=${$(this).attr('id')}`

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
                $('#TITULO').attr('readonly', 'true')
                $('#DESCRICAO').val(dado.dados.DESCRICAO)
                $('#DESCRICAO').attr('readonly', 'true')
                $('#DATA_INICIO').val(dado.dados.DATA_INICIO)
                $('#DATA_INICIO').attr('readonly', 'true')
                $('#DATA_FIM').val(dado.dados.DATA_FIM)
                $('#DATA_FIM').attr('readonly', 'true')
                $('#DATA_SORTEIO').val(dado.dados.DATA_SORTEIO)
                $('#DATA_SORTEIO').attr('readonly', 'true')
                $('#VALOR_RIFA').val(dado.dados.VALOR_RIFA)
                $('#VALOR_RIFA').attr('readonly', 'true')
              })
              $('.btn-salvar').hide()
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