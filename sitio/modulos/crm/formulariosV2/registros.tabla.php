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
	$listartodos=1;
	if($idxx==1)$papelera=5;
	$dsrutap="../crm/formularios/registros.php";
	$nombreform = seldato("dsm","id","framecf_tbltiposformularios",$_REQUEST['idxx'],2);
	include($rutxx."../../incluidos_modulos/modulos.buscador.php");
	include($rutxx."../../incluidos_modulos/paginar.variables.php");
	include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");
}
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

<table width="100%" border="0" cellpadding="0" cellspacing="0" class="texto_centro" >
        <tr>
         	<td align="left" valign="middle">
        		<img src="<? echo $rutxx;?>../../img_modulos/modulos/edicion.png">

                <h1>Listado de Registros del formulario <? echo $nombreform;?>                </h1>

<? if ($exportardatos<>1){?>
<input type="button" class="botones" value="Ingresar registro"onclick="irAPaginaD('formularios.vistaprevia.php?idx=<? echo $idxx;?>&idgaleria=<? echo $idgaleria;?>&r=99')">
<?}?>




         	</td>
        </tr>

</table>

<table width="100%" border="<? echo $border;?>" cellpadding="2" cellspacing="1" align="center" class="text1">

<form action="<? echo $pagina;?>" method=post name=p>


<?

 if($_REQUEST['idxx']==104)$user=",Clasificado gratis,Usuario asociado,Arrendatario";
 if($_REQUEST['idxx']==11)$user=",Usuario/Asesor";
$nombrecampos.="Fecha<br>creaci&oacute;n,Fecha<br> modificaci&oacute;n,Activo $user";
 $nombrecampos=trim($nombrecampos,',');
include($rutxx."../../incluidos_modulos/tabla.encabezado.php");
$contar=0;
	while (!$result->EOF && ($contar<$maxregistros)) {
		if ($contar%2==0) {
			$fondo=$fondo1;
		} else {
			$fondo=$fondo2;
		}
		?>

 		<tr bgcolor="<? echo $fondo?>" <? if ($exportardatos==1) { ?>onMouseOut="mOut(this,'<? echo $fondo;?>');"
 			onMouseOver="mOvr(this,'<? echo $fondo3;?>');" <? } ?>>

 		<td  align="center"> <? echo str_pad($result->fields[3],4,"0", STR_PAD_LEFT);?>
 			<?
 		if($idxx==11){
 			$camposval="";
 			$sqlval=" select dscampo from framecf_tbltiposformulariosxcampo where idoblig=1 and idtipoformulario='1' ";

				$resultxxy=$db->Execute($sqlval);
				if(!$resultxxy->EOF){
					$cont_campos=$resultxxy->fields[0];
				while(!$resultxxy->EOF){
					// se crea array con los campos de referencia del formulario
					$camposval.=$resultxxy->fields[0].",";

					$sqlxy="select $camposval $camposval1 from framecf_tblregistro_formularios where idformulario='$idx' ";

				$resultxxy->MoveNext();
				}
			}
			$resultxxy->Close();

			if($cont_campos<>""){
					$camposval=trim($camposval,",");
					$partir=explode(",",$camposval);
					// funcion para contar el total del array
					$cont=count($partir);
					$dsmform=seldato("dstabla","id","framecf_tbltiposformularios",$idxx,2);
					$sqlxy="select id,$camposval $camposval1 from $dsmform where id='".$result->fields[3]."'  ";
					//echo $sqlxy;
					for ($i=0; $i < $cont; $i++) {
					if($partir[$i]<>"dscampo31")	$sqlxy.=" and ".$partir[$i]."!='".$_REQUEST[$partir[$i]]."'  ";
					}
					//echo $sqlxy;
					$resultxy=$db->Execute($sqlxy);
						if(!$resultxy->EOF){
						$validar=$resultxy->fields[0];

					}else{
						echo "<img src='../../../images/no_doc.gif' align='absmiddle' title='Faltan campos obligatorios'>";
					}
				$resultxy->Close();

			}

		}// fin validar el formulario para pintar iconos de advertencia


		if($idxx==104){
			$sqlimg="SELECT idgaleria,idgaleriaoblig,dscantimagenes FROM  framecf_tbltiposformularios WHERE id='$idxx' AND idgaleria=1 AND idgaleriaoblig=1 ";
			//echo $sqlimg;
			$resultimg=$db->Execute($sqlimg);
				if(!$resultimg->EOF){
					$cantimg=$resultimg->fields[2];

					$sqlcant=" SELECT id FROM  framecf_tbltiposformulariosxgalerias WHERE idregistro='".$result->fields[3]."' ";
					//echo $sqlcant;
					$textoimagenes="";
					$resultcant=$db->Execute($sqlcant);
					$totalimagenes=0;
					if(!$resultcant->EOF){
						 $totalimagenes= $resultcant->RecordCount();
						 $textoimagenes=" (".$totalimagenes.")";
					}
					 if($totalimagenes<$cantimg){
					echo "<img src='../../../images/no_img.gif' align='absmiddle' title='Debe cargar al menos $totalimagenes por cada registro'>";
					 }

				$resultcant->Close();

			}
			$resultimg->Close();

		}// VALIDAR SI EL FORMULARIO ES DE PROPIEDADES
 			?>


 		</td>
<!-- //////////////////////////////////////////////////////////   Tipo    //////////////////////////////////////////////////////////////// -->

 		<!--td> 123<?//echo seldato("dsm","id"," framecf_tbltiposformulariosxcamposxagrupamiento",$result->fields[4],1);?></td-->
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
 			<?
 				for ($i=5; $i < $cantidad+5; $i++) {
			?>
				<td align="center"><? echo ellistr($result->fields[$i],100);?></td>
			<?}?>

		<td align="center">
			  <select name="idactivo_[]" class="textnegro">
				  <option value="1" <? if ($result->fields[0]==1) echo "selected";?>>SI</option>
				  <option value="2" <? if ($result->fields[0]==2) echo "selected";?>>NO</option>
				  <? if($idxx==104){?>
				  <option value="3" <? if ($result->fields[0]==3) echo "selected";?>>Destacado Home</option>
				  <option value="4" <? if ($result->fields[0]==4) echo "selected";?>>Destacado Lateral</option>
				  <?}?>
			  </select>
			  <input type="hidden" name="id_[]" value="<? echo $result->fields[3];?>">
		  </td>

<? if($_REQUEST['idxx']==104){?>
		 <td align="center">
			  <select name="clasgratis_[]" class="textnegro">

				  <option value="2" <? if ($result->fields[1]==2) echo "selected";?>>NO</option>
				  <option value="1" <? if ($result->fields[1]==1) echo "selected";?>>SI</option>
			  </select>
		  </td>
<?}?>

<?
if($_REQUEST['idxx']==104 || $_REQUEST['idxx']==11){
$sqle="select idusuario ";
$sqle.=" from framecf_tblregistro_formularios a where id=".$result->fields[3]."  and idformulario='$idxx'";
//echo $sqle;
$resulte=$db->Execute($sqle);
if (!$resulte->EOF) {
$iduser=$resulte->fields[0];
}
$resulte->close();

 $sql="select a.id,a.dsm from tblusuarios a where idactivo not in (2,9) ";
 if($_SESSION['i_idperfil']<>1) $sql.=" and id='".$result->fields[2]."'";
   $resultx=$db->Execute($sql);
   		if (!$resultx->EOF) {
?>


		<td align="center">

		<? if($_SESSION['i_idperfil']==1){?>	<select name="idusuario_[]" id="idusuario"> <?}?>
		<? if($_SESSION['i_idperfil']==1){?>	<option>--Seleccionar --</option>		<?}?>
<?
   			while(!$resultx->EOF) {
   				$id=$resultx->fields[0];
   				$dsm=$resultx->fields[1];

?>
			<? if($_SESSION['i_idperfil']==1){?><option value="<? echo $id;?>" <? if($iduser==$id)echo "selected='selected'";?> ><? echo $dsm;?></option> <?}?>
	<? if($_SESSION['i_idperfil']<>1){?><input readonly="readonly" type="hidden" name="idusuario_[]" value="<? echo $id;?>"> <input readonly="readonly" type="text" name="dsusuario_[]" value="<? echo $dsm;?>"> <?}?>

<?
$resultx->MoveNext();
}
?>
<? if($_SESSION['i_idperfil']==1){?></select> <?}?>
</td>

<?

}else{
	if($_SESSION['i_idperfil']<>1){
?>
<td align="center">
	<input  readonly="readonly" type="text" name="" value="NO ASOCIADO">
</td>
<?
}

}
$resultx->close();
}
?>



<?
if($_REQUEST['idxx']==104){
////////////////////////// listado de arrendatarios /////////////////////////////////
$sqle="select idarrendatario ";
$sqle.=" from framecf_tblregistro_formularios a where id=".$result->fields[3]."  and idformulario=$idxx";
//echo $sqle;
$resulte=$db->Execute($sqle);
if (!$resulte->EOF) {
$idarrendatario=$resulte->fields[0];

}
$resulte->close();

 $sql="select a.id,a.dscampo3,dscampo5 from framecf_tblregistro_formularios a where idactivo=1 and idformulario=1 ";
 //$echo $
 if($_SESSION['i_idperfil']<>1) $sql.=" and id='".$result->fields[2]."'";
 //echo $sql;
   $resultx=$db->Execute($sql);
   		if (!$resultx->EOF) {
?>
		<td align="center">
		<? if($_SESSION['i_idperfil']==1){?>	<select name="idarrendatario_[]" id="idarrendatario"> <?}?>
		<? if($_SESSION['i_idperfil']==1){?>	<option>--Seleccionar --</option>		<?}?>
<?
   			while(!$resultx->EOF) {
   				$id=$resultx->fields[0];
   				$dsm=$resultx->fields[1]." ".$resultx->fields[2];

?>
			<? if($_SESSION['i_idperfil']==1){?><option value="<? echo $id;?>" <? if($id==$idarrendatario)echo "selected='selected'";?> ><? echo $dsm;?></option> <?}?>
	<? if($_SESSION['i_idperfil']<>1){?><input readonly="readonly" type="text" name="idusuario_[]" value="<? echo $id;?>"> <input readonly="readonly" type="text" name="dsusuario_[]" value="<? echo $dsm;?>"> <?}?>

<?
$resultx->MoveNext();
}
?>
<? if($_SESSION['i_idperfil']==1){?></select> <?}?>
</td>

<?

}else{
	if($_SESSION['i_idperfil']<>1){
?>
<td align="center">
	<input  readonly="readonly" type="text" name="" value="NO ASOCIADO">
</td>
<?
}

}
$resultx->close();

}
?>



<? if ($exportardatos=="") { ?>

		  <td align="center">

<? if($idxx==1){?>
<a class="botones2" href="javascript:irAPaginaDN('formulario.ver.cliente.php?idy=<? echo $result->fields[3]; ?>&dstabla=<? echo $dsmform;?>')" type="imprimir">Ver</a>
<?}?>

<? if($idxx==1){?>
<a class="botones2" href="javascript:irAPaginaDN('../vendedor/reportes.php?id=<? echo $result->fields[3]; ?>')" type="imprimir" title="Click para vwer las gestiones realizadas al cliente seleccionado">Resumen</a>
<?}?>
		  		<?
			  $rutaeditar="registros.editar.php";
			  $rutax=$rutaeditar."?idx=".$idxx."&idy=".$result->fields[3]."&idgaleria=".$_REQUEST["idgaleria"];
			  $formax="";
			  $mrutax="Editar";
			  $clase="botones2";
			  include($rutxx."../../incluidos_modulos/enlace.generico.php");
			  ?>

			<?
			  $rutaeditar="registros.editar.php";
			  $rutax=$rutaeditar."?idx=".$idxx."&idy=".$result->fields[3]."&abrirgaleria=1&idgaleria=".$_REQUEST["idgaleria"];
			  $formax="";
			  $mrutax="Imagenes ".$textoimagenes;
			  $clase="botones2";
			  include($rutxx."../../incluidos_modulos/enlace.generico.php");
			  ?>

			   <? if ($idxx==104) {?>

			  <?
			  }


if($idxx==1){
        $sql=" SELECT a.id,a.dsm FROM  framecf_tbltiposformularios a, tblrelacionesxtblformularios b WHERE a.id=b.iddestino";
        $resultx = $db->Execute($sql);
        if (!$resultx->EOF) {
          while(!$resultx->EOF) {
            $idf=$resultx->fields[0];
            $dsm=$resultx->fields[1];

            $ruta="../formularios/formularios.vistaprevia.php?idx=$idf&idcliente=".$result->fields[3];
           ?>

<input type=button name=enviar value="<? echo $dsm;?>"  class="botones2" onClick="irAPaginaD('<? echo $ruta;?>');">

           <?

            $resultx->MoveNext();
          }

        }
        $resultx->Close();

} // fin valicar formulario clientes

			  if($_SESSION['i_idusuario']==$result->fields[2] || $_SESSION['i_idperfil']==1){

			  $rutax=$pagina."?idx=".$result->fields[3]."&idxx=".$_REQUEST["idxx"]."&idgaleria=".$_REQUEST["idgaleria"];
			  $formax="";
			  include($rutxx."../../incluidos_modulos/enlace.eliminar.php");

			}
			  ?>


		  </td>
<? } ?>
		</tr>




		<?
		$contar++;
		$result->MoveNext();
	} // fin while
	if ($exportardatos<>1){

?>
<tr>
	<td colspan=10 align="center">
<input type=submit name=enviar value="Modificar datos"  class="botones">
<input type="hidden" name="idx" value="<? echo $_REQUEST['idx'];?>">
<input type="hidden" name="idxx" value="<? echo $_REQUEST['idxx'];?>">
<input type="hidden" name="idgaleria" value="<? echo $_REQUEST['idgaleria'];?>">
<input type=button name=enviar value="Regresar"  class="botones" onClick="irAPaginaD('listado.php')">

</td>
</tr>
</form>
</table>
<?
		include($rutxx."../../incluidos_modulos/paginar.php");

}

	}
	 // fin si
$result->Close();


?>

