$(document).ready(function(){
    $('.btn-detail').click(function(){
        var id = $(this).attr('data-id')
        $.ajax({
            url: siteUrl + 'kelas/detail',
            type: 'get',
            data: {id : id},
            success: function(res){
                $('.div-detail').html(res)
            }
        })
    })

    $('.btn-edit').click(function(){
        var id = $(this).attr('data-id')
        $.ajax({
            url: siteUrl + 'kelas/edit',
            type: 'get',
            data: {id : id},
            success: function(res){
                $('.modal-content-edit').html(res)
                $('#editKelas').modal('show')
            }
        })
    })
})