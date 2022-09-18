$(document).ready(function(){

    $('#table-tipo').on('click', 'button.btn-edit', function(e){
        e.preventDefault()

        //Limpar todas as informações já existentes em nossa modal
       $('.modal-title').empty()
       $('.modal-body').empty()

       //Incluir nonos textos no cabeçalho da minha janela modal
       $('.modal-title').append('Editar registro')

       let ID = `ID=${$(this).attr('id')}`

       $('.btn-salvar').removeAttr('data-operation')

       $.ajax({
        type: 'POST',
        dataType: 'json',
        assync: true,
        data: ID,
        url: 'src/tipo/modelo/view-vendedor.php',
        success: function(dado){
            if(dado.tipo == 'success'){
                $('.modal-body').load('src/tipo/visao/form-vendedor.html', function () {
                    $('#NOME').val(dado.dados.NOME)
                    $('#CELULAR').val(dado.dados.CELULAR)
                    $('#LOGIN').val(dado.dados.LOGIN)
                    $('#SENHA').val(dado.dados.SENHA)
                    $('#TIPO_ID').empty()
                    var ID = dado.dados.TIPO_ID
                    $.ajax({
                        type: 'POST',
                        dataType: 'JSON',
                        assync: true,
                        url: 'src/tipo/modelo/all-tipo.php',
                        succes: function(dados){
                            for(const dado of dados){
                                if(ID == dado.ID){
                                $('#TIPO_ID').append(`<option value="${dado.ID}" selected >${dado.NOME}</option>`)
                            }else{
                                $('#TIPO_ID').append(`<option value="${dado.ID}">${dado.NOME}</option>`)
                            }
                        }  
                        }
                    })
                })
                $('.btn-save').show()
                $('btn-save').removeAttr('data-operation')
                $('#modal-vendedor').modal('show')
         }else{
            Swal.fire({
                title: 'SysRifa',
                text: dados.mensagem,
                icon: dado.tipo,
                confirmButtonText: 'OK'
            })
        }
        }
       })
    })

})