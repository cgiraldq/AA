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
// edicion de datos
$rutx=1;
$rutxx="../";

$rutx=1;
if($rutx==1) $rutxx="../";
include($rutxx."../../incluidos_modulos/modulos.globales.php");
include($rutxx."../../incluidos_modulos/modulos.calendario.php");

$titulomodulo="Administrador de votaciones ";
$rr="default.php";
$idx=$_REQUEST['idx'];
$tabla="tbltipovotacion";

			$dsm=$_REQUEST['dsm'];
			$dspersonasactivar=$_REQUEST['dspersonasactivar'];
			$idcertinscripcion=$_REQUEST['idcertinscripcion'];
			$idimprcertins=$_REQUEST['idimprcertins'];
			$idcertvotacion=$_REQUEST['idcertvotacion'];
			$idimprcervot=$_REQUEST['idimprcervot'];
			$idmostrarfoto=$_REQUEST['idmostrarfoto'];
			$idmostrarficha=$_REQUEST['idmostrarficha'];
			$idmostrarvotos=$_REQUEST['idmostrarvotos'];
			$idmostrarporcvotos=$_REQUEST['idmostrarporcvotos'];
			$idmostrartotales=$_REQUEST['idmostrartotales'];
			$idactivo=$_REQUEST['idactivo'];
			$dstexto=$_REQUEST['dstexto'];

			$paso=$_REQUEST['paso'];
			if ($paso=="1") {
			$sql=" update $tabla set ";

			$sql.=" dspersonasactivar='$dspersonasactivar'";
			$sql.=",idcertinscripcion='$idcertinscripcion'";
			$sql.=",idimprcertins='$idimprcertins'";
			$sql.=",idcertvotacion='$idcertvotacion'";
			$sql.=",idimprcervot='$idimprcervot'";
			$sql.=",idmostrarfoto='$idmostrarfoto'";
			$sql.=",idmostrarficha='$idmostrarficha'";
			$sql.=",idmostrarvotos='$idmostrarvotos'";
			$sql.=",idmostrarporcvotos='$idmostrarporcvotos'";
			$sql.=",idmostrartotales='$idmostrartotales'";
			$sql.=",dstexto='$dstexto'";

			$sql.=",idactivo='$idactivo'";


					$sql.=" where id=".$idx;
					//echo $sql;

					if ($db->Execute($sql))  {
						$error=0;
						$mensajes=$men[6];
						// cargar auditoria
						$dstitulo="Modificacion $titulomodulo, $dsm";
						$dsdesc=" El usuario ".$_SESSION['i_dslogin']." modifico un registro";
						$dsruta="../votaciones/tipovotacion/default.php";
						include($rutxx."../../incluidos_modulos/logs.php");

					}	else {
						$mensajes=$men[7];
					}
			}



?>
<html>
<?include($rutxx."../../incluidos_modulos/head.php");?>
<body >

	<? include($rutxx."../../incluidos_modulos/navegador.principal.php");
// generacion del encabezado de acuerdo a los resultados encontrados
$sql="select dspersonasactivar,idcertinscripcion,idimprcertins";
$sql.=",idcertvotacion,idimprcervot,idmostrarfoto,idmostrarficha";
$sql.=",idmostrarvotos,idmostrarporcvotos,idmostrartotales,idactivo,dstexto";
$sql.=" from $tabla a ";
$sql.=" where id=$idx ";

$result = $db->Execute($sql);
if (!$result->EOF) {
$totalregistros=$result->RecordCount();
$rutamodulo="<a href='$rutxx../core/default.php' class='textlink' title='Principal'>Principal</a>  /  ";
$rutamodulo.="  <a href='default.php' class='textlink'>$titulomodulo</a>  /  <span class='text1'>Modificar</span>";
include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");
$dsm=$result->fields[0];
$idpos=$result->fields[1];
$idactivo=$result->fields[2];
$dsimg1=$result->fields[3];

			$dspersonasactivar=$result->fields[0];
			if ($dspersonasactivar=="") $dspersonasactivar=0;
			 $idcertinscripcion=$result->fields[1];
			$idimprcertins=$result->fields[2];
			$idcertvotacion=$result->fields[3];
			$idimprcertvot=$result->fields[4];
			$idmostrarfoto=$result->fields[5];
			$idmostrarficha=$result->fields[6];
			$idmostrarvotos=$result->fields[7];
			$idmostrarporcvotos=$result->fields[8];
			$idmostrartotales=$result->fields[9];
			$idactivo=$result->fields[10];
			$dstexto=$result->fields[11];



?>
<br>
<? include($rutxx."../../incluidos_modulos/encabezado.editar.php");?>

<table align="center"  cellspacing="1" cellpadding="5" border="0" width=70% class="campos_ingreso">

<form action="<? echo $pagina;?>" method=post name=u enctype="multipart/form-data">
<tr>
	<td align="center" colspan="2" background="../../img_modulos/cf_diseno_r2_c2.jpg">
<?
$forma="u";
$param="dspersonasactivar";
include($rutxx."../../incluidos_modulos/botones.modificar.php");?>
<input type="hidden" name="idx" value="<? echo $idx?>">
</td>
</tr>

<input type="hidden" name="img3" value="<? echo $dsimg2?>">

<input type="hidden" name="archivoanterior3" value="<? echo $dsimg2?>">


        <tr bgcolor="#FFFFFF">
        <td>PERSONAS PARA ACTIVAR<br> (COMITE DE CONTROL SOCIAL)</td>
        <td>
		<input type=text name="dspersonasactivar" size=2 maxlength="2" class="textos" value="<? echo $dspersonasactivar;?>">
        </td>
        </tr>



		<tr bgcolor="#FFFFFF">
        <td>REQUIERE CERTIFICADO DE INSCRIPCION
         <br> (CERTIFICADO DE INSCRIPCION)</td>
        <td>
		<select name=idcertinscripcion class=text1>
		<option value="" <? if ($idcertinscripcion==""){ echo "selected";}?>>---</option>

		<option value="1" <? if ($idcertinscripcion=="1"){ echo "selected";}?>>SI</option>
		<option value="2" <? if ($idcertinscripcion=="2"){ echo "selected";}?>>NO</option>
	    </select>
        </td>
        </tr>

		<tr bgcolor="#FFFFFF">
        <td>ACTIVAR IMPRESION DE CERTIFICADO DE INSCRIPCION
        <br>  (CERTIFICADO DE INSCRIPCION)</td>
        <td>
		<select name=idimprcertins class=text1>
		<option value="" <? if ($idimprcertins==""){ echo "selected";}?>>---</option>

		<option value="1" <? if ($idimprcertins=="1"){ echo "selected";}?>>SI</option>
		<option value="2" <? if ($idimprcertins=="2"){ echo "selected";}?>>NO</option>
	    </select>
        </td>
        </tr>








		<tr bgcolor="#FFFFFF">
        <td>REQUIERE CERTIFICADO DE VOTACION
        <br>  (CERTIFICADO DE VOTACION)</td>
        <td>
		<select name=idcertvotacion class=text1>
		<option value="" <? if ($idcertvotacion==""){ echo "selected";}?>>---</option>

		<option value="1" <? if ($idcertvotacion=="1"){ echo "selected";}?>>SI</option>
		<option value="2" <? if ($idcertvotacion=="2"){ echo "selected";}?>>NO</option>
	    </select>
        </td>
        </tr>

		<tr bgcolor="#FFFFFF">
        <td>ACTIVAR IMPRESION DE CERTIFICADO DE VOTACION
        <br>  (CERTIFICADO DE VOTACION)</td>
        <td>
		<select name=idimprcervot class=text1>
		<option value="" <? if ($idimprcervot==""){ echo "selected";}?>>---</option>

		<option value="1" <? if ($idimprcervot=="1"){ echo "selected";}?>>SI</option>
		<option value="2" <? if ($idimprcervot=="2"){ echo "selected";}?>>NO</option>
	    </select>
        </td>
        </tr>






	    <tr bgcolor="#FFFFFF">
        <td>MOSTRAR FOTO DEL CANDIDATO
        <br>  (RESULTADOS)</td>
        <td>
		<select name=idmostrarfoto class=text1>
		<option value="" <? if ($idmostrarfoto==""){ echo "selected";}?>>---</option>

		<option value="1" <? if ($idmostrarfoto=="1"){ echo "selected";}?>>SI</option>
		<option value="2" <? if ($idmostrarfoto=="2"){ echo "selected";}?>>NO</option>
	    </select>
        </td>
        </tr>

        <tr bgcolor="#FFFFFF">
        <td>MOSTRAR FICHA TECNICA
        <br>  (RESULTADOS)</td>
        <td>
		<select name=idmostrarficha class=text1>
		<option value="" <? if ($idmostrarficha==""){ echo "selected";}?>>---</option>

		<option value="1" <? if ($idmostrarficha=="1"){ echo "selected";}?>>SI</option>
		<option value="2" <? if ($idmostrarficha=="2"){ echo "selected";}?>>NO</option>
	    </select>
        </td>
        </tr>

		<tr bgcolor="#FFFFFF">
        <td>MOSTRAR NUMERO DE VOTOS
        <br>  (RESULTADOS)</td>
        <td>
		<select name=idmostrarvotos class=text1>
		<option value="" <? if ($idmostrarvotos==""){ echo "selected";}?>>---</option>

		<option value="1" <? if ($idmostrarvotos=="1"){ echo "selected";}?>>SI</option>
		<option value="2" <? if ($idmostrarvotos=="2"){ echo "selected";}?>>NO</option>
	    </select>
        </td>
        </tr>

		<tr bgcolor="#FFFFFF">
        <td>MOSTRAR PORCENTAJE DE VOTOS
        <br>  (RESULTADOS)</td>
        <td>
		<select name=idmostrarporcvotos class=text1>
		<option value="" <? if ($idmostrarporcvotos==""){ echo "selected";}?>>---</option>

		<option value="1" <? if ($idmostrarporcvotos=="1"){ echo "selected";}?>>SI</option>
		<option value="2" <? if ($idmostrarporcvotos=="2"){ echo "selected";}?>>NO</option>
	    </select>
        </td>
        </tr>


		<tr bgcolor="#FFFFFF">
        <td>MOSTRAR TOTALES
        <br>  (RESULTADOS)</td>
        <td>
		<select name=idmostrartotales class=text1>
		<option value="" <? if ($idmostrartotales==""){ echo "selected";}?>>---</option>

		<option value="1" <? if ($idmostrartotales=="1"){ echo "selected";}?>>SI</option>
		<option value="2" <? if ($idmostrartotales=="2"){ echo "selected";}?>>NO</option>
	    </select>
        </td>
        </tr>




<tr valign=top bgcolor="#FFFFFF">
<td>ACTIVAR?</td>
<td>
	<select name=idactivo class=text1>
		  <option value="" <? if ($idactivo=="") echo "selected";?>>---</option>

		  <option value="1" <? if ($idactivo==1) echo "selected";?>>SI</option>
		  <option value="2" <? if ($idactivo==2) echo "selected";?>>NO</option>
		  <option value="3" <? if ($idactivo==3) echo "selected";?>>Demo</option>

	</select>

</td>
</tr>

<tr bgcolor="#FFFFFF">
        <td>MENSAJE CUANDO SE ACTIVE LOS ESCRUTINIOS</td>
        <td>
		<textarea cols=60 rows=10 name="dstexto" class="textos"><? echo $dstexto?></textarea>
		</td>
        </tr>


<tr>
	<td align="center" colspan="2" background="../../img_modulos/cf_diseno_r2_c2.jpg">
<?
$forma="u";
$param="dspersonasactivar";
include($rutxx."../../incluidos_modulos/botones.modificar.php");?>
<input type="hidden" name="idx" value="<? echo $idx?>">
</td>
</tr>
</form>

</table>
<br>

</td>
</tr>
</table>
<a name="video"></a>
<?

?>
<?
} // fin si
$result->Close();
?>
<br>
<? include($rutxx."../../incluidos_modulos/modulos.remate.php");?>

</body>
</html>