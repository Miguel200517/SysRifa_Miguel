$(document).ready(function(){

    $('#table-vendedor').on('click', 'button.btn-delete', function(e){
        e.preventDefault()

        let ID = `ID=${$(this).attr('id')}`

        Swal.fire({
            title: 'SysRifa',
            text: 'Deseja realmente excluir este registro?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'SIM',
            cancelButtonText: 'NÃO' 
        }).then((result) => {
            if(result.value){
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    assync: true,
                    data: ID,
                    url: 'src/tipo/modelo/delete-vendedor.php',
                    success: function(dados){
                        Swal.fire({
                            title: 'SysRifa',
                            text: dados.mensagem,
                            icon: dado.tipo,
                            confirmButtonText: 'OK'
                        })
                        $('#table-vendedor').DataTable().ajax.reload()
                    }
                })
     }
})
})
})
