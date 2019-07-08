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
// Tabla central de datos cuando se hacen los listados
?>
<table width="100%" border="0" cellpadding="2" cellspacing="1" align="center" class="text1">
<?
// encabezado generico basado
$nombrecampos="Id,Tipo,Nombres,Apellidos,Teléfono,Correo,Contrase&ntilde;a,Ciudad,Pa&iacute;s,Direcci&oacute;n,Fecha registro,Activo";
include("../../incluidos_modulos/tabla.encabezado.php");
$contar=0;
	while (!$result->EOF) {
		?>
		 <tr >
			<td align="center" width="5%"><? echo $result->fields[0]?>
			</td>
			<td align="center"><? if($result->fields[11]==1){?>
			Se&ntilde;or
			<? }elseif($result->fields[11]==2){ ?>
			Se&ntilde;ora
			<? } ?>
			</td>
     		<td align="center"><? echo $result->fields[1]?></td>
			<td align="center"><? echo $result->fields[7]?></td>
			<td align="center"><? echo $result->fields[3]?></td>
			<td align="center"><? echo $result->fields[4]?></td>
			<?
			$clave=$result->fields[5];
			$dscontrasenan = $rc4->decrypt($s3m1ll4, urldecode($clave));
			?>
			<td align="center"><? echo $dscontrasenan;?></td>
			<td align="center"><? echo $result->fields[10]?></td>
			<td align="center"><? echo $result->fields[8]?></td>
			<td align="center"><? echo $result->fields[9]?></td>


			<td align="center"><? echo $result->fields[6]?></td>
    		<td align="center">
			<?
			if ($result->fields[2]==1) echo "SI";
			if ($result->fields[2]==2) echo "NO";
			?>



		  </td>
		  <td align="center">
 		  </td>

			</tr>

		<?
		$result->MoveNext();
	} // fin while
?>
</table>
