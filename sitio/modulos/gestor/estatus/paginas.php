<a name="paginas"></a>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="6" align="left" valign="top">
          	<img src="../../../img_modulos/modulos/titulo_r1_c1.jpg" width="6" height="22" />
          </td>
          <td width="615" align="left" valign="middle" background="../../img_modulos/modulos/franja_grisoscuro_r1_c2.jpg" class="titulo_negro">Listado de paginas actuales.
          	<a href="../cms/paginas/default.php">Modulo</a>
          </td>
        </tr>
</table>
<?
$tabla=$prefix."tblpaginas";
$rutaImagen="../../../imagenes/paginas/";
$sql="select * from $tabla a where id>0 ";
$sql.=" order by a.dsm asc ";
	$result=$db->Execute($sql);
	if (!$result->EOF) {
		include("paginas.tabla.php");
	} // fin si
$result->Close();

?>