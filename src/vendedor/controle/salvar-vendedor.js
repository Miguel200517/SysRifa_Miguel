$(document).ready(function(){
    $('.btn-salvar').click(function(e){
        e.preventDefault()

    let dados = $('#form-vendedor').serialize()

    dados += `&operacao=${$('.btn-salvar').attr('data-operation')}`

    $.ajax({
        type: 'POST',
        dataType: 'JSON',
        assync: true,
        data: dados,
        url: 'src/vendedor/modelo/salvar-vendedor.php',
        success: function(dados){
            Swal.fire({
                title: 'SysRifa',
                text: dados.mensagem,
                icon: dados.tipo,
                confirmButtonText: 'OK'
            })

            $('#modal-vendedor').modal('hide')
            $('#table-vendedor').DataTable().ajax.reload()
    }
})
})
})