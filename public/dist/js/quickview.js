$('.js-show-modal1').click(function (e) {
    var id = $(this).attr('href');

    quickview(id);

    e.preventDefault();
});

function quickview (id) {
    
    $.get('/product/quickview/' + id, function(data, status){
        if(status == 'success') {
            data = JSON.parse(data);
            
            $('.js-modal1 .js-name-detail').text(data.name);
            if (data.unit) {
                data.price = data.price * dollar_cost;
            }
            if (data.offer != 0) {
                data.price = data.price - (data.price * data.offer) / 100;
            }
            
            $('.js-modal1 .price').text(numeral(data.price).format('0,0') + ' تومان');
            $('.js-modal1 .short-description').text(data['short_description']);


            if (data.colors)
            {
                colors = data.colors.split(',');
                var color_options = '';
                for (var i = 0; i < colors.length; ++i) {
                    color_options += '<input type="radio" value="' + colors[i] + '"';
                    color_options += 'name="color" id="color'+i+'" />';
                    color_options += '<label for="color'+i+'"><span class="badge color" '; 
                    color_options += 'style="background: ' + colors[i] + ';">';
                    color_options += '<i class="fa fa-check" aria-hidden="true"></i></span></label>';
                }
                $('.colors-input').parent().show();
                $('.colors-input').html(color_options);
                $('.colors-input input[type="radio"]:first-of-type').prop( "checked", true );
            } else {
                $('.colors-input').parent().hide();
            }
            
            var photos = JSON.parse(data.gallery);            
            var gallery = '<div class="wrap-slick3-dots"></div>';
            gallery += '<div class="wrap-slick3-arrows flex-sb-m flex-w"></div>';
            gallery += '<div class="slick3 gallery-lb">';
									
            for (photo in photos) {
                gallery += '<div class="item-slick3" data-thumb="/uploads/' + photos[photo] + '">';
                gallery += '<div class="wrap-pic-w pos-relative">';
                gallery += '<img src="/uploads/' + photos[photo] + '" alt="IMG-PRODUCT">';
                gallery += '<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" ';
                gallery += 'href="uploads/' + photos[photo] + '">';
                gallery += '<i class="fa fa-expand"></i></a></div></div>';
            }
            gallery += '</div>';

            if (data.aparat_video) {
                var video = '<div id="aparat_video" class="m-b-30">';
                video += '<script type="text/JavaScript" src="https://www.aparat.com/embed/' + data.aparat_video + '?data[rnddiv]=aparat_video&data[responsive]=yes"></script>';
                video += '</div>';

                $('.js-modal1 .video').html(video);
            } else {
                $('.js-modal1 .video').html('');
            }
            
            $('.js-modal1 .product-gallery').html(gallery);
            $('.js-modal1 .js-addcart-detail').click(function () 
            {
                var count = $(this).prev().find('input').val();
                var color = $("input[type='radio']:checked").val();
                window.location = '/cart/add/'+id+'/+'+data.name+'/' + count + '/' + color;
            });

            $('.js-addcart-detail').click(function ()
		{
		});

            $('.wrap-slick3').each(function(){
                $(this).find('.slick3').slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    fade: true,
                    infinite: true,
                    autoplay: false,
                    autoplaySpeed: 6000,
    
                    arrows: true,
                    appendArrows: $(this).find('.wrap-slick3-arrows'),
                    prevArrow:'<button class="arrow-slick3 prev-slick3"><i class="fa fa-angle-left" aria-hidden="true"></i></button>',
                    nextArrow:'<button class="arrow-slick3 next-slick3"><i class="fa fa-angle-right" aria-hidden="true"></i></button>',
    
                    dots: true,
                    appendDots: $(this).find('.wrap-slick3-dots'),
                    dotsClass:'slick3-dots',
                    customPaging: function(slick, index) {
                        var portrait = $(slick.$slides[index]).data('thumb');
                    },  
                });
            });

            $('.js-modal1').addClass('show-modal1');
        }
    });
}