function previewImage2() {
    var element = document.getElementById("image-preview2")
        element.classList.remove("d-none")

    document.getElementById("image-preview2").style.display = "block"
    var oFReader = new FileReader()
     oFReader.readAsDataURL(document.getElementById("image-source2").files[0])

    oFReader.onload = function(oFREvent) {
      document.getElementById("image-preview2").src = oFREvent.target.result
    }
}

$(document).ready(function(){
    $('.btn-detail').click(function(){
        var id = $(this).attr('data-id')
        $.ajax({
            url: siteUrl + 'guru/detail',
            type: 'get',
            data: {id : id},
            success: function(res){
                $('.div-detail').html(res)
            }
        })
    })
})