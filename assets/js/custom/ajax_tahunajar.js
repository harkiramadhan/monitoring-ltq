$(document).ready(function(){
    var activeCardDetail = localStorage.getItem('ta-card-detail')
    if(activeCardDetail){
        getDetail(activeCardDetail)
    }

    $('.btn-detail').click(function(){
        var id = $(this).attr('data-id')
        getDetail(id)
    })

    $('.btn-active').click(function(){
        var id = $(this).attr('data-id')
        $.ajax({
            url: siteUrl + 'tahunajar/active',
            type: 'post',
            data: {id : id},
            success: function(res){
                localStorage.setItem('ta-card-detail', id)
                location.reload()
            }
        })
    })

    function getDetail(id){
        $.ajax({
            url: siteUrl + 'tahunajar/detail',
            type: 'get',
            data: {id : id},
            success: function(res){
                $('.div-detail').html(res)
                localStorage.setItem('ta-card-detail', id)
            }
        })
    }
})