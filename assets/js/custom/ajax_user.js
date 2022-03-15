$(document).ready(function(){
    $('.btn-submit').attr('disabled', true)
    $('.btn-submit').addClass('disabled')

    var activeCardDetail = localStorage.getItem('user-card-detail')
    if(activeCardDetail){
        getDetail(activeCardDetail)
    }

    $('.btn-detail').click(function(){
        var id = $(this).attr('data-id')
        getDetail(id)
    })

    function getDetail(id){
        $.ajax({
            url: siteUrl + 'user/detail',
            type: 'get',
            data: {id : id},
            success: function(res){
                $('.div-detail').html(res)
                localStorage.setItem('user-card-detail', id)
            }
        })
    }

    $('#username').on('input', function(){
        var username = $('#username').val().replace(/[^A-Z0-9]/ig, "")
        var minlength = 5
        $('#username').val(username)
      
        if(username.length === 0){
          $('#username').removeClass('is-valid')
          $('#username').removeClass('is-invalid')
        }

        if(username.length < 5 ){
            $('#username').addClass('is-invalid')
            $('.text-username').text('*) Username Minimal 5 Karakter')
            $('.btn-submit').addClass('disabled')
        }
      
        if(username.length >= minlength){
          $.ajax({
            url: baseUrl + '/user/checkusername',
            type: 'get',
            data : {username : username},
            success: function(result){
              if(result=== '1'){
                $('#username').removeClass('is-valid')
                $('#username').addClass('is-invalid')
                $('.text-username').text('*) Username Sudah Tersedia, Silahkan Gunakan Username Yang Lain')
                $('.btn-submit').attr('disabled', true)
                $('.btn-submit').addClass('disabled')
              }else{
                $('#username').removeClass('is-invalid')
                $('#username').addClass('is-valid')
                $('.text-username').text('*) Gunakan Huruf Kecil')
                $('.btn-submit').attr('disabled', false)
                $('.btn-submit').removeClass('disabled')
              }
            }
          })
        }
    })

    var inputPassword = $('#input-password')
    $('#confirm-password').on('input', function(){
        if(inputPassword.length > 0){
            if(inputPassword.val() === $(this).val()){
                $(this).removeClass('is-invalid')
                $(this).addClass('is-valid')
                $('.text-confirm').text('*')
                $('.btn-submit').attr('disabled', false)
                $('.btn-submit').removeClass('disabled')
            }else{
                $(this).addClass('is-invalid')
                $(this).removeClass('is-valid')
                $('.text-confirm').text('*) Password Tidak Cocok')
                $('.btn-submit').attr('disabled', true)
                $('.btn-submit').addClass('disabled')
            }
        }
    })
})