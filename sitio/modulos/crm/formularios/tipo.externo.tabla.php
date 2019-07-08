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
	include($rutxx."../../incluidos_modulos/modulos.buscador.php");
	include($rutxx."../../incluidos_modulos/paginar.variables.php");
		include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");
$result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
	if (!$result->EOF) {
		$dsvalorx=$result->fields[4];
?>



<table width="100%" cellpadding="0" cellspacing="0" align="center" class="cont_centro">
  <tr>

    <td align="center" valign="top" style="  padding:30px 0 0 0;">

<table width="70%" border="0" cellpadding="0" cellspacing="0" class="texto_centro">
        <tr>
          <td width="615" align="left"  valign="middle" ><img src="<? echo $rutxx; ?>../../img_modulos/modulos/ingresar_nuevo.png"><h1>EDITAR SELECCI&Oacute;N UNICA EXTERNA</h1></td>
        </tr>
</table>


<table align="center"  cellspacing="1" cellpadding="1" border="0" width=70% class="campos_ingreso">
<form action="<? echo $pagina;?>" method="post" name="u">

<tr valign=top bgcolor="#FFFFFF">
	<td width="35%">Seleccionar formulario.</td>
<? $sql=" SELECT id,dsm FROM framecf_tbltiposformularios WHERE idactivo in (1,3) ";
	$resultx=$db->Execute($sql);
	if (!$resultx->EOF) {

?>
	<td>
		<select  name="tipoform" id="tipoform"  onchange="listarcamposm('tipoform','dsmcampox','<? echo $_REQUEST['idx2'];?>','<? echo $dsvalorx;?>')">
			<option value=""> --Seleccionar -- </option>
			<?
				while (!$resultx->EOF) {
					$idx=$resultx->fields[0];
					$dsmx=reemplazar($resultx->fields[1]);
			?>
			<option value="<? echo $idx?>" <? if($result->fields[1]==$idx){ echo "selected";}?> ><? echo $dsmx;?></option>
			<?
			$resultx->MoveNext();
		}
			?>
		</select>

	</td>
<?
}
$resultx->Close();
?>
<td>
	<?
	$nombre_capa="capa_tipoform";
	$mensaje_capa="Debe seleccionar un formulario";
	include($rutxx."../../incluidos_modulos/control.capa.php");
?>
</td>

</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Seleccionar campo a mostrar</td>
<td id="contenedor">
	<select id="dsmcampox" name="dsmcampox">
		<option value=""> Seleccionar campo</option>
	</select>

</td>
<td>
	<?
	$nombre_capa="capa_dsmcampox";
	$mensaje_capa="Debe seleccionar un campo";
	include($rutxx."../../incluidos_modulos/control.capa.php");
?>

</tr>

<!--tr bgcolor="#FFFFFF" >
  <td colspan=2>
    <?/*
   $forma="u";
$param="tipoform,dsmcampox";
    include($rutxx."../../incluidos_modulos/botones.ingresar.php");
    */?>
  </td>
</tr-->

<tr>
	<td align="center" colspan="2" style="text-align: right;">
	<?
	$rr="formularios.campos.configurar.php?idx=".$_REQUEST['idx2'];
	$forma="u";
	$param="tipoform,dsmcampox";
	include($rutxx."../../incluidos_modulos/botones.modificar.php");?>
	<input type="hidden" name="idx" value="<? echo $idx?>">
	</td>
</tr>
<input type="hidden" name="editar" value="1">
<input type="hidden" name="idregistro" value="<? echo $result->fields[0];?>">
<input type="hidden" name="idx" value="<? echo $_REQUEST['idx'];?>">
<input type="hidden" name="idx2" value="<? echo $_REQUEST['idx2'];?>">

</form>


</table>

</td></tr>
</table>
<?
	} // fin si
$result->Close();
?>

<script type="text/javascript">

listarcamposm('tipoform','dsmcampox','<? echo $_REQUEST["idx2"]?>','<? echo $dsvalorx?>');

function listarcamposm(param,campobase,idform,dsm){
	//alert("entra")
	var x=document.getElementById(param).value;
	//alert(x);
	// recargar el combo de clientes
	 rutax="../../validaciones/campos.cargardatos.php?id="+x+"&idx="+idform+"&dsm="+dsm;
	 //alert(rutax);
        conexion1=AjaxObj();
        conexion1.open("POST",rutax,true);
        conexion1.onreadystatechange =function(){
            var contenedorx=document.getElementById(campobase);
            if (conexion1.readyState==4){
                var _resultadox = conexion1.responseText;
                //alert(_resultadox);
                //document.getElementById(campobase).style.display='';
                contenedorx.innerHTML=_resultadox;
            }
        }
        conexion1.send(null) // limpia conexion
}

</script>