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

	include($rutxx."../../incluidos_modulos/paginar.variables.php");

$result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
if ($result->EOF) {
?>



<table width="100%" cellpadding="0" cellspacing="0" align="center" class="cont_centro">
  <tr>

    <td align="center" valign="top" style="  padding:30px 0 0 0;">

<table width="70%" border="0" cellpadding="0" cellspacing="0" class="texto_centro">
        <tr>
          <td width="615" align="left"  valign="middle" ><img src="<? echo $rutxx; ?>../../img_modulos/modulos/ingresar_nuevo.png"><h1>CONFIGURACI&Oacute;N SELECCI&Oacute;N UNICA EXTERNA</h1></td>
        </tr>
</table>


<table align="center"  cellspacing="1" cellpadding="1" border="0" width=70% class="campos_ingreso">
<form action="<? echo $pagina;?>" method="post" name="u">

<tr valign=top bgcolor="#FFFFFF">
	<td width="35%">Seleccionar formulario.</td>
<? $sql=" SELECT id,dsm FROM framecf_tbltiposformularios WHERE idactivo=1 ";
	$resultx=$db->Execute($sql);
	if (!$resultx->EOF) {
		
?>
	<td>
		<select  name="tipoform" id="tipoform"  onchange="listarcampos('tipoform','dsmcampox')">
			<option value=""> --Seleccionar -- </option>
			<?
				while (!$resultx->EOF) {
					$idx=$resultx->fields[0];
					$dsmx=reemplazar($resultx->fields[1]);
			?>
			<option value="<? echo $idx?>"><? echo $dsmx;?></option>
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
<td>Seleccionar campo a mostar</td>
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

<tr bgcolor="#FFFFFF" >
  <td colspan=2>
    <?
   $forma="u";
$param="tipoform,dsmcampox";
    include($rutxx."../../incluidos_modulos/botones.ingresar.php");
    ?>
  </td>
</tr>

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

function listarcampos(param,campobase){
	//alert("entra")
	var x=document.getElementById(param).value;
	//alert(x);
	// recargar el combo de clientes
	 rutax="../../validaciones/campos.cargardatos.php?id="+x;
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