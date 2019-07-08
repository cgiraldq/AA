<? 
//$db->debug=true;
$contar = count($_REQUEST['idplan']);
$idpref=$_REQUEST['idplan'];
$valno=0;	
if($_REQUEST['idplan']<>'' && $contar>0)
{
$datosfiltros= "Buscar por plan: ";
for($i=0;$i<$contar;$i++)
{
	$idfiltro=$idpref[$i].",";
	$dsmplan=seldato('titulo','id','crm_productos_y_servicios',$idpref[$i],1);
	$datosfiltros.= $dsmplan.", ";

	
	$sql="select cliente_asociado from  crm_cotizaciones WHERE observaciones like('%".$dsmplan."%')";

	$resultPREF=$db->Execute($sql);
	$dataCLIE="";
	if(!$resultPREF->EOF)
	{
		$dataCLIE="<table align='center' width='100%' border='0' cellpadding='2' cellspacing='1' style='table-layout:fixed;'>
			<tr class='formabot' bgcolor='#E6E6E6' align='center'>
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
			</tr>";
		
		while(!$resultPREF->EOF)
		{
			$idcliente=$resultPREF->fields[0];

			$sqlC="select nombre_o_razn_social, apellido_o_nombre_comercial, direccin, telfono_1, tipo_documento,";
			$sqlC.="cdula_o_nit, fecha_constitucin, fax, celular, identificacin_, correo_email, ciudad_asociada, dsfecha_mod  ";
			$sqlC.=" from crm_clientes where id= ".$idcliente." " ;

			$resultCLIE=$db->Execute($sqlC);

			if(!$resultCLIE->EOF)
			{
			
					$nombre=$resultCLIE->fields['nombre_o_razn_social'];
					$apellido=$resultCLIE->fields['apellido_o_nombre_comercial'];
					$direccion=$resultCLIE->fields['direccin'];
					$telefono=$resultCLIE->fields['telfono_1'];
					$tipodoc=$resultCLIE->fields['tipo_documento'];
					$dsmtipodoc=seldato('dsm','idtipoformulario','framecf_tbltiposformulariosxcampos',"1 and idcampo = 99 and id =".$tipodoc,1);
					$CEDNIT=$resultCLIE->fields['cdula_o_nit'];
					$fechaconsti=$resultCLIE->fields['fecha_constitucin'];
					$fax=$resultCLIE->fields['fax'];
					$celular=$resultCLIE->fields['celular'];
					$correo=$resultCLIE->fields['correo_email'];
					$idciudad=$resultCLIE->fields['ciudad_asociada'];
					$dsmciudad=seldato('nombre','id','crm_ciudades',$idciudad,1);
					$dffechamod=$resultCLIE->fields['dsfecha_mod'];

					$dataCLIE.="<tr >";
						$dataCLIE.="<td style='border:solid 1px #E6E6E6;text-align:center;' >".utf8_decode($nombre)." ".utf8_decode($apellido)."</td>";
						$dataCLIE.="<td style='border:solid 1px #E6E6E6;text-align:center;' >".$dsmtipodoc."</td>";
						$dataCLIE.="<td style='border:solid 1px #E6E6E6;text-align:center;' >".$CEDNIT."</td>";
						$dataCLIE.="<td style='border:solid 1px #E6E6E6;text-align:center;' >".$telefono."</td>";
						$dataCLIE.="<td style='border:solid 1px #E6E6E6;text-align:center;' >".$celular."</td>";
						$dataCLIE.="<td style='border:solid 1px #E6E6E6;text-align:center;' >".utf8_decode($direccion)."</td>";
						$dataCLIE.="<td style='border:solid 1px #E6E6E6;text-align:center;' >".$dsmciudad."</td>";
						$dataCLIE.="<td style='border:solid 1px #E6E6E6;text-align:center;' >".$fax."</td>";
						$dataCLIE.="<td style='border:solid 1px #E6E6E6;text-align:center;word-wrap: break-word;' >".utf8_decode($correo)."</td>";
						$dataCLIE.="<td style='border:solid 1px #E6E6E6;text-align:center;' >".$fechaconsti."</td>";
						$dataCLIE.="<td style='border:solid 1px #E6E6E6;text-align:center;' >".$dffechamod."</td>";	
					$dataCLIE.="</tr>";
					

			}
			$resultCLIE->Close();
			



		$resultPREF->MoveNext();
		}
		
		$dataCLIE.="</table>";
		
	}
	$resultPREF->Close();

if($dataCLIE=='')
{
	$dataCLIE = "El filtro seleccionado no produjo resultado";
	$valno=1;
} 

}
$tipofiltro="3";
echo trim($datosfiltros,',');
echo "<br /><br/>";
echo $dataCLIE;

}


?>