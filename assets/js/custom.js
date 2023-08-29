$(document).ready(function () {
	var windowWidth = $(window).width();
	var window_width = $(window).width();
	console.log('Designed & Developed by Saiful, Shaon, Asha');
	$('body').prepend('<div class="Overlay"></div><div class="form-overlay"></div>');

	setTimeout(function(){ 	$('#loading').css('display','none') }, 2000);
	// $(".profile_content_body").mCustomScrollbar();

	//------------ Light gallery
	if ($('.Light').length > 0) {
		$(".Light").lightGallery({
			selector: 'a'
		});
	}

	//------------ Light gallery with thumbnail
	if ($('.LightThumb').length > 0) {
		$(".Light").lightGallery({
			selector: 'a',
			exThumbImage: 'data-exthumbimage'
		});
	}

	//------------ nice select
	if ($('.Select').length > 0) {
		$('.Select select').niceSelect();
	}







	// ------------------------- T.A.1.0-Gallery-06 start
	if ($('.FilterFile').length > 0) {
		var container = $('.FilterFile');
		var container_height = container.height();
		var $grid = container.isotope('reLayout',{
			itemSelector: '.asViewFile',
			percentPosition: true,
			layoutMode: 'fitColumns',
			masonry: {
				columnWidth: '.asViewFile'
			}
		});
		$('.FilterNav a').on('click', function () {
			var filterValue = $(this).attr('data-filter');
			$grid.isotope({filter: filterValue});
			$('.FilterNav a').removeClass('active');
			$(this).addClass('active');
			return false;
		});

		// mobile filter
		$('.FilterMobile li').on('click', function () {
			var filterValue = $(this).attr('data-value');
			$grid.isotope({filter: filterValue});
		});

		if (768 < windowWidth) {
			container.css({'min-height': container_height})
		}


	}

	// ------------------------- T.A.1.0-Gallery-06 end













	//------------date picker-----------------//



	if ($('.ourteam_slider_init').length > 0) {
		$('.ourteam_slider_init').slick({
			infinite: true,
			slidesToShow:3,
			slidesToScroll: 1,
			speed: 700,
			dots: true,
			autoplay: false,
			pauseOnFocus: false,
			pauseOnHover: false,
			draggable: true,
			cssEase: 'ease',
			arrows: false,

			// autoplay: true,
			responsive: [

				{
					breakpoint: 767,
					settings: {
						speed: 2000,
						slidesToShow: 2,
						slidesToScroll: 1,
						dots: false,
						arrows: true,
						draggable: true,
						autoplay: true,

					}
				}



			]
		});
	}

















});//document.ready



