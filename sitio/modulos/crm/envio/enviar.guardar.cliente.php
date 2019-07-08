<?
include("../../../incluidos_modulos/comunes.php");
include("../../../incluidos_modulos/varconexion.php");
include("../../../incluidos_modulos/class.rc4crypt.php");
include("../../../incluidos_modulos/modulos.funciones.php");

if($_REQUEST['oper']==1)
{
	//Enviar y guardar cliente y cotizacion

	if($_REQUEST['nombre']<>"" && ($_REQUEST['email'] <> "" || $_REQUEST['telefono'] <> "" ) ){


		$sql=" insert into crm_clientes ( ";

		if($_REQUEST['nombre']<>"") $sql.=" nombre_o_razn_social, ";
		if($_REQUEST['apellido']<>"") $sql.=" apellido_o_nombre_comercial, ";
		if($_REQUEST['email']<>"") $sql.=" correo_email, ";
		if($_REQUEST['telefono']<>"") $sql.=" telefono, ";
		$sql.=" idactivo, ";
		$sql.=" dsfecha, ";
		$sql.=" fecha_constitucin ";

		$sql.=" ) values (";

		if($_REQUEST['nombre']<>"") $sql.=" '".$_REQUEST['nombre']."', ";
		if($_REQUEST['apellido']<>"") $sql.=" '".$_REQUEST['apellido']."', ";
		if($_REQUEST['email']<>"") $sql.=" '".$_REQUEST['email']."', ";
		if($_REQUEST['telefono']<>"") $sql.=" '".$_REQUEST['telefono']."', ";
		$sql.=" 1, ";
		$sql.=" '".date('Ymd H:i:s')."', ";
		$sql.=" '".date('Ymd H:i:s')."'";

		$sql.=" ) ";

		if($db->Execute($sql))
		{

		$habeasdata = seldato("id","habeas_data","crm_textos_cotizaciones_generales",'1',1);
		$textoseguridad = seldato("id","texto_seguridad","crm_textos_cotizaciones_generales",'1',1);
		
		$dsfechaini=seldato("fecha_inicial_de_publicacion","id","crm_productos_y_servicios",$_REQUEST['idplan'],1);
		$dsfechafin=seldato("fecha_final_de_publicacion","id","crm_productos_y_servicios",$_REQUEST['idplan'],1);

		$iduser=seldato("id","correo_email","crm_clientes",$_REQUEST['email'],1);
		$dsdplan=seldato("id","descripcion","crm_productos_y_servicios",$_REQUEST['idplan'],1);
		$dsdprecio=seldato("dsd2","idproducto"," tblproductosxprecios",$_REQUEST['idplan'],1);

		$dsdterminos=seldato('id','terminos_y_condiciones','crm_productos_y_servicios',$_REQUEST['idplan'],1);
		$dsdplaninclu=seldato('id','el_plan_incluye','crm_productos_y_servicios',$_REQUEST['idplan'],1);	

		$obs="<br> Plan: ".$_REQUEST['plan'];
		$obs.="<br> Descripci&oacute;n: ".$dsdplan;
		$obs.="<br> Precio desde: ".$dsdprecio;
		$obs.="<br> Fecha: ".date("Y/m/d H:i:s");

		$sql=" insert into crm_cotizaciones ";
		$sql.=" (";
		$sql.=" cliente_asociado, dsfecha, fecha_de_creacion, origen, observaciones, idactivo, estado_cotizacion, asesor_operativo, fuente_de_origen ";
		$sql.=") values (";
		$sql.="".$iduser.", '".date("Y/m/d H:i:s")."', '".date("Y/m/d H:i:s", strtotime('+24 day'))."', '".$_SESSION['i_idusuario']."', '".$obs."', 1, 0 , ".$_SESSION['i_idusuario'].",1)";



		if($db->Execute($sql))

		{

			$dscorreo=$_REQUEST['email'];
			$asunto="Registro de solicitud:";
			$cuerpo='<html>
			<head>

				<title>Correo respuesta Univiajes</title>

			</heade>

			<body>

				<table style="width:750px; border-collapse:collapse; border:0; margin:0 auto; padding:0; font-family: Arial, Verdana, sans-serif;">

					<tr>

						<td>

							<a href="'.$autorizado.'"><img src="http://www.univiajes.viajes/contenidos/images/empresa/cabezote-083316-1..jpg" /></a>

						</td>

					</tr>

					<tr>

						<td style="padding:2em;">

							<p>

								Apreciado:<br/>

								<b style="text-transform:uppercase;">'.$_REQUEST['nombre']." ".$_REQUEST['apellido'].'</b><br/><br/>

								Gracias por Reservar en univiajes.viajes<br/>

								Estos son los datos de su reserva.

							</p>

							<p>

								<b style="color:#137faa;">Nombres:</b><span style="text-transform:uppercase;"> '.$_REQUEST['nombre'].'</span><br/>

								<b style="color:#137faa;">Apellidos:</b><span style="text-transform:uppercase;"> '.$_REQUEST['apellido'].'</span><br/>

								<b style="color:#137faa;">Telefono:</b>'.$_REQUEST['telefono'].'<br/>

								<b style="color:#137faa;">Email:</b>'.$_REQUEST['email'].'

							</p>

							<p>

								<b style="color:#137faa;">Plan:</b> '.$_REQUEST['plan'].'<br/>
								<b style="color:#137faa;">Descripci&oacute;n:</b> '.$dsdplan.'<br/>';

								if($dsdprecio<>'') $cuerpo.='<b style="color:#137faa;">Precio desde:</b> $'.$dsdprecio.'<br/>';
								if($dsdterminos<>'') $cuerpo.='<b style="color:#137faa;">Terminos y condiciones:</b> '.$dsdterminos.'<br/>';
								if($dsdplaninclu<>'') $cuerpo.='<b style="color:#137faa;">El plan incluye:</b> '.$dsdplaninclu.'<br/>';

								 $cuerpo.='<b style="color:#137faa;">Fecha de solicitud:</b> '.date("Y-m-d h:i:s").'<br/>';

								if($dsfechaini<>'')$cuerpo.='<b style="color:#137faa;">Fecha Inicial:</b> '.$dsfechaini.'<br/>';
								if($dsfechafin<>'')$cuerpo.='<b style="color:#137faa;">Fecha Final:</b> '.$dsfechafin.'<br/>';

							$cuerpo.='</p>
							<p>
							'.$textoseguridad.'
							</p>

							<p>

								<b style="color:#137faa;">Ingresa a la zona privada en este enlace:</b> <a href="'.$autorizado.'" target="_blank">univiajes.viajes</a><br/>

								<b style="color:#137faa;">Fecha de registro:</b> '.date("Y-m-d h:i:s").'

							</p>

							<p>

								<a href="'.$autorizado.'" target="_blank">univiajes.viajes</a> Online '.date("Y").'<br/>

								Todos los derechos reservados.

							</p>
							<p>
							'.$habeasdata.'
							</p>
							

						</td>

					</tr>

					<tr>

						<td>

							<img src="http://www.univiajes.viajes/contenidos/images/empresa/remate-083316-2..jpg" />

						</td>

					</tr>

				</table>

			</body>

			</html>' ;



			include("../../incluidos_modulos/enviadorcorreo.crm.php");

			$headers= "From: $correobase\n";
			$headers.= "Organization: $autorizado\n";
			$headers.= "MIME-Version: 1.0\n";
			$headers.= "Content-Type: text/html; charset=iso-8859-1\n";
			$asuntoa="Gracias por realizar su solicitud con ".$autorizado;

			$cuerpoa=$cuerpo;
			//exit();

			if($idtipoenvio==1){
			$mail->AddAddress($dscorreo,$asuntoa,$cuerpoa,$headers);
				}else{
				@mail($dscorreo,$asuntoa,$cuerpoa,$headers);
			}
			include("../../incluidos_modulos/enviadorcorreo.crm.php");

			$data="Cliente registrado , Cotizaci&oacute;n generada y enviada";

			}
		}
	}







}

elseif($_REQUEST['oper']==2)

{

	//Enviar

	$dsfechaini=seldato("fecha_inicial_de_publicacion","id","crm_productos_y_servicios",$_REQUEST['idplan'],1);
	$dsfechafin=seldato("fecha_final_de_publicacion","id","crm_productos_y_servicios",$_REQUEST['idplan'],1);


	$obs="<br> Plan: ".$_REQUEST['plan'];
	$dsdplan=seldato("id","descripcion","crm_productos_y_servicios",$_REQUEST['idplan'],1);
	$obs.="<br> Descripci&oacute;n: ".$dsdplan;
	$dsdprecio=seldato("dsd2","idproducto"," tblproductosxprecios",$_REQUEST['idplan'],1);
	$obs.="<br> Precio desde: ".$dsdprecio;
	$obs.="<br> Fecha: ".date("Y/m/d H:i:s");
	
	$sql=" insert into crm_cotizaciones ";
	$sql.=" (";
	$sql.=" cliente_asociado, dsfecha, fecha_de_creacion, origen, observaciones, idactivo, estado_cotizacion, asesor_operativo, fuente_de_origen ";
	$sql.=") values (";
	$sql.="".$_REQUEST['idcliente'].", '".date("Y/m/d H:i:s")."', '".date("Y/m/d H:i:s")."', '".$_SESSION['i_idusuario']."', '".$obs."', 1, 0 , ".$_SESSION['i_idusuario'].",1)";
	if($db->Execute($sql)){



	$dscorreo=seldato("correo_email","id","crm_clientes",$_REQUEST['idcliente'],1);
	$asunto="Registro de solicitud:";
	$cuerpo='<html>
	<head>

		<title>Correo respuesta Univiajes</title>

	</heade>

	<body>

		<table style="width:750px; border-collapse:collapse; border:0; margin:0 auto; padding:0; font-family: Arial, Verdana, sans-serif;">

			<tr>

				<td>

					<a href="'.$autorizado.'"><img src="http://www.univiajes.viajes/contenidos/images/empresa/cabezote-083316-1..jpg" /></a>

				</td>

			</tr>

			<tr>

				<td style="padding:2em;">

					<p>

						Apreciado:<br/>

						<b style="text-transform:uppercase;">'.$_REQUEST['nombre']." ".$_REQUEST['apellido'].'</b><br/><br/>

						Gracias por Reservar en univiajes.viajes<br/>

						Estos son los datos de su reserva.

					</p>

					<p>

						<b style="color:#137faa;">Nombres:</b><span style="text-transform:uppercase;"> '.$_REQUEST['nombre'].'</span><br/>

						<b style="color:#137faa;">Apellidos:</b><span style="text-transform:uppercase;"> '.$_REQUEST['apellido'].'</span><br/>

						<b style="color:#137faa;">Telefono:</b>'.$_REQUEST['telefono'].'<br/>

						<b style="color:#137faa;">Email:</b>'.$_REQUEST['email'].'

					</p>

					<p>

						<b style="color:#137faa;">Plan:</b> '.$_REQUEST['plan'].'<br/>';
						if($dsdplan<>'') $cuerpo.='<b style="color:#137faa;">Descripci&oacute;n:</b> '.$dsdplan.'<br/>';
						if($dsdprecio<>'') $cuerpo.='<b style="color:#137faa;">Precio desde:</b> $'.$dsdprecio.'<br/>';
						$cuerpo.='<b style="color:#137faa;">Fecha solicitud:</b> '.date("Y-m-d h:i:s").'<br/>';
						if($dsfechaini<>'') $cuerpo.='<b style="color:#137faa;">Fecha Inicial:</b> '.$dsfechaini.'<br/>';
						if($dsfechafin<>'') $cuerpo.='<b style="color:#137faa;">Fecha Final:</b> '.$dsfechafin.'<br/>';

					$cuerpo.='</p>

					<p>

						<b style="color:#137faa;">Ingresa a la zona privada en este enlace:</b> <a href="'.$autorizado.'" target="_blank">univiajes.viajes</a><br/>

						<b style="color:#137faa;">Fecha de registro:</b> '.date("Y-m-d h:i:s").'

					</p>

					<p>

						<a href="'.$autorizado.'" target="_blank">univiajes.viajes</a> Online '.date("Y").'<br/>

						Todos los derechos reservados.

					</p>

				</td>

			</tr>

			<tr>

				<td>

					<img src="http://www.univiajes.viajes/contenidos/images/empresa/remate-083316-2..jpg" />

				</td>

			</tr>

		</table>

	</body>

	</html>' ;



	include("../../incluidos_modulos/enviadorcorreo.crm.php");



	$headers= "From: $correobase\n";
	$headers.= "Organization: $autorizado\n";
	$headers.= "MIME-Version: 1.0\n";
	$headers.= "Content-Type: text/html; charset=iso-8859-1\n";
	$asuntoa="Gracias por realizar su solicitud con ".$autorizado;
	$cuerpoa=$cuerpo;

	//exit();
	if($idtipoenvio==1){
	$mail->AddAddress($dscorreo,$asuntoa,$cuerpoa,$headers);
		}else{
		@mail($dscorreo,$asuntoa,$cuerpoa,$headers);
	}
	include("../../incluidos_modulos/enviadorcorreo.crm.php");
	$data="Cotizacion generada y enviada";

	}
}

echo $data;

?>

