	<article class="cont_frm_vertical">

	<h1>Registro Como cliente - Paso 3 de 3</h1>
	<p>Complete los siguientes pasos</p>

	<form action="modulos/validaciones/registro.paso.3.php" name="frmpaso3" method="post" id="frmpaso3">
		<?
			$forma="frmpaso3";
			/*$param="captcha";*/
			$param="dsrecibir";
		?>
		<article class="cont_checket">

<?if ($idtienda==1) {?>
<?
	$id=$_REQUEST['idx'];
    $sql="select dsm,id from tblt_casilleros where idactivo=1 order by idpos asc";

    $result=$db->Execute($sql);
    if(!$result->EOF){
    	$i=0;
  	while(!$result->EOF){
        $dsm=reemplazar($result->fields[0]);
        $idcasillero=$result->fields[1];
?>



		<fieldset class="checked1 bg_gris">
			<div class="checkeds">
				<input type="checkbox" name="sel_casillero[]" value="<? echo $idcasillero; ?>"><label for=""><? echo $dsm; ?></label>
			</div>
		</fieldset>

<?
	$result->MoveNext();
	$i++;
	}

	}
	$result->Close();

?>
<?}?>

<?if ($idtienda==1) {?>
		<fieldset class="checked">
			<div class="checkeds">
				<label for="">Le gustaria implementar proceso de ventas por internet para su empresa?</label>
				<input type="checkbox" value="1" name="dsimplementar">
			</div>

		</fieldset>
<?}?>
<?if ($idtienda==1) {?>
		<fieldset class="checked">
			<div class="checkeds">
				<label for="">Su empresa requiere?</label>

<?
    $sql="select dsm,id from tblt_requerimientos where idactivo=1 order by idpos asc";
    $result=$db->Execute($sql);
    if(!$result->EOF){
  	while(!$result->EOF){
        $dsm=reemplazar($result->fields[0]);
        $idrequerimiento=$result->fields[1];
?>

							<input type="checkbox" name="sel_requerimientos[]" value="<? echo $idrequerimiento; ?>">
							<label><? echo $dsm; ?></label>
<?
	$result->MoveNext();
	}
	}
	$result->Close();

?>



			</div>
		</fieldset>
<?}?>

<?if ($idtienda==1) {?>
<?
    $sql="select dsm,id from tbllenguajes where idactivo=1 order by idpos asc";
    $result=$db->Execute($sql);
    if(!$result->EOF){
?>


		<fieldset class="checked_info">
			<div class="checkeds">
				<label for="">Lenguaje preferido para recibir la informaci&oacute;n:</label>
			</div>
			<span class="camp_requerido" id="capax_" style="display:none;"></span>
		</fieldset>

<?
  	while(!$result->EOF){
        $dsm=reemplazar($result->fields[0]);
        $idlenguaje=$result->fields[1];
?>


		<fieldset class="checked2-1">
			<div class="checkeds">
							<input type="checkbox" name="sel_lenguaje[]" value="<? echo $idlenguaje; ?>">
								<label><? echo $dsm; ?></label>
			</div>
		</fieldset>


<?
	$result->MoveNext();
	}
	}
	$result->Close();
?>
<?}?>

<?if ($idtienda==1) {?>
		<fieldset class="checked_info">
			<div class="checkeds">
				<label for="">Desea recibir promociones y ofertas:</label>
			</div>
		</fieldset>

		<fieldset class="checked2-1">
			<div class="checkeds">
			<input type="checkbox" name="dsrecibirmovil" value="recibirmovil" ><label> Celular </label>			</div>
		</fieldset>

		<fieldset class="checked2-1">
			<div class="checkeds">
<input type="checkbox" name="dsrecibircorreo" value="recibircorreo"><label> E-Mail </label>			</div>
		</fieldset>

		<fieldset class="checked_info">
			<div class="checkeds">
				<label for="">Sus entregas las desea recibir en:</label>
			</div>
		</fieldset>

		<fieldset class="checked2-1">
			<div class="checkeds">
<input type="checkbox" name="dsdomicilio" value="domicilio" ><label> Su domicilio </label>			</div>
		</fieldset>

		<fieldset class="checked2-1">
			<div class="checkeds">
<input type="checkbox" name="dscounter" value="countermedellin"><label> Counter Medell&iacute;n </label>			</div>
		</fieldset>
<?}?>
		<fieldset class="checked_titulo">
			<h1>Categorias sobre las cuales desear&iacute;a recibir informaci&oacute;n</h1>
		</fieldset>

<?if ($idtienda==1) {?>
		<fieldset class="checked3 bg_gris">
			<div class="checkeds">
<input type="checkbox" name="dssoat" value="tienesoat"> <label>SOAT</label>			</div>

		</fieldset>

		<fieldset class="checked4 bg_gris">
			<div class="checkeds">
				<label for="">Fecha de vencimiento</label>
				<input type="text" name="dsfechavencimiento" id="dsfechavencimiento">
			</div>

		</fieldset>

		<fieldset class="checked4 bg_gris">
			<div class="checkeds">
				<label for="">Tipo de vehiculo</label>
				<input type="text" name="dstipovehiculo" id="dstipovehiculo">
			</div>
		</fieldset>
<?}?>
		<fieldset class="checked1 bg_gris">
			<div class="checkeds">
<input type="checkbox" name="dstiquetesn" value="tiquetesnacionales"> <label>Tiquetes nacionales</label>
			</div>
		</fieldset>

		<fieldset class="checked1 bg_gris">
			<div class="checkeds">
<input type="checkbox" name="dstiquetesi" value="tiquetesinternacionales"><label> Tiquetes internacionales </label>			</div>
		</fieldset>

		<fieldset class="checked1 bg_gris">
			<div class="checkeds">
<input type="checkbox" name="dspaques" value="parquesturisticos"> <label>Parques turisticos </label>			</div>

		</fieldset>

<?if ($idtienda<0) {?>
		<fieldset class="checked6 bg_gris">
			<div class="checkeds">
<input type="checkbox" name="dsviajero" value="viajerofrecuente"> <label>Viajero frecuente Avianca</label>
			</div>
		</fieldset>

		<fieldset class="checked5 bg_gris">
			<div class="checkeds">
<input type="checkbox" name="dsviajerootro" value="otroviajero"><label> Otro</label>			</div>

		</fieldset>

		<fieldset class="checked4 bg_gris">
			<div class="checkeds">
				<label for="">&nbsp;</label>
				<input type="text" name="dsnombreviajerootro" id="dsnombreviajerootro">
			</div>
		</fieldset>

		<fieldset class="checked4 bg_gris">
			<div class="checkeds">
				<label for="">#</label>
				<input type="text" name="dsnumeroviajerootro" id="dsnumeroviajerootro">
			</div>
			<span class="camp_requerido" id="capax_" style="display:none;"></span>
		</fieldset>
<?}?>


<?
    $sql="select dsm,id from tblcategoria where idactivo=1 order by idpos asc";
    $sql;
    $result=$db->Execute($sql);
    if(!$result->EOF){

  	while(!$result->EOF){
        $dsm=reemplazar($result->fields[0]);
        $idcategoria=$result->fields[1];
?>


		<fieldset class="checked2 bg_gris">
			<div class="checkeds">
								<input type="checkbox" name="sel_categoria[]" value="<? echo $idcategoria; ?>">
							<label><? echo $dsm; ?></label>
		</div>
		</fieldset>

<?
	$result->MoveNext();
	}
	}
	$result->Close();
?>



		<fieldset class="checked bg_gris">
			<div class="checkeds">
<input type="checkbox" name="otracategoria" value="otracategoria">				<label for="">Otro</label>
				<input type="text" name="dsotracategoria" id="dsotracategoria" >
			</div>
			<span class="camp_requerido" id="capax_" style="display:none;"></span>
		</fieldset>

		<fieldset class="checked_titulo1 bg_gris">
			<h3>¿Con qu&eacute; frecuencia desea recibir nuestro bolet&iacute;n de ofertas?</h3>
		</fieldset>

		<fieldset class="checked2 bg_gris">
			<div class="checkeds">
				<select name="dsrecibir" id="dsrecibir" onChange="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dsrecibir','')">
					<option value="">Seleccione</option>
					<option value="Semanal">Semanal</option>
					<option value="Quincenal">Quincenal</option>
					<option value="Mensual">Mensual</option>
					<option value="Catalogo Fisico / Tienda">Cat&aacute;logo F&iacute;sico / Tienda</option>
				</select>
			</div>
			<span class="camp_requerido" id="capax_dsrecibir" style="display:none;"></span>

		</fieldset>

		<fieldset class="checked">
			<div class="checkeds">
				<input type="checkbox" name="dscadavez" value="cadavez">
				<label for="">Cada vez que haya una oferta en las categor&iacute;as seleccionadas</label>
			</div>
		</fieldset>

		<fieldset class="checked">
			<div class="checkeds">
				<input type="checkbox" name="dsacepto" id="dsacepto" onclick="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_dsacepto','')">
			<label>Acepto <a href="?lightbox[width]=800&lightbox[height]=auto&lightbox[modal]=true#id_term_condiciones" class="lightbox btn_ayuda" title="Términos y Condiciones"><strong>los t&eacute;rminos y condiciones</strong>.</a></label>
			<span class="camp_requerido" style="display:none;" id="capax_dsacepto"><br><strong>Por favor acepte los Terminos y Condiciones</strong></span>
			</div>
			<span class="camp_requerido" id="capax_" style="display:none;"></span>
		</fieldset>
		</article>

		<fieldset class="btns">
			<input type="button" value="Enviar" class="ver_mas" onclick="valFormulario('<?echo $forma?>','<? echo $param?>',0,'','<? echo $rut ?>');">
			<!-- <input type="reset" value="Cancelar" class="btn_general"> -->
					<input type="hidden" name="idx" value="<? echo $id; ?>">
				        <input type="hidden" name="add" value="<? echo $add; ?>">
					    <input type=hidden name="entrar" value="<? echo $_REQUEST['entrar']?>">

		</fieldset>
	</form>
</article>
<?include('incluidos_sitio/terminoscondiciones/terminos.condiciones.php');?>

<article class="ven_terminos" id="ven_terminos" style="display:none;">
	<h2>Terminos y Condiciones</h2>
	<p>Lorem ipsum Veniam laborum proident ullamco amet do eiusmod sint enim voluptate mollit dolore fugiat sit enim voluptate labore in consectetur commodo sed quis dolor deserunt nulla quis ut fugiat veniam ut proident dolor labore id ut adipisicing minim do do officia qui aute elit qui adipisicing proident tempor ex labore eu sint amet sit cillum tempor sint ex consectetur enim amet officia eiusmod eiusmod sed esse officia anim dolore cillum esse elit mollit ullamco amet aute dolore non ea deserunt officia laborum enim velit laboris aute aliqua nisi deserunt exercitation in cillum minim esse velit mollit proident tempor consequat eiusmod dolor non cupidatat tempor ad pariatur aliquip esse magna quis do voluptate qui dolore Ut reprehenderit nostrud sit quis commodo sint ad minim pariatur Excepteur Excepteur esse enim laborum nulla ut incididunt nostrud in elit est do labore in est ad est amet officia exercitation tempor laboris proident velit laborum dolore in in qui dolore consequat quis et est commodo pariatur enim reprehenderit fugiat esse sit veniam in esse ut sit consequat quis id veniam nisi nostrud mollit aliqua tempor anim anim et ut non consectetur consequat velit commodo non elit sunt Duis eu sint pariatur velit nostrud quis nostrud anim elit proident dolore velit adipisicing velit dolor culpa sint consectetur voluptate aliqua enim dolor incididunt deserunt ut ut sunt occaecat amet Ut exercitation nostrud veniam pariatur Duis reprehenderit incididunt mollit est anim nulla ex commodo sit in magna incididunt qui nulla sint cupidatat dolore nostrud nostrud. Lorem ipsum Non amet Excepteur qui consectetur tempor id Ut esse commodo in officia ut eiusmod elit sint exercitation ex nisi culpa do veniam tempor dolor cupidatat dolore sunt ex est Ut sint aliquip dolor Ut incididunt est eu laborum fugiat cupidatat elit enim ex commodo nostrud Ut veniam culpa in tempor ad sunt Excepteur ut Duis nostrud consectetur exercitation veniam dolor pariatur cupidatat pariatur commodo officia Ut consequat ut nulla dolore aliquip ea elit officia eu Ut dolor dolore deserunt non Ut veniam in do magna labore ex nulla sunt laboris cupidatat voluptate veniam proident voluptate cupidatat adipisicing dolore sed do adipisicing cillum pariatur ad Ut in cupidatat nostrud esse nulla adipisicing proident irure est amet laborum magna eu pariatur velit deserunt Duis proident sed qui officia esse mollit fugiat et est ad in amet enim elit Ut velit cupidatat occaecat in dolore elit deserunt ut voluptate magna aliqua cillum nisi esse nulla esse fugiat amet tempor anim dolor reprehenderit enim id ut et Excepteur laboris Ut ullamco aliquip in nisi ea esse id veniam Excepteur consectetur dolor aute enim anim veniam nulla commodo voluptate proident tempor ad dolore proident aliquip pariatur tempor Duis aliqua nisi quis ex enim pariatur id in enim in ut.</p>
	<h3>Otro Titulo</h3>
	<p>Lorem ipsum Enim aliquip cupidatat adipisicing in officia in proident et ad deserunt consectetur ut enim do Duis fugiat ea minim officia nulla dolor laborum tempor do laboris exercitation do velit consectetur voluptate voluptate culpa officia Duis non eu irure ea elit anim veniam exercitation ut adipisicing ut esse sed non reprehenderit reprehenderit veniam nulla elit et dolore deserunt pariatur in et pariatur aute aliquip eu amet amet sunt dolor sit proident veniam in ut ea fugiat aliqua non velit velit reprehenderit elit dolor ut Duis nisi ullamco minim minim sunt irure proident mollit id fugiat fugiat aliqua pariatur adipisicing aliquip deserunt est pariatur non quis cillum qui nulla exercitation dolor pariatur commodo labore deserunt fugiat et ullamco veniam velit fugiat adipisicing voluptate magna laboris exercitation ut culpa dolore ullamco consequat nisi dolor elit officia nulla veniam nisi mollit in cupidatat nulla velit aliqua sed sunt culpa elit dolore non nisi aliqua id non Duis laborum esse laborum do do commodo anim minim ea irure veniam enim minim ut.</p>
</article>
