$(document).ready(function(){
    $('.btn-detail').click(function(){
        var id = $(this).attr('data-id')
        $.ajax({
            url: siteUrl + 'tahunajar/detail',
            type: 'get',
            data: {id : id},
            success: function(res){
                $('.div-detail').html(res)
            }
        })
    })

    $('.btn-active').click(function(){
        var id = $(this).attr('data-id')
        $.ajax({
            url: siteUrl + 'tahunajar/active',
            type: 'post',
            data: {id : id},
            success: function(res){
                location.reload()
            }
        })
    })
})