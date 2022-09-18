$(document).ready(function(){

    $('#table-vendedor').on('click', 'button.btn-view', function(e){
        e.preventDefault()

        //Limpar todas as informações já existentes em nossa modal
       $('.modal-title').empty()
       $('.modal-body').empty()

       //Incluir nonos textos no cabeçalho da minha janela modal
       $('.modal-title').append('Visualizar registro')

       let ID = `ID=${$(this).attr('id')}`

       $.ajax({
        type: 'POST',
        dataType: 'json',
        assync: true,
        data: ID,
        url: 'src/vendedor/modelo/view-vendedor.php',
        success: function(dado){
            if(dado.tipo == 'success'){
                $('.modal-body').load('src/tipo/visao/form-vendedor.html', function () {
                    $('#NOME').val(dado.dados.NOME)
                    $('#NOME').attr('readonly', 'true')
                    $('#CELULAR').val(dado.dados.CELULAR)
                    $('#CELULAR').attr('readonly', 'true')
                    $('#LOGIN').val(dado.dados.LOGIN)
                    $('#LOGIN').attr('readonly', 'true')
                    $('#SENHA').val(dado.dados.SENHA)
                    $('#SENHA').attr('readonly', 'true')
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
                                $('#TIPO_ID').append(`<option value="${dado.ID}" selected disabled>${dado.NOME}</option>`)
                            }
                        }  
                        }
                    })
                })
                $('.btn-save').hide()
                $('#modal-tipo').modal('show')
         }else{
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