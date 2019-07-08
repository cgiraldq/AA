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
if($rutx==1) $rutxx="../";
include($rutxx."../../incluidos_modulos/modulos.globales.php");

$titulomodulo="Configuraci&oacute;n del blog";
$rr="default.php";
$idx=$_REQUEST['idx'];
$tabla="blogtbladmin";
$rutaImagen=$rutxx."../../../contenidos/images/redes/";



			$dsm=$_REQUEST['dsm'];

			$idactivo=$_REQUEST['idactivo'];
			$idactivocat=$_REQUEST['idactivocat'];
			$idactivocom=$_REQUEST['idactivocom'];
			$idactivoing=$_REQUEST['idactivoing'];
			$idmodulo=$_REQUEST['idmodulo'];
			$idcat=$_REQUEST['idcat'];



			$paso=$_REQUEST['paso'];
			if ($paso=="1") {

					if($_REQUEST['idactivo']==1 and $idmodulo==0){

						///////// Crea el desplegable con el titulo BLOG
						$sqlx="insert into tblmodulos (dsm,idpos,idactivo,idmodulo)";
						$sqlx.=" values ('BLOG','1','1','0') ";
						$db->Execute($sqlx);
						$idmodulo=mysql_insert_id();

						//////////// crea el modulo con el titulo autores
						$sqlx="insert into tblmodulos (dsm,idpos,idactivo,idmodulo,dsr,dstabla)";
						$sqlx.=" values ('Autores blog','1','3','$idmodulo','../blog/autoresblog/default.php','blogtblautores') ";
						$db->Execute($sqlx);
						//////// crea el modulo con el titulo publicar blog
						$sqlxx="insert into tblmodulos (dsm,idpos,idactivo,idmodulo,dsr,dstabla)";
						$sqlxx.=" values ('Publicar Blog','1','3','$idmodulo','../blog/blog/default.php','blogtblblog') ";
						//echo $sqlxx;
						$db->Execute($sqlxx);

					}

					if($_REQUEST['idactivocat']==1 and $idcat==0){
						$sqlx="insert into tblmodulos (dsm,idpos,idactivo,idmodulo,dsr,dstabla)";
						$sqlx.=" values ('Categorias','1','3','$idmodulo','../blog/categoriasblog/default.php','blogtblcategorias') ";
						//echo $sqlx;
						$db->Execute($sqlx);
					    $idcat=mysql_insert_id();
						//exit();
						}

						if($_REQUEST['idactivocat']==2){
						$sqlx="delete from tblmodulos where id=$idcat";

						//echo $sqlx;
						$db->Execute($sqlx);
					    $idcat=mysql_insert_id();
						//exit();
						}



					if($_REQUEST['idactivo']<>1){
						$sqlx="delete from tblmodulos where id='$idmodulo' ";

						$db->Execute($sqlx);

						if($_REQUEST['idmodulo']<>0){
						$sqlx="delete from tblmodulos where idmodulo='$idmodulo' ";
						$idmodulo="";
						$idactivocat=2;
						$db->Execute($sqlx);
					}

					}

					$sql=" update $tabla set ";
					$sql.=" dsm='$dsm'";
					$sql.=",idactivo='$idactivo'";
					$sql.=",idactivocat='$idactivocat'";
					$sql.=",idactivocom='$idactivocom'";
					$sql.=",idactivoing='$idactivoing'";
					$sql.=",idmodulo='$idmodulo' ";
					$sql.=",idcat='$idcat' ";

					$sql.=" where id=".$idx;
					//echo $sql;

			//exit();

					if ($db->Execute($sql))  {



						$error=0;

						$mensajes=$men[6];
						// cargar auditoria
						$dstitulo="Modificacion $titulomodulo, $dsm";
						$dsdesc=" El usuario ".$_SESSION['i_dslogin']." modifico un registro";
						$dsruta="../redes/default.php";
						//include($rutxx."../../incluidos_modulos/logs.php");
					}	else {
						$mensajes=$men[7];
						$error=1;

					}
			}



?>
<html>
		<?include($rutxx."../../incluidos_modulos/head.php");?>
<body>

	<? include($rutxx."../../incluidos_modulos/navegador.principal.php");
	// generacion del encabezado de acuerdo a los resultados encontrados
$sql="select a.dsm,a.idactivo,a.idactivocat,a.idactivocom,a.idactivoing,a.idmodulo,a.idcat";
$sql.=" from $tabla a ";
$sql.=" where a.id=$idx ";
//echo $sql;
$result = $db->Execute($sql);
if (!$result->EOF) {
$totalregistros=$result->RecordCount();
$rutamodulo="<a href='$rutxx../core/default.php' class='textlink' target='_top' title='Principal'>Principal</a>  /  ";
$rutamodulo.="  <a href='default.php' class='textlink'>$titulomodulo</a>  /  <span class='text1'>Modificar</span>";
include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");
$dsm=$result->fields[0];
$idactivo=$result->fields[1];
$idactivocat=$result->fields[2];
$idactivocom=$result->fields[3];
$idactivoing=$result->fields[4];
$idmodulo=$result->fields[5];
$idcat=$result->fields[6];


?>
	<? include($rutxx."../../incluidos_modulos/encabezado.editar.php");?>


	<table align="center"  cellspacing="1" cellpadding="5" border="0" width=70% class="campos_ingreso">
<form action="<? echo $pagina;?>" method=post name=u enctype="multipart/form-data">


<tr valign=top bgcolor="#FFFFFF">
<td>Titulo del modulo</td>
<td>
<? $contadorx="dsm_counter";$valorx="255";$formax="u";$campox="dsm";?>
<input type=text name=dsm size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_dsm')" value="<? echo $dsm?>"
<? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_dsm";
$mensaje_capa="Debe ingresar el titulo";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr>


<tr valign=top bgcolor="#FFFFFF">
<td>Activar BLOG</td>
<td>
	<select  name="idactivo" class=text1>
		  <option value="1" <? if ($idactivo==1) echo "selected";?>>SI</option>
		  <option value="2" <? if ($idactivo==2) echo "selected";?>>NO</option>
	</select>

</td>
</tr>

<tr style="display:<? if($idactivo==1){ echo $visible="";}else{ echo$visible="none";}?>" valign=top bgcolor="#FFFFFF">
<td>Activar Categorias</td>
<td>
	<select name="idactivocat" class=text1>
		  <option value="1" <? if ($idactivocat==1) echo "selected";?>>SI</option>
		  <option value="2" <? if ($idactivocat==2) echo "selected";?>>NO</option>
	</select>

</td>
</tr>


<tr  style="display:<? if($idactivo==1){ echo $visible="";}else{ echo$visible="none";}?>" valign=top bgcolor="#FFFFFF">
<td>Activar validar comentarios</td>
<td>
	<select name="idactivocom" class=text1>
		  <option value="1" <? if ($idactivocom==1) echo "selected";?>>SI</option>
		  <option value="2" <? if ($idactivocom==2) echo "selected";?>>NO</option>
	</select>

</td>
</tr>

<tr  style="display:<? if($idactivo==1){ echo$visible="";}else{ echo$visible="none";}?>" valign=top bgcolor="#FFFFFF">
<td>Activar blog en ingles</td>
<td>
	<select name="idactivoing" class=text1>
		  <option value="1" <? if ($idactivoing==1) echo "selected";?>>SI</option>
		  <option value="2" <? if ($idactivoing==2) echo "selected";?>>NO</option>
	</select>

</td>
</tr>

<input type="hidden" name="idmodulo" value="<? echo $idmodulo;?>">
<input type="hidden" name="idcat" value="<? echo $idcat;?>">
<tr><td align="center" colspan="2">
<?
$forma="u";
$param="dsm";
include($rutxx."../../incluidos_modulos/botones.modificar.php");?>
<input type="hidden" name="idx" value="<? echo $idx?>">
</td></tr>
</form>

</table>
<br>

</td>
</tr>
</table>
<?
} // fin si
$result->Close();
?>
<br>
<?
	include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
	include($rutxx."../../incluidos_modulos/modulos.remate.php");?>

</body>
</html>
