if (document.getElementById('buildings-block__map')){
	var BuildingsBlock__Map = new google.maps.Map(document.getElementById('buildings-block__map'), {
	  center: {lat: 50.2, lng: 30.42},
	  zoom: 5,
	  disableDefaultUI: true,
	  scrollwheel: false
	});
}

if (document.getElementById('buildings-map__map')){
	var BuildingsMap__Map = new google.maps.Map(document.getElementById('buildings-map__map'), {
		center: {lat: 50.2, lng: 30.42},
		zoom: 7,
		disableDefaultUI: true,
		scrollwheel: false
	});
	var marker_1 = new google.maps.Marker({
		position: {lat: 50.4, lng: 30.12},
		map: BuildingsMap__Map,
		title: 'Hello World!'
	});
	var marker_2 = new google.maps.Marker({
		position: {lat: 50.3, lng: 30.52},
		map: BuildingsMap__Map,
		title: 'Hello World!'
	});
	var marker_3 = new google.maps.Marker({
		position: {lat: 49.9, lng: 30.32},
		map: BuildingsMap__Map,
		title: 'Hello World!'
	});
	var marker_4 = new google.maps.Marker({
		position: {lat: 49.5, lng: 30.22},
		map: BuildingsMap__Map,
		title: 'Hello World!'
	});
}

$(document).ready(function(){
	$('.buildings-block__nav-tab').click(function(){
		$(this).parents('.buildings-block').find('.buildings-block__tab_active').removeClass('buildings-block__tab_active');
		$(this).parents('.buildings-block__tab').addClass('buildings-block__tab_active');
	});
	$('.job__toggle').click(function(){
		var job = $(this).parents('.job'); 
		job.toggleClass('job_expand');
		job.find('.job__preview').slideToggle();
		job.find('.job__full').slideToggle();
	});
	$('.tabs__nav').click(function(e){
		e.preventDefault();
		var tabs=$(this).parents('.tabs');
		tabs.find('.tabs__nav_active').removeClass('tabs__nav_active');
		tabs.find('.tabs__tab_active').removeClass('tabs__tab_active');
		$(this).addClass('tabs__nav_active');
		$($(this).attr('href')).addClass('tabs__tab_active');
	});

	$('.page-tabs__nav').click(function(e){
		e.preventDefault();
		var tabs=$(this).parents('.page-tabs');
		tabs.find('.page-tabs__nav_active').removeClass('page-tabs__nav_active');
		tabs.find('.page-tabs__tab_active').removeClass('page-tabs__tab_active');
		$(this).addClass('page-tabs__nav_active');
		$($(this).attr('href')).addClass('page-tabs__tab_active');
	});

	$('.slider').flexslider({
	    animation: "slide",
	    animationLoop: false,
	    controlNav: false,
	    itemWidth: 510,
	    itemMargin: 20,
	  });
});