<?
$sql="select dstit,dsd2 from tblpaginas where dsm='$pag'";
$result=$db->Execute($sql);
if(!$result->EOF){
$dsm=reemplazar($result->fields[0]);
$dsd=reemplazar($result->fields[1]);
$dsd=preg_replace("/\n/","<br>",$dsd);
?>

<h1><? echo $dsm ?></h1>
<p><? echo $dsd ?></p>

<?
}
$result->Close();
?>

<article class="cont_recuperar_contrasena">

	<?  $idg=$_REQUEST['idg'] ?>
	<? if($idg==3) {?><p style="color:red">Lo sentimos este correo no esta registrado en nuestro sistema.</p><? } ?>

		<form action="modulos/validaciones/envio.contrasena.php" name="frm_recuperar_contrasena" method="post" id="frm_recuperar_contrasena">
			<?
				$forma="frm_recuperar_contrasena";
				/*$param="captcha";*/
				$param="dscorreo";
			?>
			<fieldset>
				<div><input placeholder="Ingrese su email" type="text" name="dscorreo" id="dscorreo" tabindex="4" onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dscorreo','')"></div>
				<span class="camp_requerido" id="capax_dscorreo" style="display:none;"></span>
			</fieldset>

			<nav class="btn_derecha">
				<input type="button" value="Enviar" class="btn_general" onclick="valFormulario('<?echo $forma?>','<? echo $param?>',0,'','<? echo $rut ?>');">
				<input type="reset" value="Cancelar" class="btn_general">
			</nav>
		</form>

</article>

<article class="enlace_registro">
     <p>SI AÚN NO ESTÁ REGÍSTRADO HAGA CLIC EN EL SIGUIENTE BOTÓN</p>
     <nav class="btn_centro">
         <a href="registro.php" class="btn_general"><p>REGISTRESE A LA ZONA PRIVADA</p></a>
     </nav>
 </article>