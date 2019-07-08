<head>

	<title><? echo $AppNombre;?></title>


    <!--meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8"-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="description" content="Pushy is an off-canvas navigation menu for your website.">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,400,600' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?echo $rutxx?>../../css_modulos/normalize.consola.css">
    <link rel="stylesheet" href="<?echo $rutxx?>../../css_modulos/style.consola.css">
    <link rel="stylesheet" href="<? echo $rutxx;?>../../css_modulos/core.graficas.css">
    <link rel="stylesheet" href="<? echo $rutxx;?>../../css_modulos/galeria.detalle.css">
    <link rel="stylesheet" type="text/css" href="<? echo $rutxx;?>../../css_modulos/estilos.admon.css">
    <link rel="stylesheet" type="text/css" href="<? echo $rutxx;?>../../css_modulos/estilos.modulos.css">
    <!--link rel="stylesheet" type="text/css" href="<? echo $rutxx;?>../../css_modulos/estilo.servicios.css"-->
    <script language="JavaScript" src="<? echo $rutxx;?>../../js_modulos/javageneral.js" type="text/javascript" ></script>
    <script language="JavaScript" src="<? echo $rutxx;?>../../js_modulos/ajax.js" type="text/javascript"></script>

    <!-- SUICHE ON/OFF-->
    <link href="<? echo $rutxx;?>../../css_modulos/switch.css" type="text/css" rel="stylesheet">
    <!-- SUICHE ON/OFF-->

    <!-- MENÚ LATERAL -->

    <link type="text/css" rel="stylesheet" href="<? echo $rutxx;?>../../incluidos_modulos/menu/css/demo.css" />
    <link type="text/css" rel="stylesheet" href="<? echo $rutxx;?>../../incluidos_modulos/menu/css/jquery.mmenu.css" />
    <script type="text/javascript" src="<? echo $rutxx;?>../../incluidos_modulos/menu/js/jquery.min.js"></script>
    <script type="text/javascript" src="<? echo $rutxx;?>../../incluidos_modulos/menu/js/jquery.mmenu.min.js"></script>

    <!-- MENÚ LATERAL -->

    <!-- LIGHTBOX -->

    <link rel="stylesheet" type="text/css" href="<? echo $rutxx;?>../../css_modulos/jquery.lightbox.css" />
    <script type="text/javascript" src="<? echo $rutxx;?>../../js_modulos/jquery.lightbox.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){

        $('.lightbox').lightbox();

        $("a.customlightbox").lightbox({
          buttons: [
            {
              'class'     : 'jquery-lightbox-button-openurl',
              'html'      : '<span>open in new window</span>',
              'callback'  : function(url, object) {
                window.location.href = url;
              }
            }
          ]
        });

      });

    </script>

    <!--  FIN LIGHTBOX -->

    <!-- Acordion -->

    <script type="text/javascript">
        $(document).ready(function() {
            $('.titu_modulos').click(function() {
                $('.titu_modulos').removeClass('on');
                $('.list_modulos').slideUp('normal');
                if($(this).next().is(':hidden') == true) {
                    $(this).addClass('on');
                    $(this).next().slideDown('normal');
                 }
             });
            $('.titu_modulos').mouseover(function() {
                $(this).addClass('over');
            }).mouseout(function() {
                $(this).removeClass('over');
            });
            $('.list_modulos').hide();
        });
    </script>

    <!-- Fin Acordion -->

    <!--POP UP CERRAR SESIÓN-->

         <script type="text/javascript">

            $(document).ready( function() {

             $('.add').click(function(e){
               e.stopPropagation();
              if ($(this).hasClass('active')){
                $('.dialog').fadeOut(0);
                $(this).removeClass('active');
              } else {
                $('.dialog').delay(0).fadeIn(0);
                $(this).addClass('active');
              }
            });
            $('.radio > .button').click( function() {
              $('.radio').find('.button.active').removeClass('active');
              $(this).addClass('active');
            });

            function closeMenu(){
              $('.dialog').fadeOut(0);
              $('.add').removeClass('active');
            }

            $(document.body).click( function(e) {
                 closeMenu();
            });

            $(".dialog").click( function(e) {
                e.stopPropagation();
            });
        });

        </script>

    <!--POP UP CERRAR SESIÓN-->

    <!-- CARRUSEL-->

          <script type="text/javascript">
              $(document).ready(function() {
                    //move he last list item before the first item. The purpose of this is if the user clicks to slide left he will be able to see the last item.
                    $('#carousel_ul li:first').before($('#carousel_ul li:last'));


                    //when user clicks the image for sliding right
                    $('#right_scroll img').click(function(){

                        //get the width of the items ( i like making the jquery part dynamic, so if you change the width in the css you won't have o change it here too ) '
                        var item_width = $('#carousel_ul li').outerWidth() + 10;

                        //calculae the new left indent of the unordered list
                        var left_indent = parseInt($('#carousel_ul').css('left')) - item_width;

                        //make the sliding effect using jquery's anumate function '
                        $('#carousel_ul:not(:animated)').animate({'left' : left_indent},500,function(){

                            //get the first list item and put it after the last list item (that's how the infinite effects is made) '
                            $('#carousel_ul li:last').after($('#carousel_ul li:first'));

                            //and get the left indent to the default -210px
                            $('#carousel_ul').css({'left' : '-210px'});
                        });
                    });

                    //when user clicks the image for sliding left
                    $('#left_scroll img').click(function(){

                        var item_width = $('#carousel_ul li').outerWidth() + 10;

                        /* same as for sliding right except that it's current left indent + the item width (for the sliding right it's - item_width) */
                        var left_indent = parseInt($('#carousel_ul').css('left')) + item_width;

                        $('#carousel_ul:not(:animated)').animate({'left' : left_indent},500,function(){

                        /* when sliding to left we are moving the last item before the first list item */
                        $('#carousel_ul li:first').before($('#carousel_ul li:last'));

                        /* and again, when we make that change we are setting the left indent of our unordered list to the default -210px */
                        $('#carousel_ul').css({'left' : '-210px'});
                        });


                    });
              });
            </script>

        <!-- FIN CARRUSEL-->

         <!-- JS PARA EL MENU LATERAL DESPEGABLE -->

            <script type='text/javascript'>

                $(document).ready(function()
                {
                $("#firstpane p.menu_head").click(function()
                {
                    $(this).next("div.menu_body").slideToggle(300).siblings("div.menu_body").slideUp("slow");
                    $(this).siblings();
                });


                $("#secondpane p.menu_head").mouseover(function()
                {
                    $(this).next("div.menu_body").slideDown(500).siblings("div.menu_body").slideUp("slow");
                    $(this).siblings();
                    });
                });


            </script>
            <!-- JS PARA EL MENU LATERAL DESPEGABLE -->
        <script src="http://www.comprandofacil.com/pide/corehome/js_modulos/corehome.js"></script>
        <?include($rutxx."../tiny/tinymce.php");?>
        <? if ($pagina=="producto.editar.php") {_?>
        <script type="text/javascript">

                $(document).ready(function(){
                $('#tabs div').hide();
                $('#tabs div:first').show();
                $('#tabs ul li a:first').addClass('active');
                $('#tabs ul li a').click(function(){
                $('#tabs ul li a').removeClass('active');
                $(this).addClass('active');
                var currentTab = $(this).attr('href');
                $('#tabs .tabs_content').hide();
                $(currentTab).show();
                return false;
                });
                });
        </script>
        <script type="text/javascript">
              $(document).ready(function(){ // Script del men&uacute; con pesta&ntilde;as
               $('ul.tabs').each(function(){
                    // For each set of tabs, we want to keep track of
                    // which tab is active and it's associated content
                    var $active, $content, $links = $(this).find('a');

                    // If the location.hash matches one of the links, use that as the active tab.
                    // If no match is found, use the first link as the initial active tab.
                    $active = $($links.filter('[href="'+location.hash+'"]')[0] || $links[0]);
                    $active.addClass('active');
                    $content = $($active.attr('href'));

                    // Hide the remaining content
                    $links.not($active).each(function () {
                        $($(this).attr('href')).hide();
                    });

                    // Bind the click event handler
                    $(this).on('click', 'a', function(e){
                        $active.removeClass('active');
                        $content.hide();

                        $active = $(this);
                        $content = $($(this).attr('href'));

                        $active.addClass('active');
                        $content.show();

                        e.preventDefault();
                    });
                });


            });

        function abrir_forma(capa1,capa2) {
            document.getElementById(capa1).style.display="";
            document.getElementById(capa2).style.display="none";
        }

        </script>
    <? } ?>
</head>