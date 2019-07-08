<? 

/*serror_reporting(E_ALL);

ini_set("display_errors", 1);*/

/*

| ----------------------------------------------------------------- |

Sistema integrado de gestion e informacion administrativa

Desarrollado por Comprandofacil

http://www.comprandofacil.com/

Copyright (c)

Medellin - Colombia

=====================================================================

  Autores:

  Juan Fernando Fernández <consultorweb@comprandofacil.com>

  Juan Felipe Sánchez <graficoweb@comprandofacil.com>

  José Fernando Peña <soporteweb@comprandofacil.com>

=====================================================================

| ----------------------------------------------------------------- |

*/

$rutx=1;



if($rutx==1) $rutxx="../";

include ($rutxx."../../incluidos_modulos/comunes.php");

include ($rutxx."../../incluidos_modulos/varconexion.php");

include ($rutxx."../../incluidos_modulos/modulos.funciones.php");

include ($rutxx."../../incluidos_modulos/sessiones.php");

include ($rutxx."../../incluidos_modulos/func.calendario_2.php"); // funcion nueva del calendario

$titulomodulo="Encuestar clientes";

?>

<html>

	<?include($rutxx."../../incluidos_modulos/head.php");?>

	  <link rel="stylesheet" href="http://www.comprandofacil.com/pide/corehome/css_modulos/style.core.css" type="text/css" media="all" rel="stylesheet" >

	  <link rel="stylesheet" href="<? echo $rutxx;?>../../css_modulos/core.graficas.css">

	  <link rel="stylesheet" href="<? echo $rutxx;?>../../css_modulos/core.crm.css">

<body>



<?

$rutamodulo="  <a href='$rutxx../core/default.php' class='textlink' title='Principal'>Principal</a>  /  ";

$rutamodulo.=" <span class='text1'>".$titulomodulo."</span>";



include($rutxx."../../incluidos_modulos/navegador.principal.php");

include($rutxx."../../incluidos_modulos/core.mensajes.php");

include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");



$idcampana=$_REQUEST['idcampana'];


$sql="select cliente_asociado from crm_campa_por_cliente where campaa_asociada = $idcampana group by cliente_asociado ";

$resultPREF=$db->Execute($sql);

if(!$resultPREF->EOF)

	{
?>

		<br /><br /><table align='center' width='100%' border='0' cellpadding='2' cellspacing='1' style='table-layout:fixed;'>

			<tr class='formabot' bgcolor='#E6E6E6' align='center'>
				<td>
					<input type="checkbox" name="todo" onclick="ActivarTodo('xx1','todo','idclie')">
					Opciones
				</td>
				<td>

					Nombre/Razon social

				</td>

				<td>

					Tipo identificacion

				</td>

				<td>

					identificacion/NIT

				</td>

				<td>

					Tel&eacute;fono

				</td>

				<td>

					Celular

				</td>

				<td>

					Direcci&oacute;n

				</td>

				<td>

					ciudad

				</td>

				<td>

					Fax

				</td>

				<td>

					Email

				</td>

				<td>

					Fecha ingreso

				</td>

				<td>

					Fecha modificacion

				</td>

				<td>

					OPCI&Oacute;N

				</td>	

			</tr>
			<?

		$clientes="";

		while(!$resultPREF->EOF)

		{

			$idcliente=$resultPREF->fields[0];

			$clientes.=$idcliente.",";



			$sql="select nombre_o_razn_social, apellido_o_nombre_comercial, direccin, telfono_1, tipo_documento,";

			$sql.="cdula_o_nit, fecha_constitucin, fax, celular, identificacin_, correo_email, ciudad_asociada, dsfecha_mod  ";

			$sql.=" from crm_clientes where id= ".$idcliente." " ;



			$resultCLIE=$db->Execute($sql);



			if(!$resultCLIE->EOF)

			{

			

					$nombre = $resultCLIE->fields['nombre_o_razn_social'];

					$apellido = $resultCLIE->fields['apellido_o_nombre_comercial'];

					$direccion = $resultCLIE->fields['direccin'];

					$telefono = $resultCLIE->fields['telfono_1'];

					$tipodoc = $resultCLIE->fields['tipo_documento'];

					$dsmtipodoc=seldato('dsm','idtipoformulario','framecf_tbltiposformulariosxcampos',"1 and idcampo = 99 and id =".$tipodoc,1);

					$CEDNIT = $resultCLIE->fields['cdula_o_nit'];

					$fechaconsti = $resultCLIE->fields['fecha_constitucin'];

					$fax = $resultCLIE->fields['fax'];

					$celular = $resultCLIE->fields['celular'];

					$correo = $resultCLIE->fields['correo_email'];

					$idciudad = $resultCLIE->fields['ciudad_asociada'];

					$dsmciudad=seldato('nombre','id','crm_ciudades',$idciudad,1);

					$dffechamod = $resultCLIE->fields['dsfecha_mod'];
					?>


							<tr>
								<td style='border:solid 1px #E6E6E6;text-align:center;'>
									<input type="checkbox" id="idclie[]" name="idclie[]" value="<? echo $id; ?>" checked>
									<a href="#" onclick="irAPaginaDN('../vendedor/reportes.php?id=<? echo $id ?>')">Info</a>
								</td>
								<td style='border:solid 1px #E6E6E6;text-align:center;' ><? echo utf8_decode($nombre).' '.utf8_decode($apellido) ?></td>
								<td style='border:solid 1px #E6E6E6;text-align:center;' ><? echo $dsmtipodoc ?></td>
								<td style='border:solid 1px #E6E6E6;text-align:center;' ><? echo $CEDNIT ?></td>
								<td style='border:solid 1px #E6E6E6;text-align:center;' ><? echo $telefono ?> </td>
								<td style='border:solid 1px #E6E6E6;text-align:center;' ><? echo $celular ?></td>
								<td style='border:solid 1px #E6E6E6;text-align:center;' ><? echo utf8_decode($direccion) ?></td>
								<td style='border:solid 1px #E6E6E6;text-align:center;' ><? echo $dsmciudad ?></td>
								<td style='border:solid 1px #E6E6E6;text-align:center;' ><? echo $fax ?></td>
								<td style='border:solid 1px #E6E6E6;text-align:center;word-wrap: break-word;' ><? echo utf8_decode($correo) ?></td>
								<td style='border:solid 1px #E6E6E6;text-align:center;' ><? echo $fechaconsti ?></td>
								<td style='border:solid 1px #E6E6E6;text-align:center;' ><? echo$dffechamod ?></td>	
								<td style='border:solid 1px #E6E6E6;text-align:center;'>
								<? $ruta="filtros.cargar.encuesta.cliente.php?idcliente=$idcliente"; ?>
								<a href='#' onclick="irAPaginaDN('<? echo $ruta ?>')">Encuestar</a></td>
							</tr>

					

				<?

			}

			$resultCLIE->Close();

			





		$resultPREF->MoveNext();

		}

		



		$dataCLIE.="</table>";

		

		

	$resultPREF->Close();

	}

echo $dataCLIE;	

?>

<table align='center' border='0' cellpadding='2' cellspacing='1' style='table-layout:fixed;'>

<tr>

<td>

	<input type="button" value="Regresar" class="botones" onclick="irAPaginaD('filtros.campana.telefonica.php?idcampana=<? echo $idcampana; ?>')" >

</td>

<td>

	<input type="button" value="Ver guion" class="botones" onclick="irAPaginaDN('guion.php?idcampana=<? echo $idcampana; ?>')" >

</td>

</tr>

</table>



<?



	include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");

	include($rutxx."../../incluidos_modulos/modulos.remate.php");

?>

</body>

</html>