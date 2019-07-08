<article class="cont_tracking">

	<h2>TRACKING</h2>

	<form action="/<? echo $rutaInclude?>/novedades.tracking.php" name="frm_tracking" id="frm_tracking" method="post" onsubmit="return validacion(this)">
	<fieldset>
		<input placeholder="Rastrear pedido" type="text" name="idpedido" id="idpedido"  onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_idpedido','')">
		<span class="camp_requerido" id="capax_idpedido" style="display:none;"></span>
		<!--span class="camp_requerido"> Campo requerido</span-->
	</fieldset>
		<?
			$forma="frm_tracking";
			/*$param="captcha";*/
			$param="idpedido";
		?>
	<nav class="btn_centro">
		<input type="button" name="envio" id="envio" value="Ingresar" class="btn_general" onclick="valFormulario('<?echo $forma?>','<? echo $param?>',0,'','<? echo $rut ?>');" alt="Enviar" target="_blank">
		<input type="hidden" name="tracking" id="" value="1">
		<input type="hidden" name="pagina"  value="<? echo $pag ?>?ir=1&dsnombre=<? echo $_REQUEST['dsnombre'];?>">
	</nav>

	</form>


</article>

<!--script type="text/javascript">

//Validar que el campo de formulario contenga sólo números
function validacion(f)  {
if (isNaN(f.idpedido.value)) {
alert("Error:\nEste campo debe tener sólo números.");
f.idpedido.focus();
return (false);
 }
}
</script-->


