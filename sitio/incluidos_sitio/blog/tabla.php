<?
/*
| ----------------------------------------------------------------- |
CF-informer
Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c)
Medellin - Colombia
=====================================================================
  Autores:
  Area Investigacion y Desarrollo
  Area Diseno y Maquetacion
  Area Mercadeo
=====================================================================
| ----------------------------------------------------------------- |
*/
// Tabla central de datos cuando se hacen los listados
$activarcategoria=1;
	include($rutxx."../../incluidos_modulos/modulos.buscador.php");
	include($rutxx."../../incluidos_modulos/paginar.variables.php");
		include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");
     $result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
	if (!$result->EOF) {

?>
<br>
<table width="100%" border="0" cellpadding="2" cellspacing="1" align="center" class="text1">
<form action="<? echo $pagina;?>" method=post name=p>
<?
// encabezado generico basado

		$sqlxx="select a.idactivocat from blogtbladmin a where a.idactivocat=1";
		$resultxx=$db->Execute($sqlxx);
		if($resultxx->EOF){
$nombrecampos="Id,Titulo,Posici&oacute;n,Activo";
		}else{
$nombrecampos="Id,Titulo,Categorias,Posici&oacute;n,Activo";
		}
	$resultxx->Close();

include($rutxx."../../incluidos_modulos/tabla.encabezado.php");
$contar=0;
	while (!$result->EOF && ($contar<$maxregistros)) {
		if ($contar%2==0) {
			$fondo=$fondo1;
		} else {
			$fondo=$fondo2;
		}
		// total comentarios por cada uno
		$com="";
		$sql="select count(*) as total from blogtblcomentarios where idr=".$result->fields[0];
			$resultx=$db->Execute($sql);
			if(!$resultx->EOF){
				$com="(".$resultx->fields[0].")";
				if ($resultx->fields[0]=="") $com="";
			}
			$resultx->Close();

		?>
		 <tr bgcolor="<? echo $fondo?>" onMouseOut="mOut(this,'<? echo $fondo;?>');" onMouseOver="mOvr(this,'<? echo $fondo3;?>');" >
		  <td align="center" width="15%">
		  <input type="text" name="id_[]" value="<? echo $result->fields[0]?>" size="2" readonly class="textnegro">
			</td>
			  <td align="center">
		  <input type="text" name="dsm_[]" value="<? echo $result->fields[1]?>" size="50" class="textnegro" maxlength="100">
			</td>


		<?
		$sqlxx="select a.idactivocat from blogtbladmin a where a.idactivocat=1";
		$resultxx=$db->Execute($sqlxx);
		if(!$resultxx->EOF){

		?>

			<td align="center">
		<select name="idcategoria_[]" class=text1>
			<?
			$sqlx="select id,dsm from blogtblcategorias where idactivo=1";
			//echo $sql;
			$resultx=$db->Execute($sqlx);
			if(!$resultx->EOF){
			?>
			<option value="">Seleccione la categoria</option>
			<?
			while(!$resultx->EOF){
			$idm=$resultx->fields[0];
			$dsm=reemplazar($resultx->fields[1]);
			?>
				<option value="<? echo $idm?>" <? if ($idm==$result->fields[4]) echo "selected";?>><? echo ucfirst(strtolower($dsm)); ?></option>
			<?
			$resultx->MoveNext();
			}
			}
			$resultx->Close();
			?>
		</select>
		</td>

		<?
		}
		$resultxx->Close();
	?>


		  <td align="center">
		  <input type="text" name="idpos_[]" value="<? echo $result->fields[2]?>" onkeypress="return numero(event);"  size="2" class="textnegro" maxlength="8">
			</td>
		  <td align="center">
			  <select name="idactivo_[]" class="textnegro">
					<option value="1" <? if ($result->fields[3]==1) echo "selected";?>>SI</option>
					<option value="2" <? if ($result->fields[3]==2) echo "selected";?>>NO</option>
					<option value="3" <? if ($result->fields[3]==3) echo "selected";?>>DESTACADO PRINCIPAL</option>
			</select>
		  </td>
		  <td align="center">

		  <?
		  $rutax="../comentariosblog/default.php?idtema=".$result->fields[0];
		  $trutax="Click para ver comentarios asociados";
		  $mrutax=" Comentarios $com";

		  include($rutxx."../../incluidos_modulos/enlace.generico.php");?>
		  |


		  <?
		  $rutax="editar.php?idx=".$result->fields[0];
		  include($rutxx."../../incluidos_modulos/enlace.detalles.php");?>
		  |


		   <?
		  $rutax="../../cms/galeria/default.php?idevento=".$result->fields[0];
		  $trutax="Click para ver comentarios asociados";
		  $mrutax=" Galeria ";

		  include($rutxx."../../incluidos_modulos/enlace.generico.php");?>
		  |


		  <?
	  $rutax=$pagina."?idx=".$result->fields[0];
		  $formax="";
		  include($rutxx."../../incluidos_modulos/enlace.eliminar.php");?>
		  </td>

			</tr>

		<?
		$contar++;
		$result->MoveNext();
	} // fin while
?>
<tr><td colspan=<? echo $total?> align="center">
<input type=submit name=enviar value="Modificar datos"  class="botones">
<input type=hidden name=idcategoriabase value="<? echo $idcategoriabase?>">

</td></tr>
</form>

</table>
<?
	} // fin si
$result->Close();
?>