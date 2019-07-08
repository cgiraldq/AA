<?

$ruta=3; // ruta cambiada para las variables
$rutaInclude="..";
  if($rutap==1)$ruta=4;
  include("incluidos_modulos/modulos.funciones.php");
  include("incluidos_modulos/comunes.php");

  include("../incluidos_modulos/varconexion.php");
  include("incluidos_modulos/posicionamiento.php");
  ?>
<head>
    <!--[if lt IE 9]>
      <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
   <![endif]-->
    <title><? echo $dstitulox;?></title>
    <meta charset="utf-8">

    <? if ($idproducto<>""){
                $sql="select a.id,a.dsm,a.dsruta,a.dsimg2,a.dsd";
                $sql.=" from tblproductos a where a.id=$idproducto ";
                //echo $sql;
                  $result=$db->Execute($sql);
                  if(!$result->EOF){
                      $id=reemplazar($result->fields[0]);
                      $dsm=trim(reemplazar($result->fields[1]));
                      $dsimg2=$result->fields[3];
                      $dsdescr=trim(reemplazar($result->fields[4]));
    ?>

    <meta property="og:title" content="<? echo $dsm?>">
    <meta property="og:site_name" content="<?echo $autorizado?>">
    <meta property="og:image" content="<?echo "http://".$autorizado.$rutaImagen.$dsimg2?>">
    <meta property="og:description" content="<? echo $dsdescr?>">
    <meta property="og:type" content="product" />

    <?    }    $result->close();} ?>

    <meta name="description" content="<? echo $dsdescr?>" />
    <meta name="keywords" content="<? echo $dsclaves?>"/>


    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
    <link rel="stylesheet" href="css/style.css" type="text/css" media="all" rel="stylesheet" >
    <link rel="stylesheet" href="css/style.ecommerce.css" type="text/css" media="all" rel="stylesheet" >
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,400,600' rel='stylesheet' type='text/css'>
    <script type="text/javascript" src="js_modulos/javageneral.js"></script>
    <script language="JavaScript" src="js_modulos/ajax.js" type="text/javascript" ></script>

    <!--Menu responsive-->

    <link rel="stylesheet" href="css/stylemenu.css" type="text/css"/>
    <script type="text/javascript" src="js_modulos/jquery.min.js"></script>
    <script type="text/javascript" src="js_modulos/responsivemobilemenu.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>

    <!--Fin menu responsive-->

    <!-- GALERIA SLIDER-->
      <link rel="stylesheet" href="css/slider.css">
      <link rel="stylesheet" href="css/example.css">
      <script src="js_modulos/jquery-1.9.1.min.js"></script>
      <script src="js_modulos/jquery.slides.min.js"></script>

      <script>
        $(function() {
          $('#slides').slidesjs({
            width: 940,
            height: 1300,
            navigation: false
          });
        });
      </script>

      <script>
        $(function() {
          $('#galeria_ecommerce_detalle').slidesjs({
            width: 940,
            height: 790,
            navigation: false
          });
        });
      </script>

    <!-- GALERIA SLIDER-->

    <!-- LIGHTBOX  -->
        <link rel="stylesheet" href="css/colorbox.css" />
        <script src="js_modulos/jquery.colorbox.js"></script>
        <script>
            $(document).ready(function(){
                $(".ver_info").colorbox({iframe:true, width:"95%", height:"95%"});
                //Example of preserving a JavaScript event for inline calls.
                $("#click").click(function(){
                    $('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
                    return false;
                });
            });
        </script>
    <!-- LIGHTBOX  -->
            <script type="text/javascript" language="javascript" src="js_sitio/jquery.carouFredSel-6.2.0-packed.js"></script>
        <script type="text/javascript" language="javascript" src="js_sitio/jquery.mousewheel.min.js"></script>
        <script type="text/javascript" language="javascript" src="js_sitio/jquery.touchSwipe.min.js"></script>
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

                 });
        </script>

<!--
====================================
COMENTARIOS DE FACEBOOK NO TOCAR
====================================
 -->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.3";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>
<!--
====================================
FIN COMENTARIOS DE FACEBOOK NO TOCAR
====================================
 -->
</head>