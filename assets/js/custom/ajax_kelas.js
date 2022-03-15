$(document).ready(function(){
    var activeCardDetail = localStorage.getItem('kelas-card-detail')
    if(activeCardDetail){
        getDetail(activeCardDetail)
    }

    $('.btn-detail').click(function(){
        var id = $(this).attr('data-id')
        getDetail(id)
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

    function getDetail(id){
        $.ajax({
            url: siteUrl + 'kelas/detail',
            type: 'get',
            data: {id : id},
            success: function(res){
                $('.div-detail').html(res)
                localStorage.setItem('kelas-card-detail', id)
            }
        })
    }
})