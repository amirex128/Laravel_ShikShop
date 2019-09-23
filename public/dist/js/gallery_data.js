$('.delete-photo').on('click',function(event){

    event.stopPropagation();
    event.preventDefault();
    // return;

    var title = $(this).parent().prev().text().trim();
    var filename = $(this).attr('filename');
    var id = $(this).attr('photo');

    swal({   
        title: "مطمین هستید ؟",   
        text: "برای پاک کردن تصویر " + title + " مطمین هستید ؟",   
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#f83f37",   
        confirmButtonText: "بله",   
        cancelButtonText: "خیر",   
        closeOnConfirm: false,   
        closeOnCancel: false 
    }, function(isConfirm){   
        if (isConfirm) {
            window.location =  '/panel/gallery/delete/' + id + '/' + title + '/' + filename; 
        } else {     
            swal("لغو شد", "هیچ تصویری حذف نشد :)", "error");   
        } 
    });
    return false;
});

$('.edit-photo').on('click',function(event){

    event.stopPropagation();
    event.preventDefault();

    var title = $(this).parent().prev().text().trim();
    var link = $(this).attr('href');

    swal({   
        title: "مطمین هستید ؟",   
        text: "برای ویرایش تصویر " + title + " مطمین هستید ؟",   
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#f83f37",   
        confirmButtonText: "بله",   
        cancelButtonText: "خیر",   
        closeOnConfirm: false,   
        closeOnCancel: false 
    }, function(isConfirm){   
        if (isConfirm) {
            window.location =  link; 
        } else {     
            swal("لغو شد", "هیچ تصویری ویرایش نشد :)", "error");   
        } 
    });
    return false;
});