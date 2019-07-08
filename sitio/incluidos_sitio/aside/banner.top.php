<?
$ubic=3;
$rutaBannerx=$rutalocalimag."/contenidos/images/banners/";
//if ($idtienda>0) $rutaBannerx="/contenidos/images/banners/";
//if ($rutaAmiga>1) $rutaBannerx="../contenidos/images/banners/";


$sql="select a.id,a.dsimg,a.dsruta,a.dsflash,a.dsalto,a.dsancho,a.dsmodo ";
$sql.="from tblbanners a inner join tblbannersxtblpaginas c on c.idorigen=a.id";
//if ($idtienda>0 ) $sql.=" inner join tblbannersxtblempresa b on b.idorigen=a.id"; // indica tienda hija
$sql.=" where a.idactivo=$ubic";
$sql.=" and c.iddestino='$idpagina'";
$sql.=" and $fechaBaseNum between a.idfechai and a.idfechaf ";


//if ($idtienda>0 ) $sql.=" and b.iddestino=$idtienda "; // indica tienda hija
$sql.=" order by rand() ";

if ($limit>0) $sql.=" LIMIT 0,$limit";
//echo $sql;

//echo $sql;
//if ($tipo=="mysql") $sql.="  order by rand() limit 0,$limite "; // solo para mysql
//echo $sql;
$resultb = $db->Execute($sql);

if (!$resultb->EOF) {
	while (!$resultb->EOF) {
		?>
		<div class="banners">
		<?
		$id=$resultb->fields[0];
		$dsimg1=$resultb->fields[1];
		$dsruta=$resultb->fields[2];
		$dsflash=$resultb->fields[3];
		$dsalto=$resultb->fields[4];
		$dsancho=$resultb->fields[5];
		$dsmodo=$resultb->fields[6];
		$mensaje="Click para m&aacute;s informaci&oacute;n";
		if ($dsmodo=="") $dsmodo="_self";
		if ($dsruta<>""){
		$ahref1="<a href='".$dsruta."' target='".$dsmodo."' title='".reemplazar($mensaje)."'>";
			$ahref2="</a>";
		}else{
			$ahref1="";
			$ahref2="";
		}
		if (substr($dsimg1,-3)=="swf" || substr($dsimg1,-3)=="SWF"){
			$archivo=$dsimg1;
			$ruta=$rutaBannerx;
			include($rut."modulos/reproductores/flasher.php");
		} elseif(substr($dsimg1,-3)=="flv" || substr($dsimg1,-3)=="FLV" ){
			$altorx="580";
			$anchorx="170";
			$dsvideo=$dsimg1;
			$rutaImagen=$rut."../images/banners/";
			$rutaRepro=$rutaAbs."/images/banners/"; // para reproducir el video
			$rutaPlayer="modulos/"; // uso para incluir el modulo reproductor de video
			 $nombre_capa_video="capa_repr_video_1"; ?>
			<?
			include($rut."modulos/reproductores/default.php");
		} else {
		//echo "are";
			//echo $rutaBannerx.$dsimg1;

			?>

			<? echo $ahref1?>
				<img src="<? echo $rutaBannerx.$dsimg1;?>" align="absmiddle" border="0" />
			<? echo $ahref2?>

			<?
		}
		if ($limite>1) echo "<br>";
		?>
	</div>
		<?
		 $resultb->MoveNext();
	}
}
$resultb->Close();
?>

