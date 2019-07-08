<?

$pasar=1; // muestra el inyecion pero lo deja pasar
$db->debug=true;
//$revisar=1;
$rutx=1;
if($rutx==1) $rutxx="../";
include($rutxx."../../incluidos_modulos/modulos.globales.php");

$apagar=1;
$titulomodulo="Listado de reportes del CRM ";

$idx=$_REQUEST['idx'];
$idy=$_REQUEST['idy'];
$msn=$_REQUEST['msn'];

if($msn==3) $error=0; $mensajes=$men[4];

$idgaleria=$_REQUEST['idgaleria'];

$rr="reporte.propiedades.php?idxx=104&param=".$_REQUEST['param']."&campo=".$_REQUEST['campo']."&idarrendador=".$_REQUEST['idarrendador']."&propietario=".$_REQUEST['propietario']."&reporte=".$_REQUEST['reporte']."";

?>
<html>
	<?include($rutxx."../../incluidos_modulos/head.php");?>


<body>

	<? include($rutxx."../../incluidos_modulos/navegador.principal.php");

$rutamodulo="<a href='$rutxx../../modulos/core/default.php?dstoken=$dstokenvalidador' class='textlink' title='Principal'>Principal</a>  /  ";
$rutamodulo.="  <a href='reporte.propiedades.php?idxx=104&param=".$_REQUEST['param']."&campo=".$_REQUEST['campo']."&idarrendador=".$_REQUEST['idarrendador']."&propietario=".$_REQUEST['propietario']."&reporte=".$_REQUEST['reporte']."' class='textlink'>$titulomodulo</a>  /  <span class='text1'>Modificar</span>";
include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");

// select para encontrar el titulo del formulario




        $sql="select id,dsm,dsr,idactivo,idtipo from framecf_tbltiposformularios where id=$idx and idactivo=1";
        //echo $sql;
        $result=$db->Execute($sql);
        if(!$result->EOF){
        	$idformulario=$result->fields[0];
		$dsmx=$result->fields[1];

$id_agrupamiento=seldato("idagrupamiento","id"," framecf_tblregistro_formularios ",$_REQUEST['idy'],2);
$agrupamiento=$_REQUEST['agrupamiento'];
if($agrupamiento=="" && $agrupamiento<>"0" && $id_agrupamiento<>"" && $id_agrupamiento<>0) $agrupamiento=$id_agrupamiento;
// consulta para traer la informacion de los campos del formulario
$sqlx="select a.id,a.dsm,a.dsmensaje,a.idtipo,a.idoblig,a.idposn,a.dscampo,a.idminimo,a.idtipoformulario,a.idactivo,a.dsdes";
$sqlx.=" from framecf_tbltiposformulariosxcampo a";
if($agrupamiento<>"") $sqlx.=" inner join tblagrupamientoxtblformularios b";
$sqlx.=" where a.idtipoformulario=$idx";

if($agrupamiento<>"") $sqlx.=" and a.id=b.iddestino and b.idorigen='".$agrupamiento."'";
$sqlx.=" and idactivo not in(2,9)";
if($agrupamiento=="") $sqlx.=" and a.idoblig=1";

if($_REQUEST['agrupamiento']<>""){
		$sqlx.=" order by b.idpos asc";
} else{
	$sqlx.=" order by a.idposn asc";
}
//echo $sqlx;
 $resultx=$db->Execute($sqlx);
if(!$resultx->EOF){


include($rutxx."../../incluidos_modulos/encabezado.editar.php");
?>



<table align="center" id="detalle" cellspacing="1" cellpadding="5" border="0" width="98%" class="campos_ingreso" style="display:none">
<?
if($idx==104){
$sql="select a.id,a.dsm from framecf_tbltiposformulariosxcamposxagrupamiento a where idactivo=1 ";
//echo $sql;
   $result=$db->Execute($sql);
   		if (!$result->EOF) {
?>
<form name="agrupamiento" id="agrupamiento" action="registros.editar.php" method="POST">
<tr>
	<td align="center" style="font-size:12">Agrupamiento de campos</td>
	<td>
		<select name="agrupamiento" idusuario="agrupamiento" style="width:100%" onchange="agrupamiento_campos('agrupamiento');">
			<option value="0">-- Seleccionar --</option>
			<? while (!$result->EOF) {
				$id=$result->fields[0];
				$dsm=$result->fields[1];
			?>

				<option value="<? echo $id;?>" <? if($id==$_REQUEST['agrupamiento'] || $id==$id_agrupamiento) echo "Selected";?> ><? echo reemplazar($dsm);?></option>
			<?
			$result->MoveNext();
			}
			?>
		</select>
	</td>

<input type="hidden" name="idx" value="<? echo $idx?>">
<input type="hidden" name="idy" value="<? echo $idy?>">
</form>
<?
$result->Close();
}

}
?>
<form action="../../validaciones/validar.formularios.php" method=post name=u enctype="multipart/form-data">

<?
if($idx==104){
$sqle="select idusuario ";
$sqle.=" from framecf_tblregistro_formularios a where id=$idy  and idformulario='$idx'";
//echo $sqle;
$resulte=$db->Execute($sqle);
if (!$resulte->EOF) {
$iduser=$resulte->fields[0];
}
$resulte->close();

 $sql="select a.id,a.dsm from tblusuarios a where idactivo=1";
 if($_SESSION['i_idperfil']<>1) $sql.=" and id=$iduser";
   $result=$db->Execute($sql);
   		if (!$result->EOF) {

?>


		<td align="center" style="font-size:12">Usuario asociado</td>
		<td>
		<?if($_SESSION['i_idperfil']==1){?>	<select name="idusuario" style="width:100%" id="idusuario"><?}?>
<?
   			while(!$result->EOF) {
   				$idusuario=$result->fields[0];
   				$dsm=$result->fields[1];
?>
			<?if($_SESSION['i_idperfil']==1){?><option value="<? echo $id;?>" <? if($iduser==$idusuario)echo "selected='selected'";?> ><? echo $dsm;?></option><?}?>
			<?if($_SESSION['i_idperfil']<>1){?><input readonly="readonly" type="text" name="idusuario" value="<? echo $dsm;?>"> <?}?>

<?
$result->MoveNext();
}
?>
	<?if($_SESSION['i_idperfil']==1){?></select><?}?>
		</td>
	</tr>
<?

}
$result->close();

}

$param="";
$contador=0;
while(!$resultx->EOF){
$id=$resultx->fields[0];
$dsm=$resultx->fields[1];
$dsmcampo=($resultx->fields[6]);
$dsmensaje=$resultx->fields[2];
$idtipo=$resultx->fields[3];
$idoblig=$resultx->fields[4];
$idminimo=$resultx->fields[7];
$dsdes=$resultx->fields[10];

$campoe=$dsmcampo;
$sqle="select ";
if($dsmcampo<>"")$sqle.="$campoe";
//$sql.=",a.dscampo2,a.dscampo3,a.dscampo4,a.dscampo5,a.dscampo6,a.dscampo7,a.dscampo8,a.dscampo9";
$sqle.=" from framecf_tblregistro_formularios a where id=$idy  and idformulario='$idx'";
//echo $sqle;
$resulte=$db->Execute($sqle);
$valorcampoe=$resulte->fields[0];


if ($idoblig==1) $param.=$dsmcampo.",";


	if($idtipo==1){ // input tipo texto
		$titulocampo="$dsm";
		$campo="$dsmcampo";
		//$contadorx="counter_$campo";
		$tam=60;
		$valorx="255";
		$valormin="$idminimo";
		$formax="u";
		$campox="$campo";
		$nombre_capa="capa_$dsmcampo";
		if($dsmcampo==$campoe){
			$valorcampo="$valorcampoe";
		}

		$mensaje_capa="$dsmensaje";
		$tipocampo=1;
		$descripcion=$dsdes;
		include($rutxx."../../incluidos_modulos/control.texto.form.php");
	}

	if($idtipo==2){ // input tipo textarea
		$titulocampo="$dsm";
		$campo="$dsmcampo";
		$valormin="$idminimo";
		//$contadorx="counter_$campo";
		$tam=60;
		$valorx="1000";
		$formax="u";
		$campox="$dsmcampo";
		$nombre_capa="capa_$dsmcampo";
		if($dsmcampo==$campoe){
			$valorcampo="$valorcampoe";
		}
		$mensaje_capa="$dsmensaje";
		$tipocampo=2;
		$read="";
		$descripcion=$dsdes;
		include($rutxx."../../incluidos_modulos/control.texto.form.php");

	}

	if($idtipo==3){ // input tipo password
		$titulocampo="$dsm";
		$campo="$dsmcampo";
		$valormin="$idminimo";
		//$contadorx="counter_$campo";
		$tam=60;$valorx="255";
		$formax="u";
		$campox="$campo";
		$nombre_capa="capa_$dsmcampo";
		if($dsmcampo==$campoe){
			$valorcampo="$valorcampoe";
		}
		$mensaje_capa="$dsmensaje";
		$tipocampo=6;
		$descripcion=$dsdes;
		include($rutxx."../../incluidos_modulos/control.texto.form.php");


	}

	if($idtipo==4){ // campo tipo seleccionador
		$valores="";
		// consulta para listar los option del selecionador
		$sqlz="select a.id,a.dsm,a.idpos,a.idactivo,a.dsvalor from ".$prefix."tbltiposformulariosxcampos a ";
		$sqlz.="where a.idactivo NOT IN(2,9) and a.idcampo=$id  ORDER BY a.idpos ASC ";
//		echo $sqlz;
		$resultz=$db->Execute($sqlz);
        if(!$resultz->EOF){

        $descripcion=$dsdes;
        $titulocampo="$dsm";
		$campo="$dsmcampo";

		// este while recorreo los option del seleccionador
		$cont=1;
		 while(!$resultz->EOF){

		 		$idselect=$resultz->fields[0];
		        $dsmx=$resultz->fields[1];
		        // aqui se pintan los valores de los option
				$valores.="$dsmx-$dsmx;";

				$resultz->MoveNext();
				$cont=$cont+1;
     	}
		if($dsmcampo==$campoe){
			$valorcampo="$valorcampoe";
		}
		$tipocampo=10;
		$nombre_capa="capa_$dsmcampo";
		$mensaje_capa="$dsmensaje";

		include($rutxx."../../incluidos_modulos/control.texto.form.php");



		     }
		$resultz->Close();
}

if($idtipo==5){ // input tipo texto
		$titulocampo="$dsm";
		$campo="$dsmcampo";
		//$contadorx="counter_$campo";
		$tam=60;
		$valorx="255";
		$valormin="$idminimo";
		$formax="u";
		$campox="$campo";
		$nombre_capa="capa_$dsmcampo";
		if($dsmcampo==$campoe){
			$valorcampo="$valorcampoe";
		}

		$mensaje_capa="$dsmensaje";
		$tipocampo=1;
		$descripcion=$dsdes;
		include($rutxx."../../incluidos_modulos/control.texto.form.php");
	}

if($idtipo==8){ // campo tipo Ciudades
		$valores="";

		$campobase=seldato("dscampo","idtipo","framecf_tbltiposformulariosxcampo",11,2);
		// consulta para listar los option del selecionador
		$sqlz="select a.id,a.dsm,a.idpos,a.idactivo,a.dsvalor from ".$prefix."tbltiposformulariosxcampos a ";
		$sqlz.="where a.idactivo=1 and a.idcampo=$id ORDER BY a.dsm ASC ";
		//echo $sqlz;
		$resultz=$db->Execute($sqlz);
        if(!$resultz->EOF){

        $descripcion=$dsdes;
        $titulocampo="$dsm";
		$campo="$dsmcampo";

		$ciudad="$dsmcampo";


		// este while recorreo los option del seleccionador
		$cont=1;
		 while(!$resultz->EOF){

		 		$idciudad=$resultz->fields[0];
		        $dsmciudad=$resultz->fields[1];
		        // aqui se pintan los valores de los option
				$valores.="$dsmciudad-$dsmciudad;";

				$resultz->MoveNext();
				$cont=$cont+1;
     	}
		if($dsmcampo==$campoe){
			$valorcampo="$valorcampoe";
		}
		$tipocampo=11;
		$nombre_capa="capa_$dsmcampo";
		$mensaje_capa="$dsmensaje";

		$ajaxx="validarbarrio1('".$dsmcampo."','".$id."','".$campobase."')";

		include($rutxx."../../incluidos_modulos/control.texto.form.php");
		echo "<br>";


		     }
		$resultz->Close();
}


if($idtipo==11){ // campo tipo barrios
	if($dsmcampo==$campoe){
			$valorcampo="$valorcampoe";
		}

?>
<script type="text/javascript">
	validarbarrio1('<? echo $ciudad;?>','<? echo $id;?>','<? echo $campobase;?>','<? echo $valorcampo;?>');
</script>

<tr valign=top bgcolor="#FFFFFF">
<td align="center" style="font-size:12"><? echo $dsm?></td>
<td>
<select style="width:100%" name="<? echo $dsmcampo;?>" id="<? echo $dsmcampo;?>" >

 </select>
</td>
</tr>

<?
}



if($idtipo==7){ // campo tipo Departamentos
		$valores="";
		// consulta para listar los option del selecionador
		$sqlz="select a.id,a.dsm,a.idactivo from ".$prefix."tbltiposformulariosxcampos a ";
		$sqlz.="where a.idactivo=1 and a.idcampo=$id  ORDER BY a.dsm ASC ";
		//echo $sqlz;
		$resultz=$db->Execute($sqlz);
        if(!$resultz->EOF){

        $descripcion=$dsdes;
        $titulocampo="$dsm";
		$campo="$dsmcampo";

		// este while recorreo los option del seleccionador
		$cont=1;
		 while(!$resultz->EOF){
		        $dsmciudad=$resultz->fields[1];
		        // aqui se pintan los valores de los option
				$valores.="$dsmciudad-$dsmciudad;";

				$resultz->MoveNext();
				$cont=$cont+1;
     	}
		if($dsmcampo==$campoe){
			$valorcampo="$valorcampoe";
		}
		$tipocampo=10;
		$nombre_capa="capa_$dsmcampo";
		$mensaje_capa="$dsmensaje";

		include($rutxx."../../incluidos_modulos/control.texto.form.php");
		echo "<br>";


		     }
		$resultz->Close();
}

if($idtipo==6){ // campo tipo paises
		$valores="";
		// consulta para listar los option del selecionador
		$sqlz="select a.id,a.dsm,a.idactivo from ".$prefix."tbltiposformulariosxcampos a ";
		$sqlz.="where a.idactivo=1 and a.idcampo=$id  ORDER BY a.dsm ASC ";
		//echo $sqlz;
		$resultz=$db->Execute($sqlz);
        if(!$resultz->EOF){

        $descripcion=$dsdes;
        $titulocampo="$dsm";
		$campo="$dsmcampo";

		// este while recorreo los option del seleccionador
		$cont=1;
		 while(!$resultz->EOF){
		        $dsmciudad=$resultz->fields[1];
		        // aqui se pintan los valores de los option
				$valores.="$dsmciudad-$dsmciudad;";

				$resultz->MoveNext();
				$cont=$cont+1;
     	}
		if($dsmcampo==$campoe){
			$valorcampo="$valorcampoe";
		}
		$tipocampo=10;
		//$param=substr($param,1,strlen($param));
		$nombre_capa="capa_$dsmcampo";
		$mensaje_capa="$dsmensaje";

		include($rutxx."../../incluidos_modulos/control.texto.form.php");
		echo "<br>";


		     }
		$resultz->Close();
}

$resultx->MoveNext();
$contador++;
     }

$param = trim($param,',');
//echo $param;
$forma="u";
$botonmodificar=1;
$ideditar=1;
$idy;
$idx;
?>
<input type="hidden" name="idx"  value="<? echo $_REQUEST["idx"];?>">
<input type="hidden" name="idy"  value="<? echo $_REQUEST["idy"];?>">
<input type="hidden" name="idgaleria"  value="<? echo $_REQUEST["idgaleria"];?>">
<input type="hidden" name="editar"  value="1">
<input type="hidden" name="idagrupamiento"  value="<? echo $_REQUEST['agrupamiento'];?>">
<tr>
<td align="center" colspan="4">
<?




}else{
	echo "No hay campos a mostrar.";
}
$resultx->Close();

}
$result->Close();
?>



<input type=button name=enviar value="Regresar"  class="botones" onClick="irAPaginaD('<? echo $rr?>')">


</td>
</tr>

</td>
</tr>
</table>
</form>
</td>
</tr>

<tr id="galeria" style="display:none" >
	<td><? include('formulario.galeria.php'); ?></td>
</tr>

<tr id="observaciones" style="display:none" >
	<td><? include('formulario.observaciones.php'); ?></td>
</tr>
</table>





<?
		include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
		include($rutxx."../../incluidos_modulos/modulos.remate.php");
?>

</body>
</html>



<script type="text/javascript">

function Abrir_capa(parametro){


	if(parametro=="detalle"){
  		document.getElementById(parametro).style.display='';
  		document.getElementById('galeria').style.display='none';
  		document.getElementById('observaciones').style.display='none';
  	}

  	if(parametro=="galeria"){
  		document.getElementById(parametro).style.display='';
  		document.getElementById('detalle').style.display='none';
  		document.getElementById('observaciones').style.display='none';
  	}

  	if(parametro=="observaciones"){
  		document.getElementById(parametro).style.display='';
  		document.getElementById('detalle').style.display='none';
  		document.getElementById('galeria').style.display='none';
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

		if(document.agrupamiento.elements[valor].value!=0){
			//alert("entra");
			document.getElementById(valor).submit();
		}

	}



</script>