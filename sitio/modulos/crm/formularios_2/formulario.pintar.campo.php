<?
$id=$resultx->fields[0];
$dsm=$resultx->fields[1];
 $dsmcampo=($resultx->fields[6]);
$dsmensaje=$resultx->fields[2];
$idtipo=$resultx->fields[3];
$idoblig=$resultx->fields[4];
$idminimo=$resultx->fields[7];
$dsdes=$resultx->fields[10];
if($contador==2)$contador=0;

$oblig="";
$campoe=$dsmcampo;
$sqle="select ";
if($dsmcampo<>"")$sqle.="$campoe";
//$sql.=",a.dscampo2,a.dscampo3,a.dscampo4,a.dscampo5,a.dscampo6,a.dscampo7,a.dscampo8,a.dscampo9";
$sqle.=" from framecf_tblregistro_formularios a where id='".$_REQUEST['idy']."'  and idformulario='".$_REQUEST['idx']."' ";
$resulte=$db->Execute($sqle);

if(!$resulte->EOF){
$valorcampoe=$resulte->fields[0];
}

if($_REQUEST['idx']==104 and $_REQUEST['idcliente']<>""){
$valorcampoe="";
		if($dsmcampo=='dscampo14'){$valorcampoe=seldato("dscampo3","id","framecf_tblregistro_formularios",$_REQUEST['idcliente'],2);}
		if($dsmcampo=='dscampo15'){$valorcampoe=seldato("dscampo15","id","framecf_tblregistro_formularios",$_REQUEST['idcliente'],2);}
		if($dsmcampo=='dscampo17'){$valorcampoe=seldato("dscampo10","id","framecf_tblregistro_formularios",$_REQUEST['idcliente'],2);}
		if($dsmcampo=='dscampo16'){$valorcampoe=seldato("dscampo8","id","framecf_tblregistro_formularios",$_REQUEST['idcliente'],2); }
}


if ($idoblig==1) {
	$param.=$dsmcampo.",";
	$oblig=" * ";
}

	if($idtipo==1){ // input tipo texto
		$titulocampo="$dsm"." $oblig ";
		$campo="$dsmcampo";
		$contadorx="counter_$campo";
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
		$titulocampo="$dsm"." $oblig ";
		$campo="$dsmcampo";
		$valormin="$idminimo";
		//$contadorx="counter_$campo";
		$tam=60;$valorx="255";
		$formax="u";
		$campox="$campo";
		$nombre_capa="capa_$dsmcampo";
		if($dsmcampo==$campoe){
			$valorcampo="$valorcampoe";
			$valorcampo = $rc4->decrypt($s3m1ll4, urldecode($valorcampo));
		}
		$mensaje_capa="$dsmensaje";
		$tipocampo=6;
		$descripcion=$dsdes;
		include($rutxx."../../incluidos_modulos/control.texto.form.php");
	}

	if($idtipo==4){ // campo tipo seleccionador
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

		if($dsmcampo==$campoe){
			 $valorcampo="$valorcampoe";
		}
		$tipocampo=10;
		$nombre_capa="capa_$dsmcampo";
		$mensaje_capa="$dsmensaje";
		include($rutxx."../../incluidos_modulos/control.texto.form.php");
		//echo "<br>";
		     }
		$resultz->Close();
}

if($idtipo==5){ // input tipo texto email
		$titulocampo="$dsm"." $oblig ";
		$campo="$dsmcampo";
		$contadorx="counter_$campo";
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
		$nombre_capa="capa_$dsmcampo";
		$mensaje_capa="Debe digitar la $dsmcampo";
	}

if($idtipo==9){ // campo tipo Checkbox
		$valores="";
		// consulta para listar los option del selecionador
		$sqlz="select a.id,a.dsm,a.idpos,a.idactivo from framecf_tbltiposformulariosxcampo a ";
		$sqlz.="where a.idactivo NOT IN(2,9) and a.id=$id  ORDER BY a.idpos ASC ";
			//echo "<br><br>";
			//echo $sqlz;
		$resultz=$db->Execute($sqlz);
        if(!$resultz->EOF){
        $descripcion=$dsdes;
        $titulocampo="$dsm"." $oblig ";
		$campo="$dsmcampo";
		$cont=1;

		if($dsmcampo==$campoe){
			$valorcampo="$valorcampoe";
		}
		$tipocampo=9;
		$nombre_capa="capa_$dsmcampo";
		$mensaje_capa="$dsmensaje";
		include($rutxx."../../incluidos_modulos/control.texto.form.php");
		//echo "<br>";

		     }
		$resultz->Close();
}

if($idtipo==8){ // campo tipo Ciudades
		$valores="";
		$campobase=seldato("dscampo","idtipo","framecf_tbltiposformulariosxcampo",11,2);
		$campobase2=seldato("dscampo","idtipo","framecf_tbltiposformulariosxcampo",12,2);
		// consulta para listar los option del selecionador
		$sqlz="select a.id,a.dsm,a.idactivo,a.idcampo from framecf_tbltiposformulariosxcampos a ";
		$sqlz.="where a.idactivo in(1,3) and a.idcampo=$id ORDER BY a.dsm ASC ";
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
		        $idactivo=$resultz->fields[3];
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
		$ajaxx="validarbarrio1('".$dsmcampo."','".$id."','".$campobase."','".$idactivo."','".$campobase2."','../../../')";
		include($rutxx."../../incluidos_modulos/control.texto.form.php");
		     }
		$resultz->Close();


}



if($idtipo==11){ // campo tipo barrios
if($dsmcampo==$campoe){
			$valorcampo="$valorcampoe";
		}
?>
<script type="text/javascript">
	validarbarrio2('dscampo93','404','dscampo27','<? echo $idy?>','','../../../');
</script>
<tr>
<td style="font-size:12px" align="center"><? echo $dsm;?></td>
<td>
<select style="width:100%" name="<? echo $dsmcampo;?>" id="<? echo $dsmcampo;?>"   >
<option value=""> --- Seleccionar --- </option>
 </select>
 <?
$tipocampo=12;
$nombre_capa="capa_$dsmcampo";
$mensaje_capa="$dsmensaje";

include($rutxx."../../incluidos_modulos/control.capa.php");
?>
</td>
</tr>

<?
}

if($idtipo==12){ // campo tipo zonas
if($dsmcampo==$campoe){
		 $valorcampo="$valorcampoe";
		}
?>
<script type="text/javascript">
	validarbarrio1('<? echo $campo;?>','<? echo $id;?>','<? echo $campobase;?>','<? echo $valorcampo;?>','<? echo $campobase2; ?>','../../../');
</script>
<td style="font-size:12px" align="center"><? echo $dsm;?></td>
<td>
<select  onchange="validarbarrio2('<? echo $dsmcampo;?>','<? echo $resultx->fields[0]?>','dscampo27','','','../../../')" style="width:100%" name="<? echo $dsmcampo;?>" id="<? echo $dsmcampo;?>"   >
<option value=""> --- Seleccionar --- </option>
 </select>
 <?
$tipocampo=12;
$nombre_capa="capa_$dsmcampo";
$mensaje_capa="$dsmensaje";

include($rutxx."../../incluidos_modulos/control.capa.php");
?>
</td>


<?
}

if($idtipo==13){ // input tipo texto



$titulocampo="$dsm"." $oblig ";
		$campo="$dsmcampo";
		$contadorx="counter_$campo";
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
		$tipocampo=13;
		$descripcion=$dsdes;
		include($rutxx."../../incluidos_modulos/control.texto.form.php");
		$nombre_capa="capa_$dsmcampo";
		$mensaje_capa="Debe digitar la $dsmcampo";



	}

if($idtipo==14){ // input tipo texto
		$titulocampo="$dsm"." $oblig ";
		$campo="$dsmcampo";
		$contadorx="counter_$campo";
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
		$tipocampo=14;
		$descripcion=$dsdes;
		include($rutxx."../../incluidos_modulos/control.texto.form.php");
		$nombre_capa="capa_$dsmcampo";
		$mensaje_capa="Debe digitar la $dsmcampo";
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
// fin de pintar campos

?>
