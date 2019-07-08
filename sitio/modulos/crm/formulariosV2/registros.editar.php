<?

$pasar=1; // muestra el inyecion pero lo deja pasar
//$revisar=1;
$rutx=1;
if($rutx==1) $rutxx="../";
include($rutxx."../../incluidos_modulos/modulos.globales.php");
$rc4 = new rc4crypt();
$apagar=1;
$ideditar=1;

if($msn==1) {$error=0; $mensajes=$men[1];}
if($msn==2) {$error=1; $mensajes=$men[0];}
if($msn==3) {$error=0; $mensajes=$men[4];}

$idx=$_REQUEST['idx'];
if($_REQUEST['idx']=="") $idx=$_REQUEST['idxx'];
$idgaleria=$_REQUEST['idgaleria'];
$r=$_REQUEST['r'];

//$rr="registros.php?idgaleria=$idgaleria&idxx=$idx";
$rr="registros.php?idxx=".$_REQUEST['idx']."&r=1";
$titulomodulo="Listado de formularios";

?>
<html>
		<?include($rutxx."../../incluidos_modulos/head.php");?>
<body>
<?
if ($enca=="") include($rutxx."../../incluidos_modulos/navegador.principal.php");


$rutamodulo="<a href='$rutxx../../modulos/core/default.php?dstoken=$dstokenvalidador' class='textlink' title='Principal'>Principal</a>  /  ";
$rutamodulo.="  <a href='listado.php' class='textlink'>$titulomodulo</a>  / <a href='registros.php?idxx=$idx&r=1' class='textlink'>Listado de registros</a> / <span class='text1'>Editar registro</span>";
if ($enca=="") include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");

// select para encontrar el titulo del formulario

?>
<table width="100%" cellpadding="0" cellspacing="0" align="center"  class="cont_general">
  <tr>
    <td align="center" valign="top" style=" padding: 30px 0 0 0;">


<table width="70%" border="0" cellpadding="0" cellspacing="0" class="texto_centro" >
        <tr>
         	<td width="615" align="left" valign="middle">
        		<img src="<? echo $rutxx;?>../../img_modulos/modulos/edicion.png">
            <? if($_REQUEST['idx']==104){

              $idprop=seldato("consecutivo","id","framecf_tblregistro_formularios",$_REQUEST['idy'],2);

              ?>
                <h1>Editar Propiedad   <? echo str_pad($idprop,4,"0", STR_PAD_LEFT);?></h1>

            <?}else{?>
                <h1>Editar Registro de formulario <? echo seldato("dsm","id","framecf_tbltiposformularios",$_REQUEST['idx'],2);?></h1>
            <?}?>
         	</td>
        </tr>

</table>
<table>

<? $galerias = seldato("idgaleria","id"," framecf_tbltiposformularios",$idx,2);

  if($galerias==1){
?>
	<tr>
  	<td colspan="2">
<? if ($enca<>"") {?>
      <input type=button name=enviar value="Cerrar"  class="botones" onClick="window.close();">
<? } ?>
  		<input type=button name=enviar value="Detalle"  class="botones" onClick="Abrir_capa('detalle')">
  		<input type=button name=enviar value="Galeria"  class="botones" onClick="Abrir_capa('galeria')">
<? if ($enca=="") {?>
  		<input type=button name=enviar value="Observaciones"  class="botones" onClick="Abrir_capa('observaciones')">
<? } ?>
  	</td>
  </tr>
<?}?>


</table>


<form action="../../validaciones/validar.formularios.php" method=post id="u" name="u" enctype="multipart/form-data">

<table align="center" id="idtipo" cellspacing="1" cellpadding="1" border="0" width=98% class="campos_ingreso">
          <? include('formulario.seleccionar.tipo.php');?>
</table>
<?
$sql="select a.id,a.dsm,a.idformulario from framecf_tbltiposformulariosxcamposxagrupamiento a,tblagrupamientoxtblformularios b where idactivo=1 ";
$sql.=" and a.id=b.idorigen  and a.idformulario=$idx and a.id='".$agrupamiento."' group by a.dsm";
//echo $sql;
 $result=$db->Execute($sql);
   		if (!$result->EOF) {

        $sqlx=" select a.id,a.dsm from  framecf_tbltiposformulariosxcamposxagrupamientoxtemasxagrupados a,";

        $sqlx.=" tblagrupamientoxtblformulariosxtemasxagrupados b";

        $sqlx.=" where a.idformulario=$idx and a.id=b.idorigen and a.idactivo=1  and a.idagrupamiento='".$agrupamiento."'  ";        //echo $sqlx;

         $resultx=$db->Execute($sqlx);
          if (!$resultx->EOF) {
          	// se pintan los campos por agrupamiento por temas
            include('formularioxtemasxagrupamiento.php');

          }else{
           // aqui pinta los campos por agrupamiento de campos
        $idreferencia=$result->fields[2];
        //echo  $idreferencia;
        include('formulariosxagrupamientos.php');
          }
          $resultx->Close();

   		}else{

        $sqlx=" select id,dsm from framecf_tbltiposformulariosxcamposxagrupamientoxtemas where idformulario=$idx";
        //echo $sqlx;
         $resultx=$db->Execute($sqlx);
          if (!$resultx->EOF) {

          		// Aqui pinta los temas cuando no estan agrupados por agrupamientos
              include('formulariosxtemas.php');

          }else{
            // aqui pinta los campos normalmente
            include('formulariosxagrupamientos.php');

          }
          $resultx->Close();



   		}
   		$result->Close();


?>

<table align="center" id="idtipos" style="display:<? if($idformulario==104){echo "none";}?>" cellspacing="1" cellpadding="1" border="0" width=98% class="campos_ingreso">
    <input type="hidden" name="idusuario" value="<? echo $iduserx=seldato('idusuario','id','framecf_tblregistro_formularios',$_REQUEST['idy'],1);?>">
<?
if($idformulario==104 && $agrupamiento<>"") {include("formulario.puntoscercanos.php");}
if($iduser=='') $iduser=$iduserx;
if($_SESSION['i_idperfil']==1 || $_SESSION['i_idusuario']==$iduser){

  ?>

<tr>
  <td align="center" colspan="4">
  <?include($rutxx."../../incluidos_modulos/botones.modificar.php");?>
 </td>
</tr>
<?
}else{
?>
<tr>
  <td align="center" colspan="4">
<? if ($enca<>"") {?>
      <input type=button name=enviar value="Cerrar"  class="botones" onClick="window.close();">

<?} else {?>
    <input type=button name=enviar value="Regresar"  class="botones" onClick="irAPaginaD('<? echo $rr?>')">

<? }?>
 </td>
</tr>
<?
}
?>
</table>
</td>
</tr>
<input type="hidden" name="idagrupamiento" value="<? echo $agrupamiento;?>">
</form>

<tr id="galeria" style="display:none" >
	<td><? include('formulario.galeria.php'); ?></td>
</tr>

<tr id="observaciones" style="display:none" >
	<td><? include('formulario.observaciones.php'); ?></td>
</tr>
</table>




<?
if ($enca=="") include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
if ($enca=="") include($rutxx."../../incluidos_modulos/modulos.remate.php");
?>


</body>
</html>

<?include("formulario.direcciones.php");?>

<script type="text/javascript">

function Abrir_capa(parametro){

//alert(parametro);
	if(parametro=="detalle"){
  		document.getElementById('detalle').style.display='';
  		document.getElementById('galeria').style.display='none';
  		document.getElementById('observaciones').style.display='none';
  		document.getElementById('idtipo').style.display='';
      document.getElementById('idtipos').style.display='';
  	}

  	if(parametro=="galeria"){
  		document.getElementById('galeria').style.display='';
  		document.getElementById('detalle').style.display='none';
  		document.getElementById('observaciones').style.display='none';
  		document.getElementById('idtipo').style.display='none';
      document.getElementById('idtipos').style.display='none';
  	}

  	if(parametro=="observaciones"){
  		document.getElementById('observaciones').style.display='';
  		document.getElementById('detalle').style.display='none';
  		document.getElementById('galeria').style.display='none';
  		document.getElementById('idtipo').style.display='none';
      document.getElementById('idtipos').style.display='none';
  	}

  	/*	if (document.u.elements[campobase][i].value==97 && valor==97) {
  			if (document.u.elements[campobase][i].checked==true){
  				document.getElementById('capa_agendamiento').style.display='';
  			} else {
  				document.getElementById('capa_agendamiento').style.display='none';
  			}
  			break;
  		}*/
 }
 Abrir_capa('detalle');
 Abrir_capa('<? echo $_REQUEST["galeria"];?>');
 Abrir_capa('<? echo $_REQUEST["observaciones"];?>');

</script>


<script type="text/javascript">

  function agrupamiento_campos(valor){
    ///alert("entra");
    if(document.u.agrupamiento.value!=""){
      //alert("entra");

      document.getElementById('u').action="registros.editar.php";
      document.getElementById('u').submit();
    }

  }
<? if ($_REQUEST['abrirgaleria']<>"") {?>
    Abrir_capa('galeria');
<?} ?>
</script>