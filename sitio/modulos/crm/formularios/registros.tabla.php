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
?>
<?

}
	//$tablax=$prefix."tbltiposformularios";


     $result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
	if (!$result->EOF) {


$border=0;
if ($exportardatos==1) $border=1;
?>


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
                <h1>Listado de Registros del formulario <? echo $nombreform;?></h1>
         	</td>
         	<td>
			<nav class="nav_derecha">
				<input type="button" class="botones" value="Ingresar registro"onclick="irAPaginaD('formularios.vistaprevia.php?idx=<? echo $idxx;?>&idgaleria=<? echo $idgaleria;?>&r=99')">
			</nav>
         	</td>
        </tr>
</table>


<table width="100%" border="<? echo $border;?>" cellspacing="1" align="center" class="text1">

<form action="<? echo $pagina;?>" method=post name=p>


<?

 if($_REQUEST['idxx']==104)$user=",Clasificado gratis,Usuario asociado,Arrendatario";
 if($_REQUEST['idxx']==11)$user=",Usuario/Asesor";
$nombrecampos.="Fecha<br>creaci&oacute;n,Fecha<br> modificaci&oacute;n,Activo $user";
if($idxx==52)$nombrecampos.=" ,Estado ";
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

 		<td  align="center">

			<?
				if($idxx==1)
				{

					$contarprefe = seldato('count(preferencia_asociada)','cliente_asociado','crm_prefencias_por_clientes',$result->fields[3],1);

					$sqlCAMP="select campaa_asociada from crm_campa_por_cliente where cliente_asociado = '".$result->fields[3]."' group by campaa_asociada ";
					$contarcampa=0;
					$resultCONCAMP=$db->Execute($sqlCAMP);
					if(!$resultCONCAMP->EOF)
					{
						while(!$resultCONCAMP->EOF)
						{
							$contarcampa++;

						$resultCONCAMP->MoveNext();
						}

					}
					$resultCONCAMP->Close();


					if($contarprefe<=0)
					{
						echo "<span style='color:#E04A49'>PEFERENCIAS</span> <br/>";
					}else
					{
						echo "<span style='color:#E04A49'>PEFERENCIAS (".$contarprefe.") </span> <br/>";
					}
					if($contarcampa<=0)
					{
						echo "<span style='color:#44B6AE'>CAMPA&Ntilde;AS</span><br/>";
					} else
					{
						echo "<span style='color:#44B6AE'>CAMPA&Ntilde;AS (".$contarcampa.")</span><br/>";
					}
				}
				else
				{
					echo str_pad($result->fields[3],4,"0", STR_PAD_LEFT);
				}

 			$idcodpro=$result->fields[3];
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

if($_REQUEST['idxx']==52)
{

		$fechafin=seldato("fecha_final_de_publicacion","id","crm_productos_y_servicios",$idcodpro,1);

        $fechahoy = date("Y/m/d");
        $porciones = explode("/", $fechafin);

        //defino fecha 1
        $ano1 = $porciones[0];
        $mes1 = $porciones[1];
        $dia1 = $porciones[2];
        $porciones2 = explode("/", $fechahoy);

        //defino fecha 2
        $ano2 = $porciones2[0];
        $mes2 = $porciones2[1];
        $dia2 = $porciones2[2];

        //calculo timestam de las dos fechas
        $timestamp1 = mktime(0,0,0,$mes1,$dia1,$ano1);
        $timestamp2 = mktime(4,12,0,$mes2,$dia2,$ano2);


        //resto a una fecha la otra
        $segundos_diferencia = $timestamp1 - $timestamp2;

        //echo $segundos_diferencia;

        //convierto segundos en días
        $dias_diferencia = $segundos_diferencia / (60 * 60 * 24);

        //obtengo el valor absoulto de los días (quito el posible signo negativo)
        //quito los decimales a los días de diferencia
        $dias_diferencia = ceil($dias_diferencia);

        if($dias_diferencia==0){

         $dias_diferencia = abs($dias_diferencia);

        }

        //echo $dias_diferencia;

        ?>
        <? if($dias_diferencia<=5) {?>

       	  <td align="center" style="color:red;"><? echo str_replace("-", "", $dias_diferencia); ?> Dias

       	  	<?

       	  	if ($dias_diferencia<=0){ ?>
          	<span style="color:red;">Vencido</span>
          	<? } else{ ?>
          	<span style="color:red;">Proximo a vencer</span>
          	<? }?>
          </td>

          <? } else {?>
          	<td>
          	<span class="txt_rojo"></span>
          </td>
         <? }
}

?>

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





<? if ($exportardatos=="") { ?>

		  <td align="center">

<? if($idxx==1){?>
<a class="btn_detalle" href="javascript:irAPaginaDN('formulario.ver.cliente.php?idy=<? echo $result->fields[3]; ?>&dstabla=<? echo $dsmform;?>')" type="imprimir">Ver</a>
<?}?>

<? if($idxx==1){?>
<a class="btn_detalle" href="javascript:irAPaginaDN('../vendedor/reportes.php?id=<? echo $result->fields[3]; ?>')" type="imprimir" title="Click para ver las gestiones realizadas al cliente seleccionado">Resumen</a>
<a class="btn_detalle" href="javascript:irAPaginaDN('formulario.preferencias.php?idy=<? echo $result->fields[3]; ?>&dstabla=<? echo $dsmform;?>')" type="imprimir" title="Click para ver las preferencias del cliente">Preferencias</a>
<a class="btn_detalle" href="javascript:irAPaginaDN('formulario.docs.php?idy=<? echo $result->fields[3]; ?>&dstabla=<? echo $dsmform;?>')" type="imprimir" title="Click para ver las preferencias del cliente">Asociar documentos</a>
<?}?>
		  		<?
			  $rutaeditar="registros.editar.php";
			  $rutax=$rutaeditar."?idx=".$idxx."&idy=".$result->fields[3]."&idgaleria=".$_REQUEST["idgaleria"];
			  $formax="";
			  $mrutax="Editar";
			  $clase="btn_detalle";

			/*$rutaeditar="registros.editar.php";
			  $rutax=$rutaeditar."?idx=".$idxx."&idy=".$result->fields[3]."&abrirgaleria=1&idgaleria=".$_REQUEST["idgaleria"];
			  $formax="";
			  $mrutax="Imagenes ".$textoimagenes;
			  $clase="botones2";*/

			  if ($idxx<>0) include($rutxx."../../incluidos_modulos/enlace.generico.php");

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

			if($_REQUEST['idxx']==52)
			{
				$dir=1;
			?>

					<input type=button name=enviar value="Preferencias" class="btn_detalle" onClick="irAPaginaD('../productos/preferenciasproductos.php?tabla=crm_productos_y_servicios&dir=<? echo $dir;?>&idcampo=<? echo $idcodpro;?>');">
					<input type=button name=enviar value="Galeria" class="btn_detalle" onClick="irAPaginaD('../productos/galeria.php?tabla=crm_productos_y_servicios&dir=<? echo $dir;?>&idcampo=<? echo $idcodpro;?>');">
					<input type=button name=enviar value="Precios" class="btn_detalle" onClick="irAPaginaD('../productos/precios.php?tabla=crm_productos_y_servicios&dir=<? echo $dir;?>&idcampo=<? echo $idcodpro;?>');">
					<input type=button name=enviar value="Planes" class="btn_detalle" onClick="irAPaginaD('../productos/destinos.php?tabla=crm_productos_y_servicios&dir=<? echo $dir;?>&idcampo=<? echo $idcodpro;?>');">
					<input type=button name=enviar value="Actividades" class="btn_detalle" onClick="irAPaginaD('../productos/actividades.php?tabla=crm_productos_y_servicios&dir=<? echo $dir;?>&idcampo=<? echo $idcodpro;?>');">

					<input type=button name=enviar value="Categor&iacute;a" class="btn_detalle" onClick="irAPaginaD('../productos/categoriaproductos.php?tabla=crm_productos_y_servicios&dir=<? echo $dir;?>&idcampo=<? echo $idcodpro;?>');">

					<input type=button name=enviar value="Subcategor&iacute;as" class="btn_detalle" onClick="irAPaginaD('../productos/subcategorias.php?tabla=crm_productos_y_servicios&dir=<? echo $dir;?>&idcampo=<? echo $idcodpro;?>');">
					<input type=button name=enviar value="Hoteles" class="btn_detalle" onClick="irAPaginaD('../productos/hoteles.php?tabla=crm_hoteles&dir=<? echo $dir;?>&idcampo=<? echo $idcodpro;?>');">
					<input type=button name=enviar value="Destinos" class="btn_detalle" onClick="irAPaginaD('../productos/destinos.php?tabla=crm_destinos&dir=<? echo $dir;?>&idcampo=<? echo $idcodpro;?>');">

			<?
			}
			if($_REQUEST['idxx']==94)
			{
			?>
				<input type="button" name="enviar" value="Filtrar" class="btn_detalle" onClick="irAPaginaD('../campanas/filtros.php?idcampana=<? echo $result->fields[3]; ?>');">
			<?
			$contarmail=seldato('count(id)','1','crm_mailing','1 and idactivo not in (2,9)',1);
			if($contarmail>0){
			 ?>
			<input type="button" value="Mail" class="btn_detalle" class="" onclick="irAPaginaDN('../../crm/campanas/filtros.enviar.mail.php?idcampana=<? echo $result->fields[3]; ?>')" >
			<input type="button" value="Campa&ntilde;a telefonica" class="btn_detalle" onclick="irAPaginaD('../../crm/campanas/filtros.campana.telefonica.php?idcampana=<? echo $result->fields[3]; ?>&reg=1');" >
			<a href="../../validaciones/filtros.exportar.csv.php?idcampana=<? echo $result->fields[3]; ?>" class="btn_detalle" target="_blank">Descargar Archivo</a>
			<a style="cursor:pointer" class="btn_detalle" onclick="javascript:alert('Por favor configurar propiedades.');" target="_blank">Redes Sociales</a>
			<?
				}
			}
			if($_REQUEST['idxx']==98)
			{
				?>
				<input type="button" value="Preguntas" class="btn_detalle" onclick="irAPaginaD('../../crm/campanas/filtros.preguntas.encuesta.php?idencuesta=<? echo $result->fields[3]; ?>')" >
			<?
			}

			if($_REQUEST['idxx']==54)
			{

				$rutax="../productos/hoteles.galeria.php?idc=".$idcodpro;
				$trutax="Click para ingresar a la galeria";
				$mrutax="Galeria";
				include($rutxx."../../incluidos_modulos/enlace.generico.php");

			}
			?> | <?

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
</table>
	<nav class="nav_centro">
		<input type=submit name=enviar value="Modificar datos"  class="botones">
		<input type="hidden" name="idx" value="<? echo $_REQUEST['idx'];?>">
		<input type="hidden" name="idxx" value="<? echo $_REQUEST['idxx'];?>">
		<input type="hidden" name="idgaleria" value="<? echo $_REQUEST['idgaleria'];?>">
		<input type=button name=enviar value="Regresar"  class="botones" onClick="irAPaginaD('listado.php')">
	</nav>
</form>
<?
		include($rutxx."../../incluidos_modulos/paginar.php");

}

	}
	 // fin si
$result->Close();


?>

