<?

$pasar=1; // muestra el inyecion pero lo deja pasar
//$revisar=1;
$rutx=1;
if($rutx==1) $rutxx="../";
include($rutxx."../../incluidos_modulos/modulos.globales.php");

$apagar=1;


$idx=$_REQUEST['idx'];
if($_REQUEST['idx']=="") $idx=$_REQUEST['idxx'];
$idgaleria=$_REQUEST['idgaleria'];
$r=$_REQUEST['r'];

//$rr="registros.php?idgaleria=$idgaleria&idxx=$idx";
$rr="listado.php";
$titulomodulo="Listado de formularios";

?>
<html>
		<?include($rutxx."../../incluidos_modulos/head.php");?>
<body>
<?
 include($rutxx."../../incluidos_modulos/navegador.principal.php");


$rutamodulo="<a href='$rutxx../../modulos/core/default.php?dstoken=$dstokenvalidador' class='textlink' title='Principal'>Principal</a>  /  ";
$rutamodulo.="  <a href='".$rr."' class='textlink'>$titulomodulo</a>  /  <span class='text1'>Vista previa de formularios</span>";
include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");

// select para encontrar el titulo del formulario

?>
<table width="100%" cellpadding="0" cellspacing="0" align="center"  class="cont_general">
  <tr>
    <td align="center" valign="top" style=" padding: 30px 0 0 0;">


<table width="70%" border="0" cellpadding="0" cellspacing="0" class="texto_centro" >
        <tr>
         	<td width="615" align="left" valign="middle">
        		<img src="<? echo $rutxx;?>../../img_modulos/modulos/edicion.png">
         		<h1>Ingreso de nuevo registro</h1>
         	</td>
        </tr>
</table>
<form action="../../validaciones/validar.formularios.php" method=post id="u" name=u>
<table align="center"  cellspacing="1" cellpadding="1" border="0" width=98% class="campos_ingreso">
<?
if($idx==104){
//$sql="select a.id,a.dsm from framecf_tbltiposformulariosxcamposxagrupamiento a where idactivo=1 and idformulario=$idx ";

$sql="select a.id,a.dsm from framecf_tbltiposformulariosxcamposxagrupamiento a,tblagrupamientoxtblformularios b where idactivo=1 ";
$sql.=" and a.id=b.idorigen group by a.dsm";
//echo $sql;
   $result=$db->Execute($sql);
   		if (!$result->EOF) {
?>

<tr>
	<td align="center" style="font-size:12">Seleccionar tipo</td>
	<td>
		<select name="agrupamiento" id="agrupamiento" style="width:100%" onchange="agrupamiento_campos('u');">
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

		<input type="hidden" name="idxx" value="104">

	</td>

<?

}
$result->Close();
}
?>



<?
 if($idx==104){

 $sql="select a.id,a.dsm from tblusuarios a where idactivo=1 ";

if($_SESSION['i_idperfil']<>1) $sql.=" and id=".$_SESSION['i_idusuario'];
//echo $sql;
   $result=$db->Execute($sql);
   		if (!$result->EOF) {
?>
		<td align="center" style="font-size:12">Asesor inmobiliario</td>
		<td>

		<? if($_SESSION['i_idperfil']==1){?>	<select style="width:100%" name="idusuario"> <option> -- Seleccionar -- </option><?}?>
<?
   			while(!$result->EOF) {
   				$id=$result->fields[0];
   				$dsm=$result->fields[1];
?>
			<? if($_SESSION['i_idperfil']==1){?><option value="<? echo $id;?>" <? if($_SESSION['i_idusuario']==$id)echo "selected='selected'";?> ><? echo $dsm;?></option> <?}?>
<?			 if($_SESSION['i_idperfil']<>1){?><input readonly="readonly" type="text" name="idusuario" value="<? echo $dsm;?>"> <?}?>


<?
$result->MoveNext();
}
?>
<? if($_SESSION['i_idperfil']==1){?></select> <?}?>
</td>
</tr>
<?

}
$result->close();

}

        $sql="select id,dsm,dsr,idactivo,idtipo from framecf_tbltiposformularios where id=$idx and idactivo=1";
        $result=$db->Execute($sql);
        if(!$result->EOF){
        	$idformulario=$result->fields[0];
			$dsmx=$result->fields[1];
			$tituloforma="Vista previa Formulario ( $dsmx ).";


// consulta para traer la informacion de los campos del formulario
$sqlx="select a.id,a.dsm,a.dsmensaje,a.idtipo,a.idoblig,a.idposn,a.dscampo,a.idminimo,a.idtipoformulario,a.idactivo,a.dsdes ";
$sqlx.="from framecf_tbltiposformulariosxcampo a ";
//if($_REQUEST['agrupamiento']<>"")
if($idx==104)$sqlx.=" inner join tblagrupamientoxtblformularios b";
$sqlx.=" where a.idtipoformulario='$idx' ";

//if($_REQUEST['agrupamiento']<>"")
if($idx==104)$sqlx.=" and a.id=b.iddestino and b.idorigen='".$_REQUEST['agrupamiento']."'";

$sqlx.=" and a.idactivo not in(2,9) ";
//if($_REQUEST['agrupamiento']=="" && $idx==104) $sqlx.=" and a.idoblig=1";

if($idx==104){
$sqlx.=" order by b.idpos asc";
} else{
$sqlx.=" order by a.idposn asc";
}
//exit();
//echo "<br>";
 //echo $sqlx;
 $resultx=$db->Execute($sqlx);
if(!$resultx->EOF){


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

if($contador==2)$contador=0;


$name=str_replace(" ", "_", $dsm);
$oblig="";
if ($idoblig==1) {
	$param.=$dsmcampo.",";
	$oblig=" * ";

}

	if($idtipo==1){ // input tipo texto
		$titulocampo="$dsm"." $oblig ";
		$campo="$dsmcampo";
		//$contadorx="counter_$campo";
		$tam=60;
		$valorx="255";
		$valormin="$idminimo";
		$formax="u";
		$campox="$campo";
		$nombre_capa="capa_$dsmcampo";
		$valorcampo=$_REQUEST[$dsmcampo];
		$mensaje_capa="$dsmensaje";
		$tipocampo=1;
		$descripcion=$dsdes;
		include($rutxx."../../incluidos_modulos/control.texto.form.php");
		$nombre_capa="capa_$dsmcampo";
		$mensaje_capa="Debe digitar la $dsmcampo";
	}

	if($idtipo==2){ // input tipo textarea
		$titulocampo="$dsm"." $oblig ";
		$campo="$dsmcampo";
		$valormin="$idminimo";
		//$contadorx="counter_$campo";
		$tam=60;
		$valorx="1000";
		$formax="u";
		$campox="$dsmcampo";
		$nombre_capa="capa_$dsmcampo";
		$valorcampo=$_REQUEST[$dsmcampo];
		$mensaje_capa="$dsmensaje";
		$tipocampo=2;
		$read="";
		$descripcion=$dsdes;
		include($rutxx."../../incluidos_modulos/control.texto.form.php");

	}

	if($idtipo==3){ // input tipo password
		$titulocampo="$dsm"." $oblig ";
		$campo="$dsmcampo";
		$valormin="$idminimo";
		//$contadorx="counter_$campo";
		$tam=60;$valorx="255";
		$formax="u";
		$campox="$campo";
		$nombre_capa="capa_$dsmcampo";
		$valorcampo=$_REQUEST[$dsmcampo];
		$mensaje_capa="$dsmensaje";
		$tipocampo=6;
		$descripcion=$dsdes;
		include($rutxx."../../incluidos_modulos/control.texto.form.php");


	}

	if($idtipo==4 && $dsmcampo<>"dscampo2"){ // campo tipo seleccionador

		$valores="";
		// consulta para listar los option del selecionador
		$sqlz="select a.id,a.dsm,a.idpos,a.idactivo,a.dsvalor from framecf_tbltiposformulariosxcampos a ";
		$sqlz.="where a.idactivo NOT IN(2,9) and a.idcampo=$id  ORDER BY a.idpos ASC ";
			//echo $sqlz;
		$resultz=$db->Execute($sqlz);
        if(!$resultz->EOF){
        $descripcion=$dsdes;
        $titulocampo="$dsm"." $oblig ";
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
		$valorcampo=$_REQUEST[$dsmcampo];
		$tipocampo=10;
		$nombre_capa="capa_$dsmcampo";
		$mensaje_capa="$dsmensaje";

		include($rutxx."../../incluidos_modulos/control.texto.form.php");
		//echo "<br>";

		     }
		$resultz->Close();
}

if($idtipo==5){ // input tipo texto
		$titulocampo="$dsm"." $oblig ";
		$campo="$dsmcampo";
		//$contadorx="counter_$campo";
		$tam=60;
		$valorx="255";
		$valormin="$idminimo";
		$formax="u";
		$campox="$campo";
		$nombre_capa="capa_$dsmcampo";
		$valorcampo=$_REQUEST[$dsmcampo];
		$mensaje_capa="$dsmensaje";
		$tipocampo=1;
		$descripcion=$dsdes;
		include($rutxx."../../incluidos_modulos/control.texto.form.php");
		$nombre_capa="capa_$dsmcampo";
		$mensaje_capa="Debe digitar la $dsmcampo";



	}

if($idtipo==9){ // campo tipo Checkbox
		$valores="";
		// consulta para listar los option del selecionador
		$sqlz="select a.id,a.dsm,a.idpos,a.idactivo,a.dsvalor from framecf_tbltiposformulariosxcampos a ";
		$sqlz.="where a.idactivo NOT IN(2,9) and a.idcampo=$id  ORDER BY a.idpos ASC ";
			//echo $sqlz;
		$resultz=$db->Execute($sqlz);
        if(!$resultz->EOF){
        $descripcion=$dsdes;
        $titulocampo="$dsm"." $oblig ";
		$campo="$dsmcampo";
		// este while recorreo los option del seleccionador
		$cont=1;
		 while(!$resultz->EOF){
		        $dsmx=$resultz->fields[1];
		        // aqui se pintan los valores de los option
				 $valores.="$cont-$dsmx;";

				$resultz->MoveNext();
				$cont=$cont+1;
     	}
		$valorcampo=$_REQUEST[$dsmcampo];
		$tipocampo=10;
		$nombre_capa="capa_$dsmcampo";
		$mensaje_capa="$dsmensaje";
		include($rutxx."../../incluidos_modulos/control.texto.form.php");
		echo "<br>";

		     }
		$resultz->Close();
}

if($idtipo==8){ // campo tipo Ciudades
		$valores="";
		$campobase=seldato("dscampo","idtipo","framecf_tbltiposformulariosxcampo",11,2);
		// consulta para listar los option del selecionador
		$sqlz="select a.id,a.dsm,a.idactivo from framecf_tbltiposformulariosxcampos a ";
		$sqlz.="where a.idactivo=1 and a.idcampo=$id ORDER BY a.dsm ASC ";
		//echo $sqlz;
		$resultz=$db->Execute($sqlz);
        if(!$resultz->EOF){

        $descripcion=$dsdes;
        $titulocampo="$dsm"." $oblig ";
		$campo="$dsmcampo";

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
		$valorcampo=$_REQUEST[$dsmcampo];
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
?>

<td align="center"><? echo $dsm?></td>
<td>
<select style="width:100%" name="<? echo $dsmcampo;?>" id="<? echo $dsmcampo;?>"   >
<option value=""> --- Seleccionar --- </option>
 </select>
 <?
$nombre_capa="capa_$dsmcampo";
$mensaje_capa="Seleccionar ciudad para ver barrios";
include($rutxx."../../incluidos_modulos/control.capa.php");
?>
</td>


<?
}

if($idtipo==7){ // campo tipo Departamentos
		$valores="";
		// consulta para listar los option del selecionador
		$sqlz="select a.id,a.dsm,a.idactivo from framecf_tbltiposformulariosxcampos a ";
		$sqlz.="where a.idactivo=1 and a.idcampo=$id ORDER BY a.dsm ASC ";
		//echo $sqlz;
		$resultz=$db->Execute($sqlz);
        if(!$resultz->EOF){

        $descripcion=$dsdes;
        $titulocampo="$dsm"." $oblig ";
		$campo="$dsmcampo";

		// este while recorreo los option del seleccionador
		$cont=1;
		 while(!$resultz->EOF){
		        $dsmciudad=$resultz->fields[1];
		        // aqui se pintan los valores de los option
				$valores.="$cont-$dsmciudad;";

				$resultz->MoveNext();
				$cont=$cont+1;
     	}
		$valorcampo=$_REQUEST[$dsmcampo];
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
		$sqlz="select a.id,a.dsm,a.idactivo from framecf_tbltiposformulariosxcampos a ";
		$sqlz.="where a.idactivo=1 and a.idcampo=$id ORDER BY a.dsm ASC ";
		//echo $sqlz;
		$resultz=$db->Execute($sqlz);
        if(!$resultz->EOF){

        $descripcion=$dsdes;
        $titulocampo="$dsm"." $oblig ";
		$campo="$dsmcampo";

		// este while recorreo los option del seleccionador
		$cont=1;
		 while(!$resultz->EOF){
		        $dsmciudad=$resultz->fields[1];
		        // aqui se pintan los valores de los option
				$valores.="$cont-$dsmciudad;";

				$resultz->MoveNext();
				$cont=$cont+1;
     	}
		$valorcampo=$_REQUEST[$dsmcampo];
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

$forma="u";
$botonmodificar=1;
?>




<tr bgcolor="#FFFFFF" >
  <td colspan=2>

<?
include($rutxx."../../incluidos_modulos/botones.modificar.php");
?>



</td>
</tr>


<?
//include($rutxx."../../incluidos_modulos/formas.remates.vistaprevia.php");

//include($rutxx."../../incluidos_modulos/html.remate.php");
}/*else{
	echo "<br>";
	echo "<h2>No hay campos a mostrar.</h2>";
	echo "<br>";
	//include($rutxx."../../incluidos_modulos/html.remate.php");
}*/
$resultx->Close();

}
$result->Close();
?>
<br>
<input type="hidden" name="idx" value="<? echo $_REQUEST['idx'];?>">
<input type="hidden" name="r" value="<? echo $r?>">
<input type="hidden" name="formulario" value="<? echo $idformulario;?>">
<input type="hidden" name="editar" value="<? echo $ideditar;?>">
<input type="hidden" name="idy" value="<? echo $idy;?>">
<input type="hidden" name="idagrupamiento" value="<? echo $_REQUEST['agrupamiento'];?>">
</form>

</table>
<br>

</td>
</tr>
</table>




<?
include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
include($rutxx."../../incluidos_modulos/modulos.remate.php");
?>


</body>
</html>

<script type="text/javascript">

	function agrupamiento_campos(valor){
		//alert("entra");
		if(document.u.agrupamiento.value!=""){
			//alert("entra");

			document.getElementById('u').action="formularios.vistaprevia.php";
			document.getElementById('u').submit();
		}

	}

</script>

