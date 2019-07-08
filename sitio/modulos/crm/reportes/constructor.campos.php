<?

$pasar=1; // muestra el inyecion pero lo deja pasar
//$revisar=1;
$rutx=1;
if($rutx==1) $rutxx="../";
include($rutxx."../../incluidos_modulos/modulos.globales.php");

$apagar=1;
$ideditar=1;

if($msn==1) {$error=0; $mensajes=$men[1];}
if($msn==2) {$error=1; $mensajes=$men[0];}
if($msn==3) {$error=0; $mensajes=$men[4];}

$idx=$_REQUEST['idx'];


$tablarelaciones="tbltiposreportesxcampos";
    $tablaorigen="framecf_tbltiposformulariosxcampo";
include("../../relaciones/relaciones.operaciones.php");
//$rr="registros.php?idgaleria=$idgaleria&idxx=$idx";
$rr="constructor.php";
$titulomodulo="Listado de campos de la fuente del reporte seleccionada";

?>
<html>
		<?include($rutxx."../../incluidos_modulos/head.php");?>
<body>
<?
 include($rutxx."../../incluidos_modulos/navegador.principal.php");


$rutamodulo="<a href='$rutxx../../modulos/core/default.php?dstoken=$dstokenvalidador' class='textlink' title='Principal'>Principal</a>  /  ";
$rutamodulo.="  <a href='".$rr."' class='textlink'>$titulomodulo</a>  / <a href='constructor.php?idxx=$idx&r=1' class='textlink'>Constructor de Reportes</a> / <span class='text1'>Editar registro</span>";
include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");

// select para encontrar el titulo del formulario

?>
<table width="100%" cellpadding="0" cellspacing="0" align="center"  class="cont_general">
  <tr>
    <td align="center" valign="top" style=" padding: 30px 0 0 0;">


<table width="70%" border="0" cellpadding="0" cellspacing="0" class="texto_centro" >
        <tr>
         	<td width="615" align="left" valign="middle">
        		<img src="<? echo $rutxx;?>../../img_modulos/modulos/edicion.png">
         		<h1>Asociar campos al reporte</h1>
         	</td>
        </tr>

</table>

<form action="constructor.campos.php" method=post id="u" name="u">


<?


 include("constructor.campos.listado.php");
if($_SESSION['i_idperfil']==1 || $_SESSION['i_idusuario']==$iduser){
  ?>
<tr>
  <td align="center" colspan="4">
  <input type="submit" name=enviar value="Actualizar"  class="botones">
   <input type=button name=enviar value="Regresar"  class="botones" onClick="irAPaginaD('<? echo $rr?>')">
 </td>
</tr>
<?
}else{
?>
<tr>
  <td align="center" colspan="4">
    <input type=button name=enviar value="Regresar"  class="botones" onClick="irAPaginaD('<? echo $rr?>')">

 </td>
</tr>
<?
}
?>

</td>
</tr>

<input type="hidden" name="idx" value="<? echo $_REQUEST['idx'];?>">
<input type="hidden" name="idy" value="<? echo $_REQUEST['idy'];?>">
<input type="hidden" name="idform" value="<? echo $_REQUEST['idform'];?>">

<input type="hidden" name="paso" value="1">

</form>

</table>




<?
include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
include($rutxx."../../incluidos_modulos/modulos.remate.php");
?>


</body>
</html>

