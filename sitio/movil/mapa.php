<!DOCTYPE html>

<!--[if lt IE 7 ]> <html class="ie ie6 no-js" lang="es"> <![endif]-->
<!--[if IE 7 ]>    <html class="ie ie7 no-js" lang="es"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie ie8 no-js" lang="es"> <![endif]-->
<!--[if IE 9 ]>    <html class="ie ie9 no-js" lang="es"> <![endif]-->
<!--[if gt IE 9]><!--><html lang="es"><!--<![endif]-->
 <? $ruta=1; // ruta cambiada para las variables
	if($rutap==1)$ruta=4;
    include("incluidos_modulos/varconexion.php");
    ?>
<? 
$idtienda=$_REQUEST["idtienda"];
//$db->debug=true;
$sqlx = "select a.dsm,a.dsd,a.dsruta,b.idtienda,b.lat,b.lon,b.zoom,a.dsimg,a.id ";
$sqlx.="FROM cms_tbltiendas a ,cms_tblmapasxtienda b  ";
$sqlx.="WHERE a.id=$idtienda and a.idactivo not in (2,9)  and b.idtienda=a.id ";
$resultx=$db->Execute($sqlx);
if (!$resultx->EOF) {
$dsm=utf8_encode($resultx->fields[0]);
$dsd=utf8_encode($resultx->fields[1]);
$dsruta=$resultx->fields[2];
$dslongitud=$resultx->fields[5];
$dslatitud=$resultx->fields[4];
$zoom=$resultx->fields[6];
$dsimg=$resultx->fields[7];
}
$resultx->Close();


?>
<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=<? echo $keyx;?>"type="text/javascript"></script>
<body >
<div id="capa_mapa" style="width: 600px; height: 600px"></div>
<form>
<input type="hidden" name="titulo" id="titulo" value="<?echo $dsm?>">
<input type="hidden" name="texto" id="texto" value="<?echo $dsd?>">

</form>
</body>
</html>
<script type="text/javascript">

cargar_mapa('<?echo $dslongitud?>','<?echo $dslatitud?>',<?echo $zoom?>);


function cargar_mapa (lon,lat,zoom) {
		//alert(lon+"---"+lat+"---"+zoom)
		codigo=document.getElementById('titulo').value;
		direccion=document.getElementById('texto').value;
		if (GBrowserIsCompatible()) {
        	var map = new GMap2(document.getElementById("capa_mapa"));
		    map.addControl(new GMapTypeControl());
		    map.addControl(new GLargeMapControl());
		    map.addControl(new GScaleControl());
		    map.addControl(new GOverviewMapControl());
			map.enableContinuousZoom();
			map.setCenter(new GLatLng(lat,lon),zoom);
		    map.clearOverlays();
			var point=new GLatLng(lat,lon);
			var marker = new GMarker(point, {draggable: false});
		    map.addOverlay(marker);
			html='<div style="border-bottom:1px solid #333;color:#006ec6">'+codigo+'</div><div style="margin-top:1px;margin-bottom:3px;"><span class=texto>' +direccion + '</span><br></div>'
			 marker.openInfoWindowHtml(html);
		}



}
</script>