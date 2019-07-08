<?
$pasar=1; // muestra el inyecion pero lo deja pasar
//$revisar=1;
$rutx=1;
if($rutx==1) $rutxx="../";
include($rutxx."../../incluidos_modulos/modulos.globales.php");
include ($rutxx."../../incluidos_modulos/func.calendario_2.php"); // funcion nueva del calendario

$rc4 = new rc4crypt();
$apagar=1;
if($_REQUEST['idy']<>"")$ideditar=2;

if($msn==1) {$error=0; $mensajes=$men[1];}
if($msn==2) {$error=1; $mensajes=$men[0];}
if($msn==3) {$error=0; $mensajes=$men[4];}

$idx=$_REQUEST['idx'];
if($_REQUEST['idx']=="") $idx=$_REQUEST['idxx'];
$idgaleria=$_REQUEST['idgaleria'];
$r=$_REQUEST['r'];
$registrorapido=1;
//$rr="registros.php?idgaleria=$idgaleria&idxx=$idx";
$rr="registro.rapido.php?idxx=".$_REQUEST['idx']."&r=1";
$titulomodulo="Registro rapido";

?>
<html>
		<?include($rutxx."../../incluidos_modulos/head.php");?>
<body>
<?
 include($rutxx."../../incluidos_modulos/navegador.principal.php");


$rutamodulo="<a href='$rutxx../../modulos/core/default.php?dstoken=$dstokenvalidador' class='textlink' title='Principal'>Principal</a>  /  ";
$rutamodulo.="  <a href='registro.rapido.php' class='textlink'>$titulomodulo</a>  / <span class='text1'>Editar registro</span>";
include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");

// select para encontrar el titulo del formulario

?>
<table width="100%" cellpadding="0" cellspacing="0" align="center"  class="cont_general">
  <tr>
    <td align="center" valign="top" style=" padding: 30px 0 0 0;">


<table width="98%" border="0" cellpadding="0" cellspacing="0" class="campos_ingreso" >
        <tr>
         	<td align="left" valign="middle">
                <strong>Atenci&oacute;n</strong>: Los campos son obligatorios.
                en los datos gesti&oacute;n debe ingresar el motivo de la llamada , las observaciones y a quien le asigna la gesti&oacute;n
         	</td>
        </tr>

</table>

<form action="../../validaciones/validar.formularios.rapido.php" method=post id="u" name="u">

<table align="center" id="idtipo" cellspacing="1" cellpadding="1" border="0" width=98% class="campos_ingreso">

</table>
<?
//$db->debug=true;
$campo_obligatorio=1;
$sql="select a.id,a.dsm,a.idformulario from framecf_tbltiposformulariosxcamposxagrupamiento a,tblagrupamientoxtblformularios b where idactivo=1 ";
$sql.=" and a.id=b.idorigen and a.idformulario=$idx and a.id='".$agrupamiento."' group by a.dsm";
//echo $sql;
 $result=$db->Execute($sql);
   		if (!$result->EOF) {

        $sqlx=" select a.id,a.dsm from  framecf_tbltiposformulariosxcamposxagrupamientoxtemasxagrupados a,";

        $sqlx.=" tblagrupamientoxtblformulariosxtemasxagrupados b";

        $sqlx.=" where a.idformulario=$idx and a.id=b.idorigen and a.idactivo=1  and a.idagrupamiento='".$agrupamiento."'  ";        //echo $sqlx;

         $resultx=$db->Execute($sqlx);
          if (!$resultx->EOF) {
          	// se pintan los campos por agrupamiento por temas
            include('../formularios/formularioxtemasxagrupamiento.php');

          }else{
           // aqui pinta los campos por agrupamiento de campos
        $idreferencia=$result->fields[2];
        //echo  $idreferencia;
        include('../formularios/formulariosxagrupamientos.php');
          }
          $resultx->Close();

   		}else{

        $sqlx=" select id,dsm from framecf_tbltiposformulariosxcamposxagrupamientoxtemas where idformulario=$idx";
//       echo $sqlx;
         $resultx=$db->Execute($sqlx);
          if (!$resultx->EOF) {

          		// Aqui pinta los temas cuando no estan agrupados por agrupamientos valga la redundancia
              include('../formularios/formulariosxtemas.php');

          }else{
            // aqui pinta los campos normalmente
            include('../formularios/formulariosxagrupamientos.php');

          }
          $resultx->Close();

   		}
   		$result->Close();


?>

<table align="center" id="idtipos" style="display:<? if($idformulario==104){echo "none";}?>" cellspacing="1" cellpadding="1" border="0" width=98% class="campos_ingreso">

<? include('seleccionar.usuario.php');?>

<?
  if($_SESSION['i_idperfil']==1 || $_SESSION['i_idusuario']<>1){
?>



<? if($_REQUEST['nuevo']==2){?>
<tr>
  <td align="center" colspan="4">
  <input type=button name=enviar value="GUARDAR GESTI&Oacute;N"  class="botones" onClick="valU('<? echo $forma; ?>','<? echo $param?>','','');">
  <input type="hidden" name="guardarx" value="1">
<? if($_SESSION['i_idperfil']<>1){?>

<?}?>
 </td>
</tr>
<?}?>


<? if($_REQUEST['nuevo']==1){?>
<tr>
  <td align="center" colspan="4">
  <input type=button name=enviar value="GUARDAR CLIENTE Y GESTION"  class="botones" onClick="valU('<? echo $forma; ?>','<? echo $param?>','','');">
  <input type=button name=enviar value="GUARDAR CLIENTE Y ENVIAR COTIZACI&Oacute;N"  class="botones" onClick="javascript:document.getElementById('guardarxx').value='3';valU('<? echo $forma; ?>','<? echo $param?>','','');">
  <input type="hidden" name="guardarx" id="guardarxx" value="2">
<? if($_SESSION['i_idperfil']<>1){?>

<?}?>
 </td>
</tr>
<?}?>

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
</table>


<? if($_REQUEST['nuevo']<>1){?>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="texto_centro" >

 <tr>
          <td width="615" align="left" valign="middle">
            <img src="<? echo $rutxx;?>../../img_modulos/modulos/edicion.png">

                <h1>Acciones a realizar</h1>

          </td>
        </tr>
  <tr>
     <td align="center">
   <?

        $sql=" SELECT a.id,a.dsm FROM  framecf_tbltiposformularios a, tblrelacionesxtblformularios b WHERE a.id=b.iddestino";
        $resultx = $db->Execute($sql);
        if (!$resultx->EOF) {
          while(!$resultx->EOF) {
            $idf=$resultx->fields[0];
            $dsm=$resultx->fields[1];

            $ruta="../formularios/formularios.vistaprevia.php?idx=$idf&idcliente=".$_REQUEST['idy'];
           ?>

<input type=button name=enviar value="<? echo $dsm;?>"  class="botones" onClick="valregistro('<? echo $forma; ?>','<? echo $param; ?>','<? echo $ruta;?>');">

           <?

            $resultx->MoveNext();
          }

        }
        $resultx->Close();

      ?>



<input type="button" name="enviar" value="REGRESAR" class="botones" onclick="irAPaginaD('registro.rapido.php?idxx=<? echo $_REQUEST['idx'];?>')">
       </td>
  </tr>
</table>
<?}?>

</td>
</tr>




</form>


</table>



<?
include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
include($rutxx."../../incluidos_modulos/modulos.remate.php");
?>


</body>
</html>

<?include("../formularios/formulario.direcciones.php");?>


