$(document).ready(function(){
	$('#slider-image').slick({
		slidesToShow: 4,
		slidesToScroll: 1,
//		asNavFor: '.slider-for',
dots: true,
arrow:true,
focusOnSelect: true,

});
	$('.col-md-12').lightGallery({
		mode      : 'slide',
		pager:true,
		selector:'a',
		easing    : 'linear',
		controls  : true,
		counter   : false,
	});
});