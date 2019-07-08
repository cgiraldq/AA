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
include("../../../incluidos_modulos/modulos.globales.php");
//$rc4 = new rc4crypt();
//$db->debug=true;
$rr="default.php";
$titulomodulo="Configuracion de paginas";
$tablarelaciones=$prefix."ecommerce_tblpromocionesxproducto";
$tablaorigen=$prefix."ecommerce_tblproductos";
$rr="default.php";
$idx=$_REQUEST['idx'];
$idpreciox=$_REQUEST['dsprecio_'];
$tabla=$prefix."ecommerce_tblpromociones";
include($rutxx."../relaciones/relaciones.operaciones.promociones.php");   
?>
<html>
    <?include($rutxx."../../incluidos_modulos/head.php");?>
<body>

  <? include($rutxx."../../incluidos_modulos/navegador.principal.php");
// generacion del encabezado de acuerdo a los resultados encontrados
$sql="select a.dsm";
$sql.=" from $tabla a ";
$sql.=" where a.id=$idx ";

//echo $sql;

$result = $db->Execute($sql);
if (!$result->EOF) {
$totalregistros=$result->RecordCount();
  $rutamodulo="<a href='../core/default.php' class='textlink' title='Principal'>Principal</a>  /  ";
  $rutamodulo.="  <a href='default.php' class='textlink'>Listado bloque del menu </a>  /  <span class='text1'>$titulomodulo</span>";
include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");
$dsm=$result->fields[0];

?>
<? include($rutxx."../../incluidos_modulos/encabezado.editar.php");?>


  <table align="center"  cellspacing="1" cellpadding="5" border="0" width=70% class="campos_ingreso">
<form action="<? echo $pagina;?>?idx=<? echo $idx;?>" method=post name=u enctype="multipart/form-data">

<tr valign=top bgcolor="#FFFFFF">
<td colspan="2">
<strong>Aplicar  promocion sobre precio.</strong>
<?// $db->debug=true;
$datasqladd=" and idactivo not in (2,9)";
include($rutxx."../relaciones/default.promo.php");?>
<table width="100%" border="0" cellpadding="2" cellspacing="0" class="text1" >
  <tr>
    <td colspan=5>
      <input type="checkbox" name="Adjuntar_" value="1" onclick="ActivarTodoGeneral('u','Adjuntar_','dsprecio_[]')" />
      <strong>Seleccionar todo</strong>
    </td>
  </tr>
  <tr>
 <? // $db->debug=true;
$and=" and idprecio=1";
$and2=" and idprecio=2";
$and3=" and idprecio=3";
$and4=" and idprecio=4";
$and5=" and idprecio=5";
$idprecio1=seldato('idprecio','idorigen',$tablarelaciones,$idx.$and,1) ;
$idprecio2=seldato('idprecio','idorigen',$tablarelaciones,$idx.$and2,1) ;
$idprecio3=seldato('idprecio','idorigen',$tablarelaciones,$idx.$and3,1) ;
$idprecio4=seldato('idprecio','idorigen',$tablarelaciones,$idx.$and4,1) ;
$idprecio5=seldato('idprecio','idorigen',$tablarelaciones,$idx.$and5,1) ;
?>
<td align="left">
<input type="checkbox" name="dsprecio_[]" value="1" <? if ($idprecio1==1) echo "checked";?>>Precio 1
</td>
<td align="left">
<input type="checkbox" name="dsprecio_[]" value="2" <? if ($idprecio2==2) echo "checked";?>>Precio 2
</td>
<td align="left">
<input type="checkbox" name="dsprecio_[]" value="3" <? if ($idprecio3==3) echo "checked";?>>Precio 3
</td>
<td align="left">
<input type="checkbox" name="dsprecio_[]" value="4" <? if ($idprecio4==4) echo "checked";?>>Precio 4
</td>
<td align="left">
<input type="checkbox" name="dsprecio_[]" value="5" <? if ($idprecio5==5) echo "checked";?>>Precio 5
</td>
  </tr>
 </table> 


</td>
</tr>


<tr><td align="center" colspan="2">
<?
$forma="u";
$param="id";  
include($rutxx."../../incluidos_modulos/botones.modificar.php");?>
<input type="hidden" name="idx" value="<? echo $idx?>">

</td></tr>


<tr valign=top bgcolor="#FFFFFF">
<td colspan="2">

</td>
</tr>


</form>
</table>
<br>

</td>
</tr>
</table>
<?
} // fin si 
$result->Close();
?>
<br>
<? 
  include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");

include($rutxx."../../incluidos_modulos/modulos.remate.php");?>

</body>
</html>