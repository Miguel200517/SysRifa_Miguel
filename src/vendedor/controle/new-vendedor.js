$(document).ready(function(){
    $('.btn-new').click(function(event){
        event.preventDefault()

       //Limpar todas as informações já existentes em nossa modal
       $('.modal-title').empty()
       $('.modal-body').empty()

       //Incluir nonos textos no cabeçalho da minha janela modal
       $('.modal-title').append('Adicionar novo registro')

       //Incluir o nosso formulario dentro da nossa janela modal
       $('.modal-body').load('src/vendedor/visao/form-vendedor.html', function(){
        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            assync: true,
            url: 'src/tipo/modelo/all-tipo.php',
            succes: function(dados){
                for(const dado of dados){
                    $('#TIPO_ID').append(`<option value="${dado.ID}">${dado.NOME}</option>`)
                }
            }
        })
       })

       //Iremos incluir uma função no botão salvar para demonstrar que é um novo registro
       $('.btn-save').attr('data-operation', 'insert')

       //Abrir nossa janela modal
       $('#modal-vendedor').modal('show')
    })
})