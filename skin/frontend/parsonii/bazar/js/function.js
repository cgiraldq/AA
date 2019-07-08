jQuery('#header .page-header-container').removeClass('menu-fixed');
instagram();

jQuery(window).load(function() {
	height();
	footer();
});

jQuery(window).resize(function() {
	height();
	footer();
	instagram();
});

jQuery(document).ready(function() {
		
	if($j(window).width() > 771){
		if (!jQuery('body').hasClass('cms-home')){
				jQuery("#nav .level0 div").remove();
				jQuery("#nav .level0 a").removeClass('icon-v');
		 }
	}

	jQuery(window).on('scroll', function() {

		if($j(window).width() > 768){
		
			if (jQuery(window).scrollTop() > 670) {
				jQuery('.cms-home .page-header-container').removeClass('menu-fixed-old');
				jQuery('.cms-home .page-header-container').addClass('menu-fixed');
				jQuery('.page-title-home').css('margin-top', '33px');
			} else {
				jQuery('.cms-home .page-header-container').removeClass('menu-fixed');
				jQuery('.cms-home .page-header-container').addClass('menu-fixed-old');
				jQuery('.page-title-home').css('margin-top', '-160px');
			}
			
		}
	});

	jQuery('#lupa').click(function() {

		jQuery('#popup').fadeIn('slow');

		var alto = jQuery(window).height() + 20;
		jQuery('#popup').height(alto);

		var scroll = jQuery(window).scrollTop();
		jQuery('#popup').css('margin-top', scroll);
		return false;
	});
	
	jQuery('#mapin').click(function() {
		
		window.location.href="http://192.185.194.27/~adrianaarango/index.php/tiendas";
		
		/*jQuery('#popup-tiendas').fadeIn('slow');

		var alto = jQuery(window).height() + 20;
		jQuery('#popup-tiendas').height(alto);

		var scroll = jQuery(window).scrollTop();
		jQuery('#popup-tiendas').css('margin-top', scroll);*/
		return false;
	});

	jQuery('.close-popup').click(function() {

		jQuery('.popup').fadeOut('slow');
		return false;
	});

	jQuery(window).scroll(function() {

		if (jQuery('.popup').is(":visible")) {
			jQuery('.popup').css('margin-top', jQuery(window).scrollTop());
		}
	});
	
	jQuery('.desaparece').hover(function(){
      jQuery(this).animate({opacity:1});
  	},function(){
      jQuery(this).animate({opacity:0});
  });

});

function height() {

		var ancho = jQuery(window).width();

		var alto_page = jQuery('.page-title-home').height();
		var height = alto_page + 33;
	
	if (ancho < 771) {
		
		var height2 = height + 150;
		
		jQuery(".alto-page").height(height2);

	} else {
		jQuery(".alto-page").height(height);
	}
}

function footer() {

	if (jQuery(window).width() > 770) {

		var alto_screen = jQuery(window).height();
		var alto_page = jQuery('.page').height();
		
		var resta;
		if(alto_page < alto_screen){
			resta = alto_screen - alto_page
		}

		jQuery(".footer-before-container").height(resta);

	} else {
		jQuery(".footer-before-container").height('0');
	}
}

function instagram() {
	jQuery("#instansive_e6ac80e19f").height(jQuery("#instansive_e6ac80e19f").width());
}