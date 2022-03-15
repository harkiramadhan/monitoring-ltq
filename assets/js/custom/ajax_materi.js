$(document).ready(function(){
    $('.btn-edit').click(function(){
        var id = $(this).attr('data-id')
        $.ajax({
            url: siteUrl + 'materi/edit',
            type: 'get',
            data: {id : id},
            success: function(res){
                $('.modal-content-edit').html(res)
                $('#editMateri').modal('show')
            }
        })
    })
})