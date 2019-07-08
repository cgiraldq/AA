<?
/*
| ----------------------------------------------------------------- |
CF-informer
Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c) 2000 - 2013
Medellin - Colombia
=====================================================================
  Autores:
  Juan Fernando Fernández <consultorweb@comprandofacil.com> - Proyectos
  Juan Felipe Sánchez <graficoweb@comprandofacil.com> - Diseñoframecf_tbltiposformulariosxgalerias
  José Fernando Peña <soporteweb@comprandofacil.com> - Mercadeo
=====================================================================
| ----------------------------------------------------------------- |
*/
// principal
$rutx=1;
if($rutx==1) $rutxx="../";
//include($rutxx."../../incluidos_modulos/modulos.globales.php");

$idy=$_REQUEST['idy'];
$idx=$_REQUEST['idx'];


$tabla="framecf_tbltiposformulariosxgalerias";
	$rutaImagen=$rutxx."../../../contenidos/images/galeria/";
// eliminacion
//include($rutxx."../../incluidos_modulos/modulos.papelera.php");
// insercion
// cambio de proceswo
// se genera x cantidad de fotos
//$db->debug=true;
if ($_REQUEST['finalizar']=="1"){

	// proceso de carga de datos
			$contarx=count($_REQUEST['sel']);
		$h=0;

			for ($j=0;$j<$contarx;$j++){
					$valorarchivox="archivo_".$j;
					$valorarchivorenombrado="archivorenombrado_".$j;
					$archivobase=$_REQUEST[$valorarchivox];
					$archivocambiado=$_REQUEST[$valorarchivorenombrado];
					if ($archivobase<>"") {
						// validando nombre de archivo 
						$nombrearchivo=str_replace(" ","_",$archivobase);
						$archivovalido=limpiar_carateres($nombrearchivo);
						$nombreimagen=$nombrearchivo;
						if ($archivocambiado<>""){
							$nombrearchivo=$archivocambiado;
							$nombrearchivo=str_replace(" ","_",$nombrearchivo);
							$archivovalido=$archivocambiado."_".limpiar_carateres($nombrearchivo);
						}	
						//$archivovalido=$j."_".$archivovalido;
						$idactivox="idactivo_".$j;
						$idactivo=$_REQUEST[$idactivox];
						//echo $_REQUEST['dirbase']."".$archivovalido;
						if (is_file($_REQUEST['dirbase']."".$archivobase)) {
							// copiar el archivo
							if (!copy($_REQUEST['dirbase']."".$archivobase, $rutaImagen.$archivovalido)) {
 								//echo "Error al copiar $archivobase...<br>";
							}else {
								//echo "archivo copiado con exito";
							}
						$sql="delete  ";
					 	$sql.=" from $tabla WHERE dsm='$nombrearchivo' and idregistro='$idy' and idtipoformulario='$idx' ";
						$db->Execute($sql);
						//echo $sql."<br>";
						// insertar 

						$sql="insert into $tabla (dsm,idpos,idactivo,idregistro,idtipoformulario,dsimg)";
						$sql.=" values ('$nombrearchivo','$j','$idactivo','$idy','$idx','$archivovalido') ";
						$db->Execute($sql);

						//echo $sql."<br>";
						// mover archivo a la ruta correspondiente
						// borrar archivo de la fuente
						unlink($_REQUEST['dirbase']."".$archivobase);
						}
					}

			}	
	// eliminacion de datos

}	

for ($i=1;$i<=$dscantimagenesm;$i++) {

	$valor="dsm_".$i;
	$valor1="dsimg_".$i;
	$dsm=$_REQUEST[$valor];
	if ($dsm=="") {
		$dsvalor1=$_FILES[$valor1]["name"];
		$dsm=$i."_".$dsvalor1;
	}

if ($dsm<>"") {
		$sql="select id ";
	 	$sql.=" from $tabla WHERE dsm='$dsm' and idregistro='$idy' and idtipoformulario='$idx' ";
	 	//echo $sql;
		 $result = $db->Execute($sql);
		 if (!$result->EOF) {
		 	// no insertar
			$mensajes=$men[0];
			$error=1;
		 } else {
		 	// insertar
		 	$tmp_name = $_FILES[$valor1]["tmp_name"];
			$name = $i."_".$_FILES[$valor1]["name"];
			 move_uploaded_file($tmp_name,$rutaImagen.$name);


			$sql="insert into $tabla (dsm,idpos,idactivo,idregistro,idtipoformulario,dsimg)";
			$sql.=" values ('$dsm','$idpos','$idactivo','$idy','$idx','$name') ";
			//echo $sql;
			if ($db->Execute($sql))  {
				$mensajes="<strong>".$men[1]."</strong>";
				// cargar auditoria
				$error=0;
				$dstitulo="Insercion $titulomodulo";
				$dsdesc=" El usuario ".$_SESSION['i_dslogin']." Ingreso un nuevo registro de banner";

				include($rutxx."../../incluidos_modulos/logs.php");
			} else {
				$mensajes=$men[2].".<br><br>$sql";
				$error=1;
			}
		 }
		 $result->close();
}

} // fin form

// eliminar
if ($_REQUEST['idxx']<>""){
$sql=" delete from $tabla ";
$sql.= " where id=".$_REQUEST['idxx'].";";
//echo $sql;
if ($db->Execute($sql)) $error=0;$mensajes=$men[3];

}


// modificacion rapida
		$contarx=count($_REQUEST['id_']);
		$h=0;

			for ($j=0;$j<$contarx;$j++){

				if ($_REQUEST['id_'][$j]<>""){

				$sql=" update $tabla set ";
					$sql.= "idactivo=".$_REQUEST['idactivo_'][$j];
					$sql.= ",dsm='".$_REQUEST['dsm_'][$j]."'";
					//echo $nombre=$_REQUEST['dsimg_'][$j];

			       $tmp_name = $_FILES["dsimg_"]["tmp_name"][$j];
			        $name = $_FILES["dsimg_"]["name"][$j];
			        move_uploaded_file($tmp_name,$rutaImagen.$name);
			       if($name<>"")  unlink($rutaImagen.$_REQUEST['imagenes_'][$j]);
			       if($name=="") $name=$_REQUEST['imagenes_'][$j];

					$sql.=",dsimg='".$name."'";
					//$sql.= ",idpos=".$_REQUEST['idpos_'][$j]."";
					$sql.= " where id=".$_REQUEST['id_'][$j].";";
					//echo $sql;
					if ($db->Execute($sql)) $h++;
				} // fin si
			} // fin for
		if ($h>0) $mensajes=$men[4];


 include($rutxx."../../incluidos_modulos/modulos.mensajes.php");

// generacion del encabezado de acuerdo a los resultados encontrados
$sql="select a.id,a.dsm,a.idpos,a.idactivo,a.dsimg,a.idtipo from $tabla a where idactivo not in(9) ";
$sql.=" and idregistro='".$_REQUEST['idy']."'";
$sql.=" and idtipoformulario='".$_REQUEST['idx']."'";
$sql.=" order by a.idpos asc ";



//echo $sql;

$result=$db->Execute($sql);
	if (!$result->EOF) {
		$rutamodulo="<a href='$rutxx../core/default.php' class='textlink' title='Principal'>Principal</a>  /  ";
		$rutamodulo.=" <span class='text1'>".$titulomodulo."</span>";
				$papelera=2;
				$campocondicion="idregistro";
				$condicion=$idy;
				$dsrutaPapelera="papelera.php";//ruta de la papelera

		//include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");
		include("formulario.galeria.tabla.php");
		//include($rutxx."../../incluidos_modulos/paginar.php");
	} // fin si
	$result->Close();

//	if ($enca=="") include("ingreso.galeria.php");
	if ($enca=="") include("formulario.galeria.ingreso.php");

	?>

