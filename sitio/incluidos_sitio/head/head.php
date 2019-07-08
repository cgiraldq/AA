<?
//REDIR  VISTA MOVIL
$useragent=$_SERVER['HTTP_USER_AGENT'];
if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
{
header('Location: /sitio/movil/');//modificado el 16/2/2016 por Luisa Fernanda Vásquez B.
}
//REDIR  VISTA MOVIL
$ruta=1; // ruta cambiada para las variables
  if($rutap==1)$ruta=4;
  include("incluidos_modulos/modulos.funciones.php");
  include("incluidos_modulos/version.php");
  include("incluidos_modulos/comunes.php");
  include("incluidos_modulos/varconexion.php");
  $sql="select dsrutaimagen,dsrutalocal,dsrutamiga,dsstat,dsrutaservidor,dsdominio";
    $sql.=" from tblempresa ";
    $result = $db->Execute($sql);
        if (!$result->EOF) {

    $dsrutaimagen=$result->fields[0];
    $dsrutalocal=$result->fields[1];
    $dsrutamiga=$result->fields[2];
    $codgoogle=$result->fields[3];
    $dsrutaservidor=$result->fields[4];
     $dsdominio=$result->fields[5];

    if($dsrutamiga==1){
        $rutalocalimag="$dsrutaimagen";
        $rutalocal="$dsrutalocal";
        $rutbase=$rutalocal;
        $rutaAmiga=$dsrutamiga;

    }

    if($dsrutamiga==2){
        $rutalocalimag="$dsrutaimagen";
        $rutalocal="$dsrutalocal";
        $rutbase=$rutalocal;
        $rutaAmiga=$dsrutamiga;
    }

}

$result->Close();
  //include("incluidos_modulos/sql.injection.php");

  include("incluidos_modulos/class.rc4crypt.php");
  include("incluidos_modulos/modulos.calendario.php");

  include("incluidos_modulos/modulos.registro.visitas.php");

  $rc4 = new rc4crypt();

  include("incluidos_modulos/posicionamiento.php");
  if ($dstitulox=="") $dstitulox=$dsmc." ".$title;
  $dstitulox.=" ".$title;

?>
<head>
    <!--[if lt IE 9]>
      <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
   <![endif]-->
    <title><? echo $dstitulox?></title>
    <meta charset="utf-8">
<? if ($idproducto<>""){
                $sql="select a.id,a.dsm,a.dsruta,a.dsimg2,a.dsd,a.dskw";
                $sql.=" from tblproductos a where a.id=$idproducto ";
                //echo $sql;
                  $result=$db->Execute($sql);
                  if(!$result->EOF){
                      $id=reemplazar($result->fields[0]);
                      $dsm=trim(reemplazar($result->fields[1]));
                      $dsimg2=$result->fields[3];
                      $dsdescr=trim(reemplazar($result->fields[4]));
                       if ($result->fields[4]<>"") $dsdescr=trim(reemplazar($result->fields[4]));
                      if ($result->fields[5]<>"") $dsclaves=trim(reemplazar($result->fields[5]));
    ?>
    <meta property="og:type" content="website" />
<?
    }
    $result->close();
} else { ?>
    <meta property="og:type" content="website" />

<? } ?>
    <meta property="og:title" content="<? echo $dstitulox?>">
    <meta property="og:site_name" content="<?echo $autorizado?>">
    <meta property="og:image" content="<?echo $rutaimagen_sindicacion?>">
    <meta property="og:description" content="<? echo $text_sindicacion?>">

    <meta name="description" content="<? echo $dsdescr?>" />
    <meta name="keywords" content="<? echo $dsclaves?>"/>

    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,400,600' rel='stylesheet' type='text/css'>
    <link rel="shortcut icon" type="image/x-icon" href="<? echo $rutalocal;?>/favicon.ico">

    <link rel="stylesheet" href="<? echo $rutalocal;?>/css/style.css" type="text/css" media="all" rel="stylesheet" >
    <link rel="stylesheet" href="<? echo $rutalocal;?>/css/style.ecommerce.css" type="text/css" media="all" rel="stylesheet">
    <link rel="stylesheet" href="<? echo $rutalocal;?>/css/style.distribuidor.css" type="text/css" media="all" rel="stylesheet">
    <link rel="stylesheet" href="<? echo $rutalocal;?>/css/mapa.sitio.css" type="text/css" media="all" rel="stylesheet" >
    <link rel="stylesheet" href="<? echo $rutalocal;?>/css/paginador.css" type="text/css" media="all" rel="stylesheet" >
    <link rel="stylesheet" href="<? echo $rutalocal;?>/css/style.blog.css" type="text/css" media="all" rel="stylesheet">
    <link rel="stylesheet" href="<? echo $rutalocal;?>/css/style_formulario.css" type="text/css" media="all" rel="stylesheet" >
    <script type="text/javascript" src="<?echo $rutalocal;?>/js_modulos/javageneral.js"></script>
    <script language="JavaScript" src="<?echo $rutalocal;?>/js_modulos/ajax.js" type="text/javascript" ></script>
    <script src="<?echo $rutalocal;?>/js_sitio/jquery-1.9.1.min.js"></script>
     <!--script src="<?echo $rutalocal;?>/js_modulos/jquery-1.10.1.min.js"></script-->
    <script type="text/javascript" src="<?echo $rutalocal;?>/js_sitio/tinydropdown.js"></script>
    <script src="<?echo $rutalocal;?>/js_sitio/placeholders.min.js" type="text/javascript"></script>

    <!--[if lt IE 9]>
      <link rel="stylesheet" href="css/styleie7.css" type="text/css" media="all" rel="stylesheet" >
   <![endif]-->


 <? if($pagina=="oficinas.php"){
    $keyx="ABQIAAAAiNWcqsemoxXLCROQfpBXtBQotj2yEh74_e58tSDEmckQMnz-gRRplkKfP3bRNL39aFrfJX_Kx5HoLw";
    ?>
 <script src="http://maps.google.com/maps?file=api&amp;v=3&amp;key=<? echo $keyx;?>"type="text/javascript"></script>


<script type="text/javascript">

<!--
function FP_preloadImgs() {//v1.0
 var d=document,a=arguments; if(!d.FP_imgs) d.FP_imgs=new Array();
 for(var i=0; i<a.length; i++) { d.FP_imgs[i]=new Image; d.FP_imgs[i].src=a[i]; }
}

function FP_swapImg() {//v1.0
 var doc=document,args=arguments,elm,n; doc.$imgSwaps=new Array(); for(n=2; n<args.length;
 n+=2) { elm=FP_getObjectByID(args[n]); if(elm) { doc.$imgSwaps[doc.$imgSwaps.length]=elm;
 elm.$src=elm.src; elm.src=args[n+1]; } }
}

function FP_getObjectByID(id,o) {//v1.0
 var c,el,els,f,m,n; if(!o)o=document; if(o.getElementById) el=o.getElementById(id);
 else if(o.layers) c=o.layers; else if(o.all) el=o.all[id]; if(el) return el;
 if(o.id==id || o.name==id) return o; if(o.childNodes) c=o.childNodes; if(c)
 for(n=0; n<c.length; n++) { el=FP_getObjectByID(id,c[n]); if(el) return el; }
 f=o.forms; if(f) for(n=0; n<f.length; n++) { els=f[n].elements;
 for(m=0; m<els.length; m++){ el=FP_getObjectByID(id,els[n]); if(el) return el; } }
 return null;
}

function FP_swapImgRestore() {//v1.0
 var doc=document,i; if(doc.$imgSwaps) { for(i=0;i<doc.$imgSwaps.length;i++) {
  var elm=doc.$imgSwaps[i]; if(elm) { elm.src=elm.$src; elm.$src=null; } }
  doc.$imgSwaps=null; }
}
 <? if($pagina<>"index.php" && $pagina<>"index2.php" && $pagina<>"oficinas.php"){?>
$(document).ready(function(){
                $("area[rel^='prettyPhoto']").prettyPhoto();

                $(".gallery:first a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'normal',theme:'light_square',slideshow:3000, autoplay_slideshow: false});
                $(".gallery:gt(0) a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'fast',slideshow:10000, hideflash: true});

                $("#custom_content a[rel^='prettyPhoto']:first").prettyPhoto({
                    custom_markup: '<div id="map_canvas" style="width:260px; height:265px"></div>',
                    changepicturecallback: function(){ initialize(); }
                });

                $("#custom_content a[rel^='prettyPhoto']:last").prettyPhoto({
                    custom_markup: '<div id="bsap_1259344" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6"></div><div id="bsap_1237859" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6" style="height:260px"></div><div id="bsap_1251710" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6"></div>',
                    changepicturecallback: function(){ _bsap.exec(); }
                });
            });
<? }?>
$(function() {
        $('ul#destacado').carouFredSel({
            auto: false,
            prev: "#prev",
            next: "#next",
            items       : {
                visible     : 3 ,
                start       : 0
            },
            direction:"up"
        });
        $('ul#destacadoindex').carouFredSel({
            auto: true,
            prev: "#previ",
            next: "#nexti",
            items       : {
                visible     : 1 ,
                start       : 0
            },
            scroll      : {
                duration        : 1000
            }
        });
        $('ul#destacadonotas').carouFredSel({
            auto: false,
            prev: "#prevn",
            next: "#nextn",
            items       : {
                visible     : 1 ,
                start       : 0
            }
        });
        $('ul#destacadogaleria').carouFredSel({
            auto: false,
            prev: "#prevg",
            next: "#nextg",
            items       : {
                visible     : 2 ,
                start       : 0
            }
        });
        $('ul#galeria').carouFredSel({
            auto: false,
            prev: "#prevx",
            next: "#nextx",
            items       : {
                visible     : 5 ,
                start       : 0
            },
            scroll:1
        });

    });

function mostrarcapa(capa,id,cant){
    var dis;
    //alert(cant);
    for(var i=1;i<=cant;i++){
        if(id==i)dis="";
        else dis="none";
        if(document.getElementById(capa+i))document.getElementById(capa+i).style.display=dis;
    }
}

function ocultarcapa(capa,id,cant,link,idlink){
    var dis;
    location.href="#"+"inicio";
    //alert("entra");
    for(var i=1;i<=cant;i++){
        if(id==i)dis="none";
        else dis="none";
        if(document.getElementById(capa+i)){
            document.getElementById(capa+i).style.display=dis;
            document.getElementById("cerrar"+i).style.display="none";
             document.getElementById(link+idlink).style.display="";
        }
    }
}


function ocutarlink(capa,id,cant,link){
    location.href="#"+link;
    var dis;
    for(var i=1;i<=cant;i++){
        if(id==i)dis="none";
        else dis="";
        if(document.getElementById(capa+i)){
            document.getElementById(capa+i).style.display=dis;
            document.getElementById("cerrar"+id).style.display="";
        }
    }
}

function ocultarrecomendar(){
        document.getElementById('contenedormenor').style.display="none";
        document.getElementById('contenedormayor').style.display="none";
        //window.scroll;
}

function mostrarrecomendar(){
        document.getElementById('contenedormayor').style.display="";
        document.getElementById('contenedormenor').style.display="";
}
function ocultarmapa(){
        document.getElementById('contenedormenor2').style.display="none";
        document.getElementById('contenedormayor2').style.display="none";
        //window.scroll;
}

function mostrarmapa(id){

        document.getElementById('contenedormayor2').style.display="";
        document.getElementById('contenedormenor2').style.display="";

        ubicar(id);

}
function popup(ruta){
    window.open(ruta,'','scrollbars=no,width=600,height=600,left=50,top=2');
}


function ubicar(id){

    //contenedor=document.getElementById('capa_resultados');
    var datos=document.getElementById('capa_datos'+id).innerHTML;

    //return;
    partir=datos.split("|");
    if (datos!="") {
        lat=eval(partir[0]);
        lon=eval(partir[1]);
        zoom=eval(partir[2]);
        dsm=partir[3];
        dsd=partir[4];
        dsdireccion=partir[5];
        dstelefono=partir[6];
        //alert(zoom);
    }
    document.getElementById('nombresede').innerHTML=dsm;
        var baseIcon = new GIcon();
        baseIcon.iconSize = new GSize(30, 25);
        baseIcon.shadowSize = new GSize(37, 34);
        baseIcon.iconAnchor = new GPoint(9, 34);
        baseIcon.infoWindowAnchor = new GPoint(18, 25);
        baseIcon.infoShadowAnchor = new GPoint(18, 25);

    if (datos!=""){  // ubicar en mapa
        // partir cadena

        if (GBrowserIsCompatible()) {
            var map = new GMap2(document.getElementById("capa_mapa"));
            //map.setMapType(G_HYBRID_MAP);
            var geoXml= new GGeoXml("" );
            map.setCenter(new GLatLng(lat,lon), zoom);
            map.addControl(new GMapTypeControl());
            map.addControl(new GLargeMapControl());
            map.addControl(new GScaleControl());
            map.addControl(new GOverviewMapControl());

            //map.enableContinuousZoom();
            //map.enableDoubleClickZoom();

            map.addOverlay(geoXml);

            var center = map.getCenter();
            map.setCenter(center, zoom);


             map.clearOverlays();

            var point=new GLatLng(lat,lon);
            // icono
            var letteredIcon = new GIcon(baseIcon);
            letteredIcon.image = "<? echo $rutalocal?>/images/lugar.png";
            markerOptions = {icon:letteredIcon};


            var marker = new GMarker(point,markerOptions);
            map.addOverlay(marker);

            // cargar los mensajes
            html='<div style="text-align:left;width:300px"><b>'+dsm+'</b><br>';
            html=html+'<b>Horario: </b>'+dsd+'<br>';
            html=html+'<b>Direcci&oacute;n: </b>'+dstelefono+'<br>';
            html=html+'<b>Tel&eacute;fono: </b>'+dsdireccion+'<br>';
            html=html+'</div>';
            marker.openInfoWindowHtml(html);
        }
    }

}


function cambiarimagen(capa1,capa2){
    document.getElementById(capa2).innerHTML=document.getElementById(capa1).innerHTML;
    /*alert(img);
    if(document.getElementById(capa)){
        document.getElementById(capa).innerHTML=rutaa+"<img src='"+img+"'/>"+rutab;
    }*/
}
// -->
</script>
<? }?>

<script type="text/javascript">
     function encuestavotar(){
        var idencuesta=document.encuesta.idencuesta.value;
        //var idrespuesta=document.encuesta.idrespuesta.value;
        var idrespuesta;
        var cantidad=document.encuesta.elements['idrespuesta'].length;
        for(var i=0;i<cantidad;i++){
            if(document.encuesta.elements['idrespuesta'][i].checked){
                idrespuesta=document.encuesta.elements['idrespuesta'][i].value;
                //votar=1;
                break;
            }
        }
        //alert(idrespuesta);
        conexion=AjaxObj();
        var ruta="<? echo $rut?>modulos/validaciones/encuesta.php?idencuesta="+idencuesta+"&idrespuesta="+idrespuesta;
        //alert(ruta);
         conexion.open("POST",ruta);
         conexion.onreadystatechange =function() {
         if (conexion.readyState==4) {
         var resultado = conexion.responseText;
            if (resultado!="") {
                if(resultado==1)document.getElementById('mensaje').innerHTML="Su voto ha sido registrado";
                if(resultado==0)document.getElementById('mensaje').innerHTML="Su voto ya fue registrado";
            }
        } // fin funcion
    } // fin conexion
    //contenedor.innerHTML ="";
    conexion.send(null) // limpia conexion
    //document.calificar.calificacion.value=num;
    //document.calificar.submit();
}
</script>


      <!--  FIN CARRUSEL TIENDAS  -->

    <script type="text/javascript" src="<?echo $rutalocal;?>/js_sitio/jquery.mCustomScrollbar.concat.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?echo $rutalocal;?>/css/jquery.mCustomScrollbar.css" />
    <link rel="stylesheet" type="text/css" href="<?echo $rutalocal;?>/css/style.qsomos.css" />

    <script>
        (function($){
            $(window).load(function(){

                /*
                get snap amount programmatically or just set it directly (e.g. "273")
                in this example, the snap amount is list item's (li) outer-width (width+margins)
                */
                var amount=Math.max.apply(Math,$("#content-1 li").map(function(){return $(this).outerWidth(true);}).get());

                $("#content-1").mCustomScrollbar({
                    axis:"x",
                    theme:"inset",
                    advanced:{
                        autoExpandHorizontalScroll:true
                    },
                    scrollButtons:{
                        enable:true,
                        scrollType:"stepped"
                    },
                    keyboard:{scrollType:"stepped"},
                    snapAmount:amount,
                    mouseWheel:{scrollAmount:amount}
                });

            });
        })(jQuery);
    </script>


    <!--  CARRUSEL QUIENES SOMOS  -->

    <!-- CARRUSEL TIENDAS -->

       <link rel="stylesheet" type="text/css" href="<?echo $rutalocal;?>/css/gallery.prefixed.css" />

    <!--  FIN CARRUSEL QUIENES SOMOS    -->

    <!--  LIGHTBOX -->

        <link rel="stylesheet" type="text/css" href="<?echo $rutalocal;?>/css/jquery.lightbox.css" />
        <script type="text/javascript" src="<?echo $rutalocal;?>/js_sitio/jquery.lightbox.js"></script>

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

    <!--  LIGHTBOX FIN -->

    <!-- LIGHTBOX  -->

        <link rel="stylesheet" href="<?echo $rutalocal;?>/css/colorbox.css" />
        <script src="<?echo $rutalocal;?>/js_sitio/jquery.colorbox.js"></script>
        <script>
            $(document).ready(function(){
                $(".galeria_detalle").colorbox({rel:'galeria_detalle'});
                $(".terminos_condiciones").colorbox({iframe:true, width:"60%", height:"80%"});
                //$(".ver_mapa").colorbox({iframe:true, width:"40%", height:"70%"});

                //Example of preserving a JavaScript event for inline calls.
                $("#click").click(function(){
                    $('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
                    return false;
                });
            });
        </script>

    <!-- LIGHTBOX  -->

  <!-- CAPAS -->

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

    <!-- FIN CAPAS -->


	<!-- Galeria Index -->
        <link rel="stylesheet" href="<? echo $rutalocal;?>/css/skitter.styles.css" type="text/css" media="all" rel="stylesheet" >
        <script src="<?echo $rutalocal;?>/js_sitio/jquery.easing.1.3.js"></script>
        <script src="<?echo $rutalocal;?>/js_sitio/jquery.animate-colors-min.js"></script>
        <script src="<?echo $rutalocal;?>/js_sitio/jquery.skitter.min.js"></script>
        <script>
		$(document).ready(function(){
			$('.box_skitter_small').css({width: 691, height: 270}).skitter({label: false, numbers: false, animation: 'blind', hideTools: true, navigation: true, dots: false});
            $('.box_skitter_large').css({width: 1600, height: 300}).skitter({label: false, numbers: false, animation: 'blind', hideTools: true, navigation: true, dots: false});
		    $('.box_skitter_lateral').css({width: 285, height: 207}).skitter({label: false, numbers: false, animation: 'blind', hideTools: true, navigation: true, dots: false});
        });
		</script>
	<!-- Galeria Index -->


    <?
      $sql="select a.id,a.dsm,a.dsruta,a.dsimg from tblcarrousel a where a.idactivo=1";
      //echo $sql;
      $result=$db->Execute($sql);
      $totalgaleria=0;
      if(!$result->EOF){
        while(!$result->EOF){
                $totalgaleria++;
          $result->MoveNext();

           } // fin while
      }
      $result->Close();
    ?>

    <? if ($totalgaleria>1){?>
        <!-- Galeria slider automatico -->
            <link rel="stylesheet" href="<?echo $rutalocal;?>/css/example.css">
            <script src="<?echo $rutalocal;?>/js_sitio/jquery.slides.min.js"></script>

              <script>
                $(function() {
                  $('#slides').slidesjs({
                    width: 285,
                    height: 200,
                    play: {
                      active: true,
                      auto: true,
                      interval: 4000,
                      swap: true
                    }
                  });
                });
              </script>
        <!-- Galeria slider automatico -->
    <? } ?>

    <!-- Carrusel con scroll -->

        <script type="text/javascript" language="javascript" src="<?echo $rutalocal;?>/js_sitio/jquery.carouFredSel-6.2.0-packed.js"></script>
        <script type="text/javascript" language="javascript" src="<?echo $rutalocal;?>/js_sitio/jquery.mousewheel.min.js"></script>
        <script type="text/javascript" language="javascript" src="<?echo $rutalocal;?>/js_sitio/jquery.touchSwipe.min.js"></script>
        <script type="text/javascript">

            $(document).ready(function(){

                $('#carrusel_imagenes').carouFredSel({
                   // width: "650px",
                    height:"200px",
                    auto:{
                        play:false,
                        pauseOnHover:true,
                        duration:9000,
                        timeoutDuration:90000
                    },
                    items: {
                            visible: {
                                min: 4,
                                max: 6
                            }
                        },
                    prev: '#prev_carrusel_imagenes',
                    next: '#next_carrusel_imagenes',
                    direction: "left",
                    mousewheel: true
                });

                $('#pro_mas_vendidos').carouFredSel
                            ({
                    height:"variable",
                    auto:{
                        play:true,
                        pauseOnHover:true,
                        duration:1000,
                        timeoutDuration:10000
                    },
                    prev: '#prev_pro_mas_vendidos',
                    next: '#next_pro_mas_vendidos',
                    direction: "up",
                    items: {
                                visible: 4,
                                height:"variable"
                            },
                    mousewheel: true
                });

                $('#cont_galeria_producto').carouFredSel({
                   // width: "650px",
                    height:"98px",
                    auto:{
                        play:false,
                        pauseOnHover:true,
                        duration:9000,
                        timeoutDuration:90000
                    },
                    items: {
                            visible: {
                                min: 2,
                                max: 6
                            }
                        },
                    prev: '#prev_cont_galeria_producto',
                    next: '#next_cont_galeria_producto',
                    direction: "left",
                    mousewheel: true
                });

                $('#carrusel_otros_productos').carouFredSel({
                    width: "650px",
                    height:"variable",
                    auto:{
                        play:false,
                        pauseOnHover:true,
                        duration:9000,
                        timeoutDuration:90000
                    },
                    items: {
                            visible: {
                                min: 4,
                                max: 6
                            }
                        },
                    prev: '#prev_carrusel_otros_productos',
                    next: '#next_carrusel_otros_productos',
                    direction: "left",
                    mousewheel: true
                });

                   var $carousel = $('#carrusel_producto_ligh'),
                    $pager = $('#pager_producto_ligh');

                function getCenterThumb() {
                    var $visible = $pager.triggerHandler( 'currentVisible' ),
                        center = Math.floor($visible.length / 2);

                    return center;
                }

                $carousel.carouFredSel({
                    responsive: true,
                    items: {
                        visible: 1,
                        width: 500,
                        height: (500/500*100) + '%'
                    },
                    scroll: {
                        fx: 'crossfade',
                        onBefore: function( data ) {
                            var src = data.items.visible.first().attr( 'src' );
                            src = src.split( '/large/' ).join( '/small/' );

                            $pager.trigger( 'slideTo', [ 'img[src="'+ src +'"]', -getCenterThumb() ] );
                            $pager.find( 'img' ).removeClass( 'selected' );
                        },
                        onAfter: function() {
                            $pager.find( 'img' ).eq( getCenterThumb() ).addClass( 'selected' );
                        }
                    }
                });
                $pager.carouFredSel({
                    width: '100%',
                    auto: false,
                    height: 120,
                    items: {
                        visible: 'odd'
                    },
                    onCreate: function() {
                        var center = getCenterThumb();
                        $pager.trigger( 'slideTo', [ -center, { duration: 0 } ] );
                        $pager.find( 'img' ).eq( center ).addClass( 'selected' );
                    }
                });
                $pager.find( 'img' ).click(function() {
                    var src = $(this).attr( 'src' );
                    src = src.split( '/small/' ).join( '/large/' );
                    $carousel.trigger( 'slideTo', [ 'img[src="'+ src +'"]' ] );
                });
        });
        </script>

    <!-- Carrusel con scroll -->

    <!-- GALERIA DE PRODUCTOS-->
        <link rel="stylesheet" href="<? echo $rutalocal;?>/css/smoothproducts.css">
        <!--script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.js"></script-->
        <script type="text/javascript" src="<?echo $rutalocal;?>/js_sitio/smoothproducts.min.js"></script>
        <script type="text/javascript">
                /* wait for images to load */
                $(window).load( function() {
                    $('.sp-wrap').smoothproducts();
                });
        </script>
    <!-- GALERIA DE PRODUCTOS-- >

    <!-- Acordion -->

    <script type="text/javascript">
        $(document).ready(function() {
            $('.titu_pregunta').click(function() {
                $('.titu_pregunta').removeClass('on');
                $('.txt_pregunta').slideUp('normal');
                if($(this).next().is(':hidden') == true) {
                    $(this).addClass('on');
                    $(this).next().slideDown('normal');
                 }
             });
            $('.titu_pregunta').mouseover(function() {
                $(this).addClass('over');
            }).mouseout(function() {
                $(this).removeClass('over');
            });
            $('.txt_pregunta').hide();
        });
    </script>

    <!--  Fin Acordion -->

    <!--Poo up-->

        <script language="JavaScript">
            function Abrir_ventana (pagina) {
            var opciones="toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no,          resizable=yes, width=750, height=700, top=100, left=200";

            window.open(pagina,"",opciones);
            }
        </script>

    <!--Poo up-->

    <!--   MENU DESPLEGABLE   -->

        <!--link rel="stylesheet" type="text/css" href="<?//echo $rutalocal;?>/css/style.menu.desplegable.css" /-->
        <!--script type="text/javascript" src="<?//echo $rutalocal;?>/js_sitio/menu.jquery.js"></script-->

    <!-- FIN MENU DESPLEGABLE   -->

<!--[if lt IE 9]>
<script type="text/javascript">
   document.createElement("nav");
   document.createElement("header");
   document.createElement("footer");
   document.createElement("section");
   document.createElement("article");
   document.createElement("aside");
   document.createElement("hgroup");
</script>
<![endif]-->


</head>