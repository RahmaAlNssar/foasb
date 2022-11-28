// const { inProduction } = require("laravel-mix");



// const { then } = require("laravel-mix");

//select multi rows to delete
function toggle(source) {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i] != source) checkboxes[i].checked = source.checked;
    }
}

//alert delete one row
$(document).on("click", "#warning", function (e) {


    e.preventDefault();
    var id = $(this).data("id");
    var href = $(this).attr("href");
    var token = $("meta[name='csrf-token']").attr("content");

    Swal.fire({
        title: "هل تريد  حذف السطر ؟?",
        icon: "question",
        iconHtml: "؟",
        confirmButtonText: "نعم",
        cancelButtonText: "لا",
        showCancelButton: true,
        showCloseButton: true,
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: href,
                type: "DELETE",
                data: { id: id, _token: token },
                dataType: "json",

            })
                .done(function (response) {
                    swal.fire(
                        response.title,
                        response.message,
                        response.status
                    ).then((result) => {
                        // Reload the Page
                        $(".example").DataTable().ajax.reload();
                    });
                })
                .fail(function() {

                    swal.fire("Oops...","يوجد خطأ ما","error");

                });
                // .error(function( data ) {
                //     // uh oh, something went wrong a 4xx response was returned (could be 400, 422 etc)
                //     // backend - return response()->json(['message' => 'Email is not in the proper format!'], 422);
                //     swal("Oops...", data.responseJSON.message, "error");
                // });
        }
    });
});

// store and update

$(document).on("submit", ".submit", function (e) {

    //Some code 1
    e.preventDefault();

    var action = $(this).attr("action");
    var token = $("meta[name='csrf-token']").attr("content");
    var data = $(this).serialize();
    var type = $(this).attr("method");
    let form = $(this);
    $.ajax({
        type: type,
        url: action,
        data: data,
        dataType: "json",
        success: function (response) {
            swal.fire(response.title, response.message, response.status);
            form.trigger("reset");

        },
        error: function (err,data,response,jqXhr) {
            var elem = err.responseText;
            var ss = jQuery.parseJSON( '[' + elem + ']' );

            $.each(ss[0]['errors'], function (key, value) {

                $(`#${key}`).text(value[0]);

            });
        },
    });
});

//update status
$(document).on("click", ".toggle-class", function (e) {
    e.preventDefault();
    var token = $("meta[name='csrf-token']").attr("content");
    var id = $(this).data("id");
    var href = $(this).attr("href");
    Swal.fire({
        title:"هل تريد تعديل الحالة؟",
        icon: "question",
        iconHtml: "؟",
        confirmButtonText: "نعم",
        cancelButtonText: "لا",
        showCancelButton: true,
        showCloseButton: true,
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: href,
                type: "post",
                data: { _token: token },
                dataType: "json",
            })
                .done(function (response, dataResult) {
                    swal.fire(
                        response.title,
                        response.message,
                        response.status
                    ).then((result) => {
                        // Reload the Page
                        $(".example").DataTable().ajax.reload();
                    });
                    // $(".example").location.reload();
                })
                .fail(function () {
                    swal.fire("Oops...","حدث خطأ ما", "error");
                });
        }
    });
});

//multi delete rows
$(document).on("click", ".multi-delete", function (e) {
    e.preventDefault();
    var id = [];
    var token = $("meta[name='csrf-token']").attr("content");
    var href = $(this).attr("href");
    $(".checkbox:checked").each(function () {
        id.push($(this).val());
    });
    Swal.fire({
        title: "هل تريد حذف الأسطر المحددة؟ ",
        icon: "question",
        iconHtml: "؟",
        confirmButtonText: "نعم",
        cancelButtonText: "لا",
        showCancelButton: true,
        showCloseButton: true,
    }).then((result) => {

        if (id.length > 0 && result.value) {
            $.ajax({
                type: "delete",
                url: href,
                data: { id: id, _token: token },
                dataType: "json",
                success: function (response) {
                    swal.fire(
                        response.title,
                        response.message,
                        response.status
                    ).then((result) => {
                        // Reload the Page
                        $(".example").DataTable().ajax.reload();
                    });
                },
                error: function (data) {

                   swal.fire("Oops...", data.responseJSON.message, "error");
                },
            });
        } else {

            swal.fire("Oops...","حدث خطأ ماg", "error");
        }
    });
});

//submit form store and update with upload img
$('body').on('submit', 'form.submit-form', function(e) {
    e.preventDefault();

    let form = $(this);

    form.find('span.error').fadeOut(200);
    form.parent().addClass('load');

    $.ajax({
        url: form.attr('action'),
        type: "POST",
        data: new FormData($(this)[0]), "_token": "{{ csrf_token() }}",
        dataType: 'JSON',
        processData: false,
        contentType: false,
        success: function (data, textStatus, jqXHR,response) {
            if (data.redirect) {
                return window.location = data.redirect;
            }
            $('.modal').modal("hide");
            swal.fire(data.title, data.message, data.status);
            form.trigger("reset");



        },
        // error: function (jqXhr, textStatus, errorMessage) {
        //     if (jqXhr.readyState == 0) {
        //         return false;
        //     } else if (jqXhr.status == 422) {
        //         $.each(jqXhr.responseJSON.errors, function (key, val) {
        //             key = key.split('.');
        //             if (key.length > 1) {
        //                 form.find(`input[name*='${key[0]}[${key[1]}][${key[2]}]']`).parent().next('span.error').text(val).fadeIn(300);
        //             } else {
        //                 form.find(`#${key}-error`).text(val).fadeIn(300);
        //             }
        //         });
        //     } else {
        //         if (jqXhr.responseJSON.line) {
        //             toast('File: ' + jqXhr.responseJSON.file + ' (Line: ' + jqXhr.responseJSON.line + ')', jqXhr.responseJSON.message)
        //         } else {
        //             toast(jqXhr.responseJSON, title = null);
        //         }
        //     }
        // },
        error: function (err,data,response,jqXhr) {
            var elem = err.responseText;

            var ss = jQuery.parseJSON( '[' + elem + ']' );

            $.each(ss[0]['errors'], function (key, value) {

                // $.each(value, function (key1, value1) {

                //     $(`#${key1}`).text(value1);
                // });


                   $(`#input-${key}`).text(value[0]);



            });
        },
        complete: function() { form.parent().removeClass('load'); }
    });
});


// $(document).on("submit", "#form", function (e) {
//     //Some code 1

//     e.preventDefault();

//     var action = $(this).attr("action");
//     var token = $("meta[name='csrf-token']").attr("content");
//     var data = $("input[name='file']").val();

//     var type = $(this).attr("method");
//     let form = $(this);

//             $.ajax({
//                 url: action,
//                 type: type,
//                 data:{data,_token:token},
//                 dataType: "json",
//                 success:function (results) {
//                     if (results.success === true) {
//                         swal.fire(results.title,results.message,results.status
//                             ).then((result) => {
//                                 // Reload the Page
//                                 $(".example").DataTable().ajax.reload();
//                             });
//                     } else {
//                         swal.fire("Error!", "يوجد خطأ", "error");
//                     }

//                 },
//                 error: function (err,data,response,jqXhr) {
//                     var elem = err.responseText;
//                     var ss = jQuery.parseJSON( '[' + elem + ']' );

//                     $.each(ss[0]['errors'], function (key, value) {

//                         $(`#${key}`).text(value[0]);

//                     });
//                 },
//             })



// });

//تلوين السطر من جدول الاشعارات يلي برحلو من الجرس
$(document).on('click','#href',function(e){
    e.preventDefault();
    var route = $('#href').attr('href');
    var str = route.lastIndexOf('/');
    var id = route.substring(45,route.length);

    // const url = new URL(route);
    // let id = url.pathname.slice(24);
    var count = $('#notifications_count').text();

    $.ajax({
        type: 'get',
        url: route,
       // data: data,
       // dataType: "json",
        success: function (response) {
            count--;
            $(`#color_${id}`).css("background-color", "#5c8a8a") ;
            location.reload(false);
        },
        error: function (err) {
           console.log(err);
        },
    });

  });

  //auto update table after insert rows into db
//   function updateTable() {

//     $.ajax({
//         success: function (data) {

//             $(".example_complain").DataTable().ajax.reload()
//         }

//     });
// }
//   $(document).ready(function (e) {
//     updateTable();
//     setInterval(updateTable , 3000);
// });


$(document).on("click", "#upload_link", function (e) {

    e.preventDefault();

    var input= $('input[type=file]').val();
    alert(input);

});

//show modal display images
$(document).on("click","#modal-images",function(e){
    e.preventDefault();
    var route = $(this).attr("href");
    var token = $("meta[name='csrf-token']").attr("content");
    var data = $("input[name='file']").val();

    var type = $(this).attr("method");
    let form = $(this);
    $.ajax({
        type: 'get',
        url: route,
       // data: data,
       // dataType: "json",
        success: function (response) {
           $("#load-form").show();
           $(".form-body").html(" ");
           for(let i =0; i<response.length; i++){
            $(".form-body").append(`<img src="/storage/uploads/posts/${response[i]['image']}" alt=""  height="150" width="150">`);

           }


        },
        error: function (err) {
           console.log(err);
        },
    });
})

//close modal by button x
$(document).on("click",".close",function(e){
    $("#load-form").hide();
});
