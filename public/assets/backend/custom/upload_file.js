

function previewFile(file) {
    if (file.files && file.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            if (file.files[0].type.split("/")[0] == 'video')
                $('#show-file').attr('src', e.target.result).parent()[0].load();
            else
                file.nextElementSibling.children[0].setAttribute('src', e.target.result);
        }
        reader.readAsDataURL(file.files[0]);
    } else {
        $('#show-file').attr('src', file.value).parent()[0].load();
    }
}


//preview multi image
// function changImage(file){
//     $(`.row-image`).html(" ");

//     $.each(file.files,function(key,value){

//             $('.row-image').append(`<div class="column"> <img src="/storage/uploads/posts/${value['name']}"
//             class="img-border img-thumbnail"  id="show-file-${key}"></div>`);
//     });

// }
function changImage(file){
    $(`.row-image`).html(" ");
    $.each(file.files,function(key,value){
        var url = window.URL.createObjectURL(value);
                    $('.row-image').append(`<div class="column"> <img src="${url}"
                    class="img-border img-thumbnail"  id="show-file-${key}"></div>`);
            });

}
