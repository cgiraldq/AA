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

$idx=$_REQUEST['idxx'];
if($_REQUEST['idx']=="") $idx=$_REQUEST['idxx'];
$idgaleria=$_REQUEST['idgaleria'];
$r=$_REQUEST['r'];

//$rr="registros.php?idgaleria=$idgaleria&idxx=$idx";
$rr="registros.php?idxx=".$_REQUEST['idxx']."&r=1";
$titulomodulo="Listado de formularios";

?>
<html>
		<?include($rutxx."../../incluidos_modulos/head.php");?>
<body>
<?
 include($rutxx."../../incluidos_modulos/navegador.principal.php");


$rutamodulo="<a href='$rutxx../../modulos/core/default.php?dstoken=$dstokenvalidador' class='textlink' title='Principal'>Principal</a>  /  ";
$rutamodulo.="  <a href='".$rr."' class='textlink'>$titulomodulo</a>  / <a href='registros.php?idxx=$idx&r=1' class='textlink'>Listado de registros</a> / <span class='text1'>Editar registro</span>";
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
         		<h1>Editar Registro seleccionado</h1>
         	</td>
        </tr>

</table>

<form action="../../validaciones/validar.formularios.php" method=post id="u" name="u">


<?


 include("formulario.puntoscercanos.php");
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
<input type="hidden" name="cercano" value="1">
<input type="hidden" name="idxx" value="<? echo $_REQUEST['idxx'];?>">
<input type="hidden" name="idy" value="<? echo $_REQUEST['idy'];?>">
<input type="hidden" name="paso" value="1">
</form>

</table>




<?
include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
include($rutxx."../../incluidos_modulos/modulos.remate.php");
?>


</body>
</html>

