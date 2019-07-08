<?
//include("incluidos_sitio/encabezado.php");
  include("../../incluidos_modulos/comunes.php");
  include("../../incluidos_modulos/varconexion.php");
?>

<?
	$idc=$_REQUEST['id'];
	$rutaImagen=$rut."../../../contenidos/images/qsomos/";
	$sql="select dsm,dsd,dsimg,dsvideo,dsciudad,dstelefono,dsdireccion,dsdescuento from tblconvenios where idactivo not in(2,9)  ";
	$sql.=" and id=$idc";

	//echo $sql;
	$result=$db->Execute($sql);
	if(!$result->EOF){

  $dsm=reemplazar($result->fields[0]);
  $dsd=trim($result->fields[1]);
  $dsd=reemplazar($dsd);
  $dsimg=$result->fields[2];
  $dsvideo=$result->fields[3];

  $dsciudad=reemplazar($result->fields[4]);
  $dstelefono=reemplazar($result->fields[5]);
  $dsdireccion=reemplazar($result->fields[6]);

   $dsdescuento=reemplazar($result->fields[7]);
?>

<!DOCTYPE html>
	<head>
		<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,400,600' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="<? echo $rutalocal;?>../../css/style.css" type="text/css" media="all" rel="stylesheet" >
	</head>
<body style="background-color:#fff;">

<table style="width: 80%" align="center" class="tbl_imprimir" border="0">
		

		<tr>
			<td  align="center">
			<? if(is_file($rutaImagen.$dsimg)){?>
			<img src="<? echo $rutaImagen.$dsimg?>" />
			<? }?>
			</td>
			<td align="center"><h2><? echo $dsm?></h2>

			<!--span class="txt1">Válido hasta agotar existencias</span-->
			</td>
		</tr>
		
		<tr>
			<td colspan="2"><div style="border-bottom:1px #333333 dashed"></div></td>
		</tr>
		<tr>
			<td colspan="2">

		<table style="width:70%" align="center">



		<tr>
			<td colspan="2"></td>
		</tr>
		<? if($dsciudad<>""){?>
		<tr>
			<td style="width: 30%" valign="top"><p>Aplica en:</p></td>
			<td style="width: 80%"class="parrafo"><p><? echo $dsciudad?></p></td>
		</tr>

		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>
		<? }
			if($dstelefono<>""){
		?>
			<tr>
			<td style="width: 7%" valign="top"><p>Tel&eacute;fono:</p></td>
			<td style="width: 63%"class="parrafo"><p><? echo $dstelefono?></p></td>
		</tr>
		<tr>
			<td colspan="2"></td>
		</tr>

		<? }if($dsdireccion<>""){
		?>
			<tr>
			<td style="width: 7%" valign="top"><p>Direcci&oacute;n:</p></td>
			<td style="width: 63%"class="parrafo"><p><? echo $dsdireccion?></p></td>
		</tr>
		<tr>
			<td colspan="2"></td>
		</tr>

		<? }?>

		</table>

			</td>
		</tr>
		<tr>
			<td colspan="2"><div style="border-bottom:1px #333333 dashed"></div><br></td>
		</tr>

		<tr>
			<td colspan="2">

			<table style="width:70%" align="center" border="0">
			

			<tr>
			<td  valign="top" width="30%"><p><b>Tel&eacute;fono:</b></p></td>
			<td style="font-weight: bold"><p><b>(57) (4) 511 46 88</b></p><br />
				<p><b>A nivel nacional  01 8000 518 666</b></p></td>
		</tr>
			<tr>
			<td style="width: 20%" valign="top"><p><b>Direcci&oacute;n:</b></p></td>
			<td style="width: 80%"><p>Carrera 51 No 48-44 </p><br />
				<p>Medellín - Antioquia - Colombia</p>
				</td>
		</tr>

		<tr>
			<td  valign="top"><p><b>Web:</b></p></td>
			<td><p>www.coofinep.com</p></td>
		</tr>
		<tr>
			<td colspan="2"><img src="../../images/logo_administrador.png"/ style="margin:10px 0 0 0;"></td>
		</tr>





		</table>
			</td>
		</tr>

		<tr>
			<td colspan="2">
				<img src="../../images/imprimir.png" style="cursor:pointer; margin: 10px 0 0 0;" onclick="window.print()" />
			</td>
		</tr>

	</table>


	<?
		}
	?>
</body>

</html>
