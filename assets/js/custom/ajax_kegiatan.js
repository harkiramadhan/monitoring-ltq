$(document).ready(function(){
    var activeCardDetail = localStorage.getItem('kegiatan-card-detail')
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
            url: siteUrl + 'kegiatan/edit',
            type: 'get',
            data: {id : id},
            success: function(res){
                $('.modal-content-edit').html(res)
                $('#editKegiatan').modal('show')
            }
        })
    })

    function getDetail(id){
        $.ajax({
            url: siteUrl + 'kegiatan/detail',
            type: 'get',
            data: {id : id},
            success: function(res){
                $('.div-detail').html(res)
                localStorage.setItem('kegiatan-card-detail', id)
            }
        })
    }
})