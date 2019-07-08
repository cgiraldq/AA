<article class="bloque_formularios" id="frm_<? echo $contador;?>" <? if($iddesplegable==1){?>style="display:none"<?}?> >
		<article class="txt_qsomos">
			<? if($pagina<>"consignar_clasificado.php" && $pagina<>"clasificados.gratis.php"){?>
			<h1><?echo nl2br(reemplazar($dsmx));?></h1>
			<?}?>
		</article>
		<? if($desc<>""){?><p><?echo nl2br(reemplazar($desc));?></p><?}?>

		<!-- se pinta el mapa de google o un video de youtube -->

		<?
		if($iframemappos==1 && $iframemap<>""){?>
		<article class="cont_frm_horizontal">
				<div><? echo $iframemap;?></div>
		</article>
		<?}

		?>

	<article class="cont_frm_tipo1">
		<form action="modulos/validaciones/validar.formularios.php" name="frm_<? echo $idformulario;?>" method="post" id="<? echo $idformulario;?>">

<?
$forma="frm_$idformulario";
// consulta para traer la informacion de los campos del formulario
$sqlx="select a.id,a.dsm,a.dsmensaje,a.idtipo,a.idoblig,a.idposn,a.dscampo,a.idminimo,a.idtipoformulario,a.idactivo,a.dsdes,a.dsmensaje ";
$sqlx.="from framecf_tbltiposformulariosxcampo a where a.idtipoformulario=$idformulario and a.idpublicar='1'";
$sqlx.=" and a.idactivo not in(2,9)";
$sqlx.=" order by a.idposn asc";
//echo $sqlx;
 $resultx=$db->Execute($sqlx);
if(!$resultx->EOF){ // inicio segundo if
	$param="";
while(!$resultx->EOF){

?>

<?
//$cantidad=$resultx->RecordCount();
$id=$resultx->fields[0];
$dsm=$resultx->fields[1];
$dsmcampo=($resultx->fields[6]);
$dsmensaje=$resultx->fields[2];
$idtipo=$resultx->fields[3];
$idoblig=$resultx->fields[4];
$idminimo=$resultx->fields[7];
$tipoformulario=$resultx->fields[8];
$dsdes=$resultx->fields[10];
$dsmensaje=$resultx->fields[11];

$name=str_replace(" ", "_", $dsm);
if ($idoblig==1) $param.=$dsmcampo.",";

	if($idtipo==1){ // input tipo texto
	?>
	<fieldset>
			<label for="<? echo $dsmcampo;?>"><? echo reemplazar($dsm); if ($idoblig==1){ echo "*";}?></label>
			<div><input type="text" <? if($dsmcampo=='dscampo3')echo 'maxlength=11';?>  name="<? echo $dsmcampo;?>" id="<? echo $dsmcampo;?>"  onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_<? echo $dsmcampo;?>','')"></div>
			<span class="camp_requerido" id="capax_<? echo $dsmcampo;?>" style="display:none;"><? echo $dsmensaje;?></span>
	</fieldset>

	<?

	} // fin input tipo texto

	if($idtipo==2){ // inicio campo tipo textarea
	?>
	<fieldset class="textarea">
			<label for="dscom">
			<label for="<? echo $dsmcampo;?>"><? echo reemplazar($dsm); if ($idoblig==1){ echo "*";}?></label>
			<div><textarea style="height: 80px;" cols="46" name="<? echo $dsmcampo;?>" id="<? echo $dsmcampo;?>"  onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_<? echo $dsmcampo;?>','')"></textarea></div>
			<span class="camp_requerido" id="capax_<? echo $dsmcampo;?>" style="display:none;"><? echo $dsmensaje;?></span>
	</fieldset>
	<?
	}// fin campo textarea

	if($idtipo==3){ // input tipo password
	?>
	<fieldset>
			<label for="<? echo $dsmcampo;?>"><? echo reemplazar($dsm); if ($idoblig==1){ echo "*";}?></label>
			<div><input type="password" name="<? echo $dsmcampo;?>" id="<? echo $dsmcampo;?>" tabindex="1" onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_<? echo $dsmcampo;?>','')"></div>
			<span class="camp_requerido" id="capax_<? echo $dsmcampo;?>" style="display:none;"><? echo $dsmensaje;?></span>
	</fieldset>
	<?


	}// fin input tipo pass


	if($idtipo==4){ // campo tipo seleccionador
		if($dsmcampo<>"dscampo2"){
		$valores="";
		// consulta para listar los option del selecionador
		$sqlz="select a.id,a.dsm,a.idpos,a.idactivo,a.dsvalor from framecf_tbltiposformulariosxcampos a ";
		$sqlz.="where a.idactivo NOT IN(2,9) and a.idcampo=$id  ORDER BY a.idpos ASC ";
		//echo $sqlz;
		$resultz=$db->Execute($sqlz);
        if(!$resultz->EOF){

       ?>
       <fieldset>
			<label for="dstipo"><? echo reemplazar($dsm); if ($idoblig==1){ echo "*";}?></label>
			<div>
				<select name="<? echo $dsmcampo;?>" id="<? echo $dsmcampo;?>"
					onclick="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_<? echo $dsmcampo;?>','')">
					<option value=""> --- Seleccionar --- </option>
       <?
		// este while recorreo los option del seleccionador
		$cont=1;
		 while(!$resultz->EOF){
		 		$idselect=$resultz->fields[0];
		        $dsmx=$resultz->fields[1];
		        // aqui se pintan los valores de los option
				?>
					<option value="<? echo $dsmx;?>" ><? echo reemplazar($dsmx);?></option>
				<?
				$resultz->MoveNext();
				$cont=$cont+1;
     	}
     	?>
			</select>
			</div>
			<span class="camp_requerido" id="capax_<? echo $dsmcampo;?>" style="display:none;"><? echo $dsmensaje;?></span>
		</fieldset>

     	<?

		     }
		$resultz->Close();
	}else{// fin condicional para saber si es tipo de propiedad
		$sql="select a.id,a.dsm from framecf_tbltiposformulariosxcamposxagrupamiento a,tblagrupamientoxtblformularios b where idactivo=1 ";
		$sql.=" and a.id=b.idorigen group by a.dsm";
//echo $sql;
   $result=$db->Execute($sql);
   		if (!$result->EOF) {
 ?>
  <fieldset>
  		<label for="dstipo">Seleccionar tipo<?if ($idoblig==1){ echo "*";}?></label>
  		<div>
  			<select name="idagrupamiento" id="idagrupamiento" style="width:100%">
  				<option value="0">-- Seleccionar --</option>
  				<? while (!$result->EOF) {
				$id=$result->fields[0];
				$dsm=$result->fields[1];
			?>

				<option value="<? echo $id;?>" <? if($id==$_REQUEST['agrupamiento']) echo "Selected";?> ><? echo reemplazar($dsm);?></option>
			<?
			$result->MoveNext();
			}
			?>
  			</select>
  		</div>
  </fieldset>
<?
	}
	$result->Close();
}

}


if($idtipo==5){ // input tipo email
	?>
	<fieldset>
			<label for="<? echo $dsmcampo;?>"><? echo reemplazar($dsm); if ($idoblig==1){ echo "*";}?></label>
			<div><input type="text" name="<? echo $dsmcampo;?>" id="<? echo $dsmcampo;?>"  onkeypress="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_<? echo $dsmcampo;?>','')"></div>
			<span class="camp_requerido" id="capax_<? echo $dsmcampo;?>" style="display:none;"><? echo $dsmensaje;?></span>
	</fieldset>

	<?

	} // input tipo email

if($idtipo==8){ // campo tipo Ciudades
		$valores="";

		$campobase=seldato("dscampo","idtipo","framecf_tbltiposformulariosxcampo",11,2);
		// consulta para listar los option del selecionador
		$sqlz="select a.id,a.dsm,a.idactivo from framecf_tbltiposformulariosxcampos a ";
		$sqlz.="where a.idactivo=1 and a.idcampo=$id ORDER BY a.dsm ASC ";
		 $sqlz;
		$resultz=$db->Execute($sqlz);
        if(!$resultz->EOF){
        	 ?>
       <fieldset>
			<label for="<? echo $dsmcampo;?>"><? echo reemplazar($dsm); if ($idoblig==1){ echo "*";}?></label>
			<div>
				<select name="<? echo $dsmcampo;?>" id="<? echo $dsmcampo;?>"
					onchange="validarbarrio('<? echo $dsmcampo;?>','<? echo $id;?>','<? echo $campobase;?>')">
					<option value=""> --- Seleccionar --- </option>
       <?

		$cont=1;
		 while(!$resultz->EOF){

		 		$idciudad=$resultz->fields[0];
		        $dsmciudad=$resultz->fields[1];
		        // aqui se pintan los valores de los option
				?>
					<option value="<? echo reemplazar($dsmciudad);?>" ><? echo reemplazar($dsmciudad);?></option>
				<?

				$resultz->MoveNext();
				$cont=$cont+1;
     	}
		?>
     	</select>
			</div>
			<span class="camp_requerido" id="capax_<? echo $dsmcampo;?>" style="display:none;"><? echo $dsmensaje;?></span>
		</fieldset>

     	<?
		     }
		$resultz->Close();
}


if($idtipo==11){ // campo tipo Barrios

?>
       <fieldset>
			<label for="<? echo $dsmcampo;?>"><? echo reemplazar($dsm); if ($idoblig==1){ echo "*";}?></label>
			<div>
				<select name="<? echo $dsmcampo;?>" id="<? echo $dsmcampo;?>" >
					<option value=""> --- Seleccionar --- </option>
     			</select>
			</div>
			<span class="camp_requerido" id="capax_<? echo $dsmcampo;?>" style="display:none;"><? echo $dsmensaje;?></span>
		</fieldset>
<?

} /// fin barrios


if($idtipo==7){ // campo tipo Departamentos
		$valores="";
		// consulta para listar los option del selecionador
		$sqlz="select a.id,a.dsm,a.idactivo from framecf_tbltiposformulariosxcampos a ";
		$sqlz.="where a.idactivo=1 and a.idcampo=$id  ORDER BY a.dsm ASC ";
		//echo $sqlz;
		$resultz=$db->Execute($sqlz);
        if(!$resultz->EOF){
        	?>
       <fieldset>
			<label for="<? echo $dsmcampo;?>"><? echo reemplazar($dsm); if ($idoblig==1){ echo "*";}?></label>
			<div>
				<select name="<? echo $dsmcampo;?>" id="<? echo $dsmcampo;?>"
					onclick="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_<? echo $dsmcampo;?>','')">
					<option value=""> --- Seleccionar --- </option>
       <?
		// este while recorreo los option del seleccionador
		$cont=1;
		 while(!$resultz->EOF){
		        $dsmdep=$resultz->fields[1];
		        // aqui se pintan los valores de los option
				?>
					<option value="<? echo reemplazar($dsmdep);?>"><? echo reemplazar($dsmdep);?></option>
				<?

				$resultz->MoveNext();
				$cont=$cont+1;
     	}
		?>
     	</select>
			</div>
			<span class="camp_requerido" id="capax_<? echo $dsmcampo;?>" style="display:none;"><? echo $dsmensaje;?></span>
		</fieldset>

     	<?

		     }
		$resultz->Close();
}

if($idtipo==6){ // campo tipo paises
		$valores="";
		// consulta para listar los option del selecionador
		$sqlz="select a.id,a.dsm,a.idactivo from framecf_tbltiposformulariosxcampos a ";
		$sqlz.="where a.idactivo=1 and a.idcampo=$id  ORDER BY a.dsm ASC ";
		//echo $sqlz;
		$resultz=$db->Execute($sqlz);
        if(!$resultz->EOF){
        	?>
       <fieldset>
			<label for="<? echo $dsmcampo;?>"><? echo reemplazar($dsm); if ($idoblig==1){ echo "*";}?></label>
			<div>
				<select name="<? echo $dsmcampo;?>" id="<? echo $dsmcampo;?>"
					onclick="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_<? echo $dsmcampo;?>','')">
					<option value=""> --- Seleccionar --- </option>
       <?

		// este while recorreo los option del seleccionador
		$cont=1;
		 while(!$resultz->EOF){
		        $dsmpais=$resultz->fields[1];
		        // aqui se pintan los valores de los option
				?>
					<option value="<? echo reemplazar($dsmpais);?>" ><? echo reemplazar($dsmpais);?></option>
				<?

				$resultz->MoveNext();
				$cont=$cont+1;
     	}
     	?>
     	</select>
			</div>
			<span class="camp_requerido" id="capax_<? echo $dsmcampo;?>" style="display:none;"><? echo $dsmensaje;?></span>
		</fieldset>

     	<?

		     }
		$resultz->Close();
}

if($idtipo==9){ // input tipo checkeBOX
	?>
	<fieldset class="checked">

			<div class="checkeds">
				<input type="checkbox" name="<? echo $dsmcampo;?>" id="<? echo $dsmcampo;?>"
				 onclick="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_<? echo $dsmcampo;?>','')">
				<label for="<? echo $dsmcampo;?>"><a href="#"> <? echo reemplazar($dsm); if ($idoblig==1){ echo "*";}?> </a></label>
			</div>
			<span class="camp_requerido" id="capax_<? echo $dsmcampo;?>" style="display:none;"><? echo $dsmensaje;?></span>
		</fieldset>
	<?


	}// fin input tipo checkeBOX

	if($idtipo==10){ // campo tipo RadioButtom
		$valores="";
		// consulta para listar los option del selecionador
		$sqlz="select a.id,a.dsm,a.idpos,a.idactivo,a.dsvalor from framecf_tbltiposformulariosxcampos a ";
		$sqlz.="where a.idactivo NOT IN(2,9) and a.idcampo=$id  ORDER BY a.idpos ASC ";
		//echo $sqlz;
		$resultz=$db->Execute($sqlz);
        if(!$resultz->EOF){
       ?>
<fieldset class="radio">
	<label><? echo reemplazar($dsm); if ($idoblig==1){ echo "*";}?></label>

       <?
		// este while recorreo los option del seleccionador
		$cont=1;
		 while(!$resultz->EOF){
		        $dsmradio=$resultz->fields[1];
		        // aqui se pintan los valores de los option
				?>
		<div class="radios">
			<input type="radio" name="<? echo $dsmcampo;?>" id="<? echo $dsmcampo;?>"
			onclick="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_<? echo $dsmcampo;?>','')">
			<label for="<? echo $dsmradio;?>"><? echo $dsmradio;?></label>
		</div>
				<?
				$resultz->MoveNext();
				$cont=$cont+1;
     	}
     	?>
			<span class="camp_requerido" id="capax_<? echo $dsmcampo;?>" style="display:none;"><? echo $dsmensaje;?></span>
</fieldset>

     	<?

		     }
		$resultz->Close();
} // fin campo tipo RadioButtom


?>



<?
$resultx->MoveNext();
     }
$param = trim($param,',');
$param;

?>
<?if($idterminos<>2){?>
<fieldset class="cont_politicas">
	<input name="politicas" id="politicas" type="checkbox" onclick="valFormulario('<?echo $forma?>','<? echo $param?>',1,'capax_politicas','')">
	<a href="<? echo $rutalocal;?>/info.frm.php?idform=<?echo $idformulario?>" class="terminos_condiciones"><p>POLÍTICA DE PROTECCIÓN DE DATOS</p></a>

	<span class="camp_requerido" id="capax_politicas" style="display:none;">Campo  obligatorio para poder continuar.</span>
</fieldset>
<?
 $param.=",politicas";
}?>


<?

if($idcaptcha<>2){
 include("incluidos_sitio/captcha.php");
 $param.=",captcha";
}

 ?>



		<fieldset class="botones_footer">

	<?$correo=seldato2("dscampo","idtipo","framecf_tbltiposformulariosxcampo",5,"idtipoformulario",$idformulario,2);?>
			<!--input type="reset" value="Cancelar" class="btn_cancelar"-->
			<input type="hidden" name="idx" value="<? echo $idformulario;?>">
			<input type="hidden" name="web" value="1">
			<input type="hidden" name="pagina" value="<? echo $pagina;?>">
			<? if($pagina=="zona.privada.php"){ $id=1;}else{ $id=2;}?>
			<input type="button" value="Enviar" class="btn_general"
			onclick="valFormulario('<?echo $forma;?>','<? echo $param;?>',0,'<? echo $correo;?>','<? echo $rutalocal."/"; ?>','<? echo $id;	?>');">
</fieldset>
</form>

</article>

<?

if($iframemappos==2 && $iframemap<>""){
?>
		<article class="cont_frm_horizontal">
				<div><? echo $iframemap;?></div>
		</article>
<?}

?>

<? 
if($idremate<>2){
include("incluidos_sitio/formularios/remate.form.php");
}

?>



</article>

<?


}else{
	echo "<br>";
	echo "<h2>No hay campos a mostrar.</h2>";
	echo "<br>";
}// fin segundo if
$resultx->Close();

?>
