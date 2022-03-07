$(document).ready(function(){
    $('.btn-detail').click(function(){
        var id = $(this).attr('data-id')
        $.ajax({
            url: siteUrl + 'siswa/detail',
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
            url: siteUrl + 'siswa/edit',
            type: 'get',
            data: {id : id},
            success: function(res){
                $('.modal-content-edit').html(res)
                $('#editSiswa').modal('show')
            }
        })
    })

    function previewImage() {
        var element = document.getElementById("image-preview")
            element.classList.remove("d-none")
    
        document.getElementById("image-preview").style.display = "block"
        var oFReader = new FileReader()
         oFReader.readAsDataURL(document.getElementById("image-source").files[0])
    
        oFReader.onload = function(oFREvent) {
          document.getElementById("image-preview").src = oFREvent.target.result
        }
    }
})