<?
/*
| ----------------------------------------------------------------- |
FrameWork Cf Para CMS CRM ECOMMERCE
Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c)
Medellin - Colombia
=====================================================================
  Autores:
  Area Investigacion y Desarrollo
  Area Diseno y Maquetacion
  Area Mercadeo
=====================================================================
| ----------------------------------------------------------------- |
*/
// Tabla central de datos cuando se hacen los listados

if ($exportardatos<>1){
	include($rutxx."../../incluidos_modulos/modulos.buscador.php");
	include($rutxx."../../incluidos_modulos/paginar.variables.php");
	include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");
}
?>

<table width="100%" border="0" cellpadding="0" cellspacing="0" class="texto_centro" >
        <tr>
         	<td align="left" valign="middle">
        		<img src="<? echo $rutxx;?>../../img_modulos/modulos/edicion.png">

                <h1>
<? if ($_REQUEST['campo']=="idconsecutivo"){
	echo "Busqueda por codigo";
} else {
     echo "Registro rapido de clientes";
}?>

                </h1>

         	</td>
         	<td align="right">
         		  <input type="button" class="botones" value="Ingresar nuevo Cliente " onclick="irAPaginaD('registros.editar.php?idx=1&nuevo=1')">
         		  <input type="button" class="botones" value="Agendamiento" onclick="irAPaginaD('../agenda/default.php')">

         	</td>
        </tr>


</table>
<?

	//$tablax=$prefix."tbltiposformularios";
     $result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
	if (!$result->EOF) {


$border=0;
if ($exportardatos==1) $border=1;
?>
<br>
<? if ($exportardatos==1) { ?>

<table width="100%" border="<? echo $border;?>" cellpadding="2" cellspacing="1" align="center" class="text1">
<tr>
	<td><? echo $titulomodulo?></td>
</tr>
</table>
<? } ?>



<table width="100%" border="<? echo $border;?>" cellpadding="2" cellspacing="1" align="center" class="text1">

<form action="<? echo $pagina;?>" method=post name=p>


<?
// encabezado generico basado

 //if($_REQUEST['idxx']==104)$user=",Clasificado gratis,Usuario asociado,Arrendatario";
//if ($_REQUEST['campo']=="consecutivo")  $nombrecampos.="Cliente Asociado,";	
$nombrecampos.="Asesor,";
$nombrecampos=trim($nombrecampos,',');
include($rutxx."../../incluidos_modulos/tabla.encabezado.php");
$contar=0;
	while (!$result->EOF && ($contar<$maxregistros)) {
		if ($contar%2==0) {
			$fondo=$fondo1;
		} else {
			$fondo=$fondo2;
		}
		$idregistro=$result->fields[3]; // id del cliente
		$idcampo=$result->fields[3];
		if ($_REQUEST['campo']=="idconsecutivo")  {
			$idregistro=$result->fields[6]; // id del cliente
			$idcampo=$result->fields[3]; // id de la propiedad

		}
 		
 	?>

 		<tr bgcolor="<? echo $fondo?>" <? if ($exportardatos==1) { ?>onMouseOut="mOut(this,'<? echo $fondo;?>');"
 			onMouseOver="mOvr(this,'<? echo $fondo3;?>');" <? } ?>>
 		<td align="center"><? echo str_pad($result->fields[5],4,"0", STR_PAD_LEFT);
 			?>
 		</td>

 			<?
 		if ($_REQUEST['campo']=="idconsecutivo") {
 			?>
<?
// datos del prop
$sql="select id, nombre_o_razn_social,apellido_o_nombre_comercial from crm_clientes ";
$sql.="where  id='".$result->fields['idpropietario']."'";
//echo $sql;
$idcliente=0;
$result_campos=$db->Execute($sql);
if (!$result_campos->EOF) {
	$idcliente=$result_campos->fields[0];

	$n=$result_campos->fields[1];
	$n2=$result_campos->fields[2];
	} // fin si
$result_campos->Close();

?>

				<td align="center">
<? 	
	echo $n." ".$n2." ".$a." ".$a2;

?>				</td>


				<td align="center">
<? 
			echo seldato("dsm","id","framecf_tbltiposformulariosxcampos",$result->fields['disponibilidad'],1);?>
				</td>
				<td align="center">
<? 
			echo seldato("dsm","id","framecf_tbltiposformulariosxcampos",$result->fields['ciudad'],1);?>

				</td>
				<td align="center"><? 
			echo $result->fields['area_construida'];?>

</td>
				<td align="center">
<? 
			echo number_format($result->fields['precio_de_venta'],0);?>
		</td>
				<td align="center">
<? 
			echo number_format($result->fields['precio_de_arriendo'],0);?>
		</td>
	
 			<?
 		}	 else {
 				for ($i=6; $i < $cantidad+4; $i++) {
			?>
				<td align="center"><? echo ellistr($result->fields[$i],100);?></td>
			<?}
}
			?>

				<td align="center"> <? echo seldato("dsm","id","tblusuarios",$result->fields['idusuario'],1);?></td>


<? if ($exportardatos=="") { ?>

		  <td align="center">
<? if($_REQUEST['campo']<>"idconsecutivo"){?>
<a class="botones" href="javascript:irAPaginaDN('../vendedor/reportes.php?id=<? echo $idregistro; ?>')" type="imprimir" title="Click para el resumen de gestiones que posee este cliente">Resumen</a>

<?}
 if ($_REQUEST['campo']=="idconsecutivo") {
?>
<a class="botones" href="javascript:irAPaginaDN('../../../detalle.php?id=<? echo $idcampo?>')" type="imprimir" title="Click para ver la propiedad">Ver en sitio</a>
<a class="botones" href="javascript:irAPaginaDN('formulario.ver.detalle.php?id=<? echo $idcampo?>&tabla=crm_propiedades&tipo=104')" type="imprimir" title="Click para ver la propiedad">Ver propiedad</a>
<a class="botones" href="javascript:irAPaginaDN('formulario.ver.detalle.php?id=<? echo $idcampo?>&tabla=crm_carpeta_contrato_arrendamiento&tipo=110')" type="imprimir" title="Click para ver la carpeta de la propiedad">Ver Check Carpeta</a>

<?
 }
?>


<?
 if ($_REQUEST['campo']<>"idconsecutivo") {
?>

<a class="botones" href="javascript:irAPaginaDN('formulario.ver.detalle.php?id=<? echo $idcampo?>&tabla=crm_clientes&tipo=1')" type="imprimir" title="Click para ver la propiedad">Ver Cliente</a>
<?
 }
 $coment=seldato('comentarios','id','crm_clientes',$idregistro,1);
?>


<input type="button" class="botones" value="Crear Cotizaci&oacute;n" onclick="irAPaginaD('../../crm/formularios/formularios.vistaprevia.php?idx=50&cliente_asociado=<? echo $idregistro; ?>&asesor_operativo=<? echo $_SESSION['i_idusuario']; ?>&obs=<? echo $coment; ?>&rapido=1&param=<? echo $_REQUEST['param']; ?>&campo=<? echo $_REQUEST['campo']; ?>')" type="imprimir" title="Click para crear cotizaci&oacute;n">

<?
			  $rutaeditar="registros.editar.php";

			if ($_REQUEST['campo']<>"idconsecutivo") {
			  $rutax=$rutaeditar."?idx=".$idxx."&idy=".$idregistro."&nuevo=2";
			  $formax="";
			  $mrutax="Gestionar";
			  $clase="botones";
			  include($rutxx."../../incluidos_modulos/enlace.generico.php");

			}else{
				if ($idcliente>0) {   $rutax=$rutaeditar."?idx=".$idxx."&idy=".$result->fields[6]."&nuevo=2";
				  $formax="";
				  $mrutax="Gestionar";
				  $clase="botones";
				  include($rutxx."../../incluidos_modulos/enlace.generico.php");
				}  
			}

			  ?>
              <br>
		  </td>
<? } ?>
		</tr>

		<?
		$contar++;
		$result->MoveNext();
	} // fin while
	if ($exportardatos<>1){
?>
</form>
</table>
<?}
	}else{
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="texto_centro" >
<tr>
	<td>
		<? if ($_REQUEST['param']=="") {
			echo "Ingrese lo que desee buscar y presione el bot&oacute;n 'Buscar'";
		} else {
			echo "NO HAY COINCIDENCIAS DE BUSQUEDA ";
			
		}?>
	</td>

</tr>

</table>
<?
	}
	 // fin si
$result->Close();


?>

