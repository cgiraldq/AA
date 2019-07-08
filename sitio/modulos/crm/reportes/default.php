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
// edicion de datos
$rutx=1;
if($rutx==1) $rutxx="../";
include($rutxx."../../incluidos_modulos/modulos.globales.php");


$rc4 = new rc4crypt();
$titulomodulo="Listado de reportes del CRM";
$tabla="tblempresa";
$rutaImagen=$rutxx."../../../contenidos/imagenes/logo_empresa/";

?>
<html>
    <?include($rutxx."../../incluidos_modulos/head.php");?>
<body>

  <? include($rutxx."../../incluidos_modulos/navegador.principal.php");
  // generacion del encabezado de acuerdo a los resultados encontrados
$rutamodulo="<a href='$rutxx../core/default.php' target='_top' class='textlink'>Principal</a>  /";
$rutamodulo.=" <span class='text1'>".$titulomodulo."</span>";
include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");
?>


<table width="100%" cellpadding="0" cellspacing="0" align="center">
 	<tr>
    	<td align="center" valign="top" style=" padding: 30px 0 0 0;">

      <table width="70%" border="0" cellpadding="0" cellspacing="0" class="texto_centro" >
              <tr>
               	<td width="615" align="left" valign="middle">
               		<h1>Listado de reportes e indicadores</h1>
               	</td>
              </tr>
      </table>
<?
// debe venir 
$sql="select id, dsm,dstabla,idactivo,dsruta from framecf_tbltiposreportes where idactivo not in (2,9) order by dsm ";
     $result = $db->Execute($sql);
     if (!$result->EOF) {

?>

<table align="center" width="90%" cellspacing="1" cellpadding="5" border="0" width=70% class="text1">
<?
  while(!$result->EOF) {
    $id=$result->fields[0];
    $dsm=$result->fields[1];
    $dsruta=$result->fields[4];

?>
	<tr bgcolor="<? echo $fondo?>" onMouseOut="mOut(this,'<? echo $fondo;?>');" onMouseOver="mOvr(this,'<? echo $fondo3;?>');" >
		<td align="center"><? echo $dsm;?></td>
		<td align="center">
<? if ($result->fields[3]==3) { ?>
  <a href="<? echo $dsruta?>?idx=<? echo $result->fields[0]?>&r=1&reporte=<? echo $result->fields[1]?>&idxx=<? echo $result->fields[4]?>" class="btn_detalle">Ver reporte</a>
<? } else { ?>
<a href="reportes.detalle.php?idx=<? echo $result->fields[0]?>&r=1&reporte=<? echo $result->fields[1]?>&idxx=<? echo $result->fields[2]?>" class="btn_detalle">Ver reporte</a>
<? } ?>
</td>
	</tr>
<? 
  $result->Movenext();
}
}
$result->close();
 ?>

</table>

		</td>
 	</tr>
</table>



<?
include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
include($rutxx."../../incluidos_modulos/modulos.remate.php");
?>

</body>
</html>

