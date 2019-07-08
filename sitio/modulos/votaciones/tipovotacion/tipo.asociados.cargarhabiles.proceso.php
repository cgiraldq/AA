<?
/*
| ----------------------------------------------------------------- |
CF-informer
Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c) 2000 - 2009
Medellin - Colombia
=====================================================================
  Autores:
  Juan Fernando Fernández <consultorweb@comprandofacil.com> - Proyectos
  Juan Felipe Sánchez <graficoweb@comprandofacil.com> - Diseño
  José Fernando Peña <soporteweb@comprandofacil.com> - Mercadeo
=====================================================================
| ----------------------------------------------------------------- |
*/
// principal
// proceso de validacion contra la tabla de usuarios del informer41_feisa

// leer de archivo de excel los campos para generar el vector

				if ($_FILES['dsimg1']['name']<>"") {
				// borrar anterior
				$archivoanterior=$_REQUEST['archivoanterior1'];
				if (is_file($rutaImagen.$archivoanterior)) unlink($rutaImagen.$archivoanterior);
				$temp_name = $_FILES['dsimg1']['tmp_name'];
				$nombre1=$tabla."asociados-".date("his")."-1.".substr($_FILES['dsimg1']['name'],-3);
				move_uploaded_file($temp_name,$rutaImagen.$nombre1);
				} elseif ($_REQUEST['img1']<>"") {
				$nombre1=$_REQUEST['img1'];
				}

$sql="select a.idafiliacion,a.cedula,a.nombre1,a.nombre2,a.apellido1,a.apellido2,a.estado,a.email,a.telefono1,";
$sql.=" a.celular,c.idzonaelectoral,c.nombrezonaelectoral,a.codasociado ";
$sql.=" from asociados a, zonaselectoralesxasociadofeisa b,  zonaselectoralesfeisa c, tblidnitsxdscedula d ";
$sql.=" where d.cedulasociado=a.cedula and d.idnits=b.idnits and c.idzonaelectoral=b.idzonaelectoral ";
//echo $sql;
//exit();




if($nombre1<>""){
		$xfecha=date("Y/m/d h:i:s a");
			if (!$file=fopen($rutaImagen.$nombre1,"r+")){
				$valido=="NO";
			} else {


				$totaldatos=0;
				// cargando funcion de clase de lectura de excel
				require_once 'phpexcel/PHPExcel/IOFactory.php';
				require_once 'phpexcel/PHPExcel/IComparable.php';
				require_once 'phpexcel/PHPExcel/Style/NumberFormat.php';
				$Objdata = PHPExcel_IOFactory::load($rutaImagen.$nombre1);
				// abrir el archivo
				$data=$Objdata->getActiveSheet()->toArray();
				$i=0;
				foreach ($data as $iIndice => $objfila) {
						$cedula[]=trim(($objfila[0]));
						$dsnombre[]=utf8_decode(trim(($objfila[1]))." ".trim(($objfila[2]))." ".trim(($objfila[3]))." ".trim(($objfila[4])));
						$idnits[]=trim(($objfila[0]));
						$idzonaelectoral[]=trim(($objfila[9]));
						$dszonaelectoral[]=trim(utf8_decode($objfila[10]));
						$dscodigoasociado[]=trim(($objfila[11]));
						$dsclave[]=trim(($objfila[12]));
						$dsemail[]=trim(($objfila[6]));

				}

		}
}


?>