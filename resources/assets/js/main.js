if (document.getElementById('buildings-block__map')){
	var BuildingsBlock__Map = new google.maps.Map(document.getElementById('buildings-block__map'), {
	  center: {lat: 50.2, lng: 30.42},
	  zoom: 5,
	  disableDefaultUI: true,
	  scrollwheel: false
	});
}

$(document).ready(function(){

	$('.removable__remove').click(function(e){
		e.preventDefault();
		$(this).parents('.removable').remove();
	});

	$('.buildings-block__nav-tab').click(function(){
		$(this).parents('.buildings-block').find('.buildings-block__tab_active').removeClass('buildings-block__tab_active');
		$(this).parents('.buildings-block__tab').addClass('buildings-block__tab_active');
	});

	$('.calendar-block__date_active').click(function(){
		$(this)
			.siblings('.calendar-block__date_active')
			.find('.calendar-block__events')
			.slideUp();
		$(this)
			.find('.calendar-block__events')
			.slideToggle();
	});

	$('.calendar__day').click(function(){
		$(this)
			.parents('.calendar__date_active')
			.siblings('.calendar__date_active')
			.find('.calendar__events')
			.slideUp();
		$(this)
			.parents('.calendar__date_active')
			.find('.calendar__events')
			.slideToggle();
	});
	$('.calendar__carret').click(function(){
		$(this)
			.parents('.calendar__date_active')
			.siblings('.calendar__date_active')
			.find('.calendar__events')
			.slideUp();
		$(this)
			.parents('.calendar__date_active')
			.find('.calendar__events')
			.slideToggle();
	});

	$('.job').click(function(){
		var block = $(this);
		block.toggleClass('job_expand');
		block.find('.job__preview').slideToggle();
		block.find('.job__full').slideToggle();
	});
	
	$('.tabs__nav').click(function(e){
		e.preventDefault();
		var block=$(this).parents('.tabs');
		block.find('.tabs__nav_active').removeClass('tabs__nav_active');
		block.find('.tabs__tab_active').removeClass('tabs__tab_active');
		$(this).addClass('tabs__nav_active');
		$($(this).attr('href')).addClass('tabs__tab_active');
	});

	$('.page-tabs__nav').click(function(e){
		e.preventDefault();
		var block=$(this).parents('.page-tabs');
		block.find('.page-tabs__nav_active').removeClass('page-tabs__nav_active');
		block.find('.page-tabs__tab_active').removeClass('page-tabs__tab_active');
		$(this).addClass('page-tabs__nav_active');
		$($(this).attr('href')).addClass('page-tabs__tab_active');
	});

	$('.buildings-map__hide').click(function(e){
		e.preventDefault()
		var block=$(this).parents('.buildings-map');
		block.find('.buildings-map__map').slideToggle();
	});

	$('.building__gallery-image').click(function(e){
		e.preventDefault();
		var block=$(this).parents('.building');
		block
			.find('.building__image')
			.attr('src',this.href)
	});

	$('.company-cart-slider').flexslider({
	    animation: "slide",
	    animationLoop: false,
	    controlNav: false,
	    itemWidth: 510,
	    itemMargin: 20,
	});

	$('.building__gallery').flexslider({
		animation: "slide",
		animationLoop: false,
		controlNav: false,
		itemWidth: 167,
		itemMargin: 10
	});


	$('.masonry').imagesLoaded(function(){
		$('.masonry').masonry();
	});

});