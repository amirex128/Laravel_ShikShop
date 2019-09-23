$(document).ready(function(){
 
    // selectable group section
    $('select.select2').select2();
    
    // dropable picture upload
    var drEvent = $('.dropify').dropify({
        messages: {
            'default': 'فایل مورد نظر را به اینجا بکشید یا کلیک کنید',
            'replace': 'برای جایگذاری فایل کلیک کنید یا فایل را در اینجا رها کنید',
            'remove':  'پاک کردن',
            'error':   'متاسفانه خطایی رخ داد !'
        },
        error: {
            'fileSize': 'حجم فایل نباید بیش از 512 کیلوبایت باشد .',
            'imageFormat': 'لطفا عکسی به صورت مربع<br/> (نسبت 1 به 1) انتخاب کنید'
        }
    });

    drEvent.on('dropify.beforeClear', function(){
        var filename = $(this).parent().find('input[type="file"]').attr('filename');
        var images = JSON.parse($('input[name="deleted_images"]').val());
        images[images.length] = filename;
        $('input[name="deleted_images"]').val(JSON.stringify(images));

        $(this).parent().parent().remove();
    });


    $('.add-new-image').click(function () {
        var temp = '<div class="col-md-3 mt-20"><input type="file" name="images[]"'; 
        temp += 'data-allowed-formats="square" data-max-file-size="512K" class="dropify" /></div>';

        $('.images-gallery').append(temp);
        $('.images-gallery').find('.dropify:last-of-type').dropify({
            messages: {
                'default': 'فایل مورد نظر را به اینجا بکشید یا کلیک کنید',
                'replace': 'برای جایگذاری فایل کلیک کنید یا فایل را در اینجا رها کنید',
                'remove':  'پاک کردن',
                'error':   'متاسفانه خطایی رخ داد !'
            },
            error: {
                'fileSize': 'حجم فایل نباید بیش از 512 کیلوبایت باشد .',
                'imageFormat': 'لطفا عکسی به صورت مربع<br/> (نسبت 1 به 1) انتخاب کنید'
            }
        });
    });

    $('.dropify.exists').change(function () {
        let filename = $(this).parent().find('input[type="file"]').attr('filename');
        let images = JSON.parse($('input[name="deleted_images"]').val());
        images[images.length] = filename;
        $('input[name="deleted_images"]').val(JSON.stringify(images));
        $(this).removeClass('exists');
    });

    // Change color of color section labels
    $('.color-value').on('change', function () { 
        var color = $('select.color-value').val();
        $('input.color-value').val(color);
        
        var li = $('li.select2-selection__choice').first();
        for (var i = 0; i < color.length; ++i) {
            li.css({background: color[i]});
            li = li.next();
        }
    });
    
    $('.add-pics').click(function () { 
        var photo = $(this).parent().parent().prev().find('li').first();
        var photos = '';

        do {
            if (photo.find('a').hasClass('selected')) {
                photos += photo.attr('photo') + ',';
            }
            photo = photo.next();
        } while (photo.html() != undefined);

        photos = photos.substring(0, photos.length-1);
        if (photos.indexOf(',') != -1) {
            photo = photos.substring(0, photos.indexOf(','));
        } else {
            photo = photos;
        }
        
        $('#single_photo').val(photo);
        $('#gallery').val(photos);

        var temp = '';
        if (photos != '') {
            photos = photos.split(',');

            for (value in photos) {
                temp += '<div class="col-md-2 col-xs-4 mb-30"><div class="img-upload-wrap">';
                temp += '<input type="file" disabled data-show-remove="false" data-default-file="/uploads/'+photos[value]+'" class="dropify file" /></div></div>';
            }
        } else {
            photos = [];
        }


        $('.preview-gallery').html(temp);
        $('.preview-gallery .dropify').dropify();

        if (photos.length != 0) {
            $('.fileupload').removeClass('btn-default').addClass('btn-warning');
            $('.fileupload i').removeClass('fa-plus').addClass('fa-edit');
            $('.fileupload .btn-text').text('ویرایش تصاویر');
            $('#picture-files .alert').fadeOut();
        } else {
            $('.fileupload').removeClass('btn-warning').addClass('btn-default');
            $('.fileupload i').removeClass('fa-edit').addClass('fa-plus');
            $('.fileupload .btn-text').text('افزودن تصویر جدید');
            $('#picture-files .alert').fadeIn();
        }

    });
});

/* Datetimepicker Init*/
$('#datetimepicker1').datetimepicker({
    useCurrent: false,
    icons: {
            time: "fa fa-clock-o",
            date: "fa fa-calendar",
            up: "fa fa-arrow-up",
            down: "fa fa-arrow-down"
        },
}).on('dp.show', function() {
if($(this).data("DateTimePicker").date() === null)
    $(this).data("DateTimePicker").date(moment());
});