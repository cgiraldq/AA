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
//$db->debug=true;
?>

<table width="100%" cellpadding="2" cellspacing="1" align="center" class="cont_filtro">
	<tr>
		<td>Seleccionar opcion de filtro
			<select name="opcion_filtro" id="opcion_filtro" onchange="imprimir_filtros()">
				<option>-- Opci&oacute;n de filtro --</option>
				<option value="1">Preferencias</option>
				<option value="2">Planes</option>
				<option value="3">Servicios</option>
			</select>
		</td>
	</tr>
</table>

<div id="cargar_filtros">
<?

if($contar>0 && $_REQUEST['idasoc']=='' && $_REQUEST['idservicio']=='' && $_REQUEST['idplan']=='' )
{

$sql="select cliente_asociado from crm_campa_por_cliente where campaa_asociada = $idcampana group by cliente_asociado ";
$resultPREF=$db->Execute($sql);
if(!$resultPREF->EOF)
	{
		?>

		<table align='center' width='100%' border='0' cellspacing='1' class="frm_campos_consola">
			<form name="xx1">
			<tr class='formabot tbl_cbz_lista' align='center'>
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
			</tr>
		<?
		$clientes="";
		while(!$resultPREF->EOF)
		{
			$idcliente=$resultPREF->fields[0];
			$clientes.=$idcliente.",";

			$sql="select nombre_o_razn_social, apellido_o_nombre_comercial, direccin, telfono_1, tipo_documento,";
			$sql.="cdula_o_nit, fecha_constitucin, fax, celular, identificacin_, correo_email, ciudad_asociada, dsfecha_mod,id  ";
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
					$id = $resultCLIE->fields['id'];
			?>

							<tr>
								<td >
									<input type="checkbox" id="idclie[]" name="idclie[]" value="<? echo $id; ?>" checked>
									<a href="#" onclick="irAPaginaDN('../vendedor/reportes.php?id=<? echo $id ?>')">Info</a>
								</td>
								<td  ><? echo utf8_decode($nombre).' '.utf8_decode($apellido) ?></td>
								<td  ><? echo $dsmtipodoc ?></td>
								<td  ><? echo $CEDNIT ?></td>
								<td  ><? echo $telefono ?></td>
								<td  ><? echo $celular ?></td>
								<td  ><? echo utf8_decode($direccion) ?></td>
								<td  ><? echo $dsmciudad ?></td>
								<td  ><? echo $fax ?></td>
								<td ><? echo utf8_decode($correo) ?></td>
								<td  ><? echo $fechaconsti ?></td>
								<td  ><? echo $dffechamod ?></td>
							</tr>



			<?
			}
			$resultCLIE->Close();




		$resultPREF->MoveNext();
		}
		?>
		</form>
		</table>
	<?
	$resultPREF->Close();
	}

}


?>
</div>
<?
	include("filtros.preferencias.php");
	include("filtros.servicios.php");
	include("filtros.planes.php");
?>




