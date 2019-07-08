<?
/*
| ----------------------------------------------------------------- |
CF-informer
Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c) 2000 - 2009
Medellin - Colombia
=====================================================================
  Autores:
  Juan Fernando Fernández <consultorweb@comprandofacil.com> - Proyectos
  Juan Felipe Sánchez <graficoweb@comprandofacil.com> - Diseño
  José Fernando Peña <soporteweb@comprandofacil.com> - Mercadeo
=====================================================================
| ----------------------------------------------------------------- |
*/
// principal
$rutx=1;
if($rutx==1) $rutxx="../";
include($rutxx."../../incluidos_modulos/modulos.globales.php");
//include($rutxx."../../incluidos_modulos/bloqueo.ip.php");
$rc4 = new rc4crypt();
$titulomodulo="Configuracion de ubicacion";
$tabla="tblpuntos";
$idc=$_REQUEST['idc'];

if($_REQUEST['paso']==1){
	$dslongitud=$_REQUEST['dslongitud'];
	$dslatitud=$_REQUEST['dslatitud'];
	$dszoom=$_REQUEST['dszoom'];

	$sql="update $tabla set dslongitud='$dslongitud',dslatitud='$dslatitud',dszoom='$dszoom' where id=$idc ";

	if($db->Execute($sql))$mensajes=$men[4];
}
?>
<html>
<?include($rutxx."../../incluidos_modulos/head.php");?>

<? include($rutxx."../../incluidos_modulos/navegador.principal.php");?>
 <script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=<? echo $keyx;?>" type="text/javascript"></script>
<?
	$sql=" select dslongitud,dslatitud,dszoom,dsm from $tabla where id=$idc ";
	//echo $sql;
	$result=$db->Execute($sql);
	if(!$result->EOF){
		$dslongitud=$result->fields[0];
		$dslatitud=$result->fields[1];
		$dszoom=$result->fields[2];
		$dsm=$result->fields[3];
	}
	/*if($dslongitud=="" || $dslatitud=="" || $dszoom==""){
		$dslongitud="-75.377197265625";
		$dslatitud="6.153014018651188";
		$dszoom="10";
	}*/
?>
 <script type="text/javascript">

function iniciar() {
      if (GBrowserIsCompatible()) {

        var map = new GMap2(document.getElementById("capa_mapa"));
	    map.setMapType(G_HYBRID_MAP);
		var geoXml= new GGeoXml("" );
		map.setCenter(new GLatLng(<? echo $dslatitud?>,<? echo $dslongitud?>), <? echo $dszoom?>);
	    map.addControl(new GMapTypeControl());
        map.addControl(new GLargeMapControl());
        map.addControl(new GScaleControl());
        map.addControl(new GOverviewMapControl());

		//map.enableContinuousZoom();
		//map.enableDoubleClickZoom();

		map.addOverlay(geoXml);

	    var center = map.getCenter();



		map.setCenter(center, 15);

        var marker = new GMarker(center, {draggable: true});

		GEvent.addListener(marker, "dragstart", function() {
		 	map.closeInfoWindow();

		 });

 		  GEvent.addListener(marker, "dragend", function() {
		  var position = marker.getPoint();
	  	  map.panTo(new GLatLng(position.lat(), position.lng()));
		  // constructor del mensaje
		  var center = map.getCenter();
		  document.ubicaciones.dslatitud.value=position.lat();
			document.ubicaciones.dslongitud.value=position.lng();
			document.ubicaciones.dszoom.value=map.getZoom();
        }); // fin funcion
		 map.addOverlay(marker);

      }

}

</script>

<body color=#ffffff  topmargin=0 leftmargin=0 onLoad="iniciar()" onUnload="GUnload()">
<?
//include($rutxx."../../incluidos_modulos/modulos.encabezado.php");
include($rutxx."../../incluidos_modulos/modulos.mensajes.php");
// generacion del encabezado de acuerdo a los resultados encontrados

		$rutamodulo="<a href='$rutxx../core/default.php' class='textlink' title='Principal'>Principal</a>  /  ";
		$rutamodulo.="<a href='default.php' class='textlink' title='Principal'>Configuracion de oficinas</a>  /  ";
		$rutamodulo.=" <span class='text1'>".$titulomodulo." de ".$dsm."</span>";
		include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");

		include("mapas.tabla.php");

		//include("miembros.asistentes.tabla.php");

		//include($rutxx."../../incluidos_modulos/paginar.php");

	//include("miembros.ingreso.php");
	include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");

include($rutxx."../../incluidos_modulos/modulos.remate.php");
?>

</body>
</html>