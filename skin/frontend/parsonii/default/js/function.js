jQuery(document).ready(function(){

	var p1=document.querySelector(".price-box .old-price .price").textContent;
	var specialPrice=document.querySelector(".price-box .special-price");
	var p2=specialPrice.querySelector(".price").textContent;
	//console.log(specialPrice);
	if(p1!=undefined && p2!=undefined){
		p1=p1.trim();
		p1=parseNumber(p1.substr(1));
		p2=p2.trim();
		p2=parseNumber(p2.substr(1));
		var discount=p1-p2;
	
		jQuery(specialPrice).after('<br><p class="saving"><span>Ahorro:</span><span>  $'+discount.toLocaleString()+'</span></p>');
	}


function discount(p1, p2) {
 p1=p1.trim();
 p1=parseFloat(p1.substr(1));

 p1=p1.trim();
 p1=parseFloat(p1.substr(1));
 console.log(p1+"-"+p2);
 var discount=p1-p2;
 return discount;
}


//quita clase cms-home que pone el menu sobre elbaner debajo del header

	//jQuery("body").removeClass('cms-home');


/* slider home*/
	
	if (jQuery('.main div').hasClass('breadcrumbs')){
		
		jQuery('.col1-layout').css('margin-top','0');		
		//jQuery('.main').css('margin-top','70px');
		jQuery(".main").addClass("margin-top-1-column");
		
		if (jQuery('.main-container').hasClass('col2-right-layout')){
			jQuery('.col2-right-layout').css('margin-top','0');
		}
	}
  

$j(".two-img").click(function() {
		console.log($j(this).find("a").attr("href"));
		//alert( "Handler for .click() called." );
		//window.location.assign($j(this).find("a").attr("href"));
});




  $j(".blog-post-view .breadcrumbs li.blog").html("<a href='http://www.adrianaarango.com/store/prensa'>VOLVER</a>");
$j(".cms-pagina-postead .breadcrumbs .cms_page").html("<a href='http://www.adrianaarango.com/store/prensa'>VOLVER</a>");

  var owl = $j(".cms-index-index .products-grid");
 
  owl.owlCarousel({
      items : 4, //10 items above 1000px browser width
      itemsDesktop : [1024,3], //5 items between 1000px and 901px
      itemsDesktopSmall : [900,3], // betweem 900px and 601px
      itemsTablet: [600,2], //2 items between 600 and 0
      itemsTablet: [500,1], //2 items between 600 and 0
      itemsMobile : false, // itemsMobile disabled - inherit from itemsTablet option
      autoPlay: true
  });
 
  // Custom Navigation Events
  $j("#fechauno").click(function(){
    owl.trigger('owl.next');
  })
  $j("#fechados").click(function(){
    owl.trigger('owl.prev');
  })
  $j(".play").click(function(){
    owl.trigger('owl.play',1000); //owl.play event accept autoPlay speed as second parameter
  })
  $j(".stop").click(function(){
    owl.trigger('owl.stop');
  })
 /* slider home*/


	


	if(ancho < 776){

	var altoimagen = (jQuery('.category-image').height()) + 30;
		jQuery(".catalog-category-view .main").animate({marginTop:altoimagen},0);	

	topNewLetter();


/* acordeon*/

 $j(".block-footer").click(function(){
         
    
        var contenido=$j('ul',this);

 console.log(contenido.css("display"))

        if(contenido.css("display")=="none"){ //open 
            $j('h4').removeClass("open");  
           $j('.block-footer > ul').slideUp(250);
         
          contenido.slideDown(250);         
          $j('h4',this).addClass("open");
        }
        else{ //close       
          contenido.slideUp(250);
          $j('h4').removeClass("open");  
        }

      });

/* acordeon*/


/*
var abierto = true;
	jQuery(".block-footer").click(function(){
		if(abierto == true) { 	
			
			jQuery('ul',this).show();
			abierto  = false; 
			return true;
		} else {

			jQuery('ul',this).hide();
			abierto  = true; 
			return true;
		}
	});
*/


} else {

	var altoimagen = (jQuery('.category-image').height()) + 70;
		jQuery(".catalog-category-view .main").animate({marginTop:altoimagen},0);	
};
	
	modifyHeightSkipCart();
	
	jQuery(window).resize(function() {
		modifyHeightSkipCart();
	});

});



/* imagen home altura y newsletter*/
var ancho = jQuery(window).width();
function topNewLetter() {
		var newletter = jQuery('.magestore-bannerslider-standard').height();
		jQuery(".newsletter").animate({top:newletter},0);
		jQuery(".newsletter").animate({top:newletter},0);	
}
	jQuery( window ).resize(function() { 
			topNewLetter()
	}); 
	jQuery( ".category-image img" ).load(function() {
		 	topNewLetter()
	});
/* imagen home altura y newsletter*/





		jQuery( window ).resize(function() { 
			altura();
		}); 
		jQuery( ".category-image img" ).load(function() {
			altura();
		});
function altura(){
		var altoimagen = (jQuery('.category-image').height()) + 70;
		jQuery(".catalog-category-view .main").animate({marginTop:altoimagen},0);
	};
	// setInterval(altura,00001);
jQuery('.cms-home .page-header-container').addClass('menu-fixed');
instagram();
jQuery(window).load(function() {
	// height();
	footer();
});
jQuery(window).resize(function() {
	// height();
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
		if($j(window).width() > 468){
			if (jQuery(window).scrollTop() > 470) {
				jQuery('.cms-home .page-header-container').removeClass('menu-fixed-old');
				jQuery('.cms-home .page-header-container').addClass('menu-fixed');



			} else {
				//jQuery('.cms-home .page-header-container').removeClass('menu-fixed');
				//jQuery('.cms-home .page-header-container').addClass('menu-fixed-old');



				 			}
		} else {

			if (jQuery(window).scrollTop() > 270) {
			//jQuery('.cms-home .page-header-container').removeClass('menu-fixed');
			//jQuery('.cms-home .page-header-container').addClass('menu-fixed');
			} else {
			//jQuery('.cms-home .page-header-container').removeClass('menu-fixed');
			//jQuery('.cms-home .page-header-container').addClass('menu-fixed-old')		 		
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
		window.location.href="http://www.adrianaarango.com/store/default/stores";
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
		//var height2 = height + 150;
		var height2 = 0;
		// altura tomada jQuery(".alto-page").height(height2);
	} else {
		//  altura tomada jQuery(".alto-page").height(height);
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
	jQuery("#instansive_e6ac80e19f").height(jQuery("#instansive_e6ac80e19f").width() * 2);
}

function modifyHeightSkipCart() {
	
	// Evento para dar alto y scron a la vista de bolsa caundo supera el alto de la pantalla
	jQuery(".skip-cart").click(function() {
		
		if(jQuery(this).hasClass("skip-active")) {
			
			/*alert(jQuery("#header-cart").outerHeight());
			alert(jQuery(window).height());*/
			
			var height_div = jQuery("#header-cart").outerHeight() + jQuery(".page-header-container").outerHeight();
			var height_window = jQuery(window).height();
			var new_height_div = height_window;
			
			if(height_div > height_window) {
				
				jQuery("#header-cart").css({"height": new_height_div, "overflow-y": "auto", "overflow-x": "hidden", "padding-bottom": "110px"});
			}
		}
	});
}
