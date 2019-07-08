<?

// Listado de los modulos autorizados basandose en los permisos de usuarios

if ($_SESSION['i_idperfil']==1) {
	$sql="select ";
	$sql.="a.dsm,a.dsd,a.dsr,a.dsimg1,a.dsimg2,a.dstabla ";
	$sql.=" from tblmodulos a ";
	$sql.=" where 1  ";
	$sql.=" and a.idactivo=3 ";
	$sql.=" order by a.idpos ASC ";
}elseif ($_SESSION['i_idperfil']==4) {
	$sql="select ";
	$sql.="a.dsm,a.dsd,a.dsr,a.dsimg1,a.dsimg2,a.dstabla ";
	$sql.=" from tblmodulos a inner join tblusuariosxtblmodulos b on a.id=b.iddestino";
	$sql.=" where 1  ";
	$sql.=" and a.idactivo=3 and b.idorigen=".$_SESSION['i_idusuario'];
	$sql.=" order by a.dsm ASC ";
	//echo $sql;
}else {
	// menu cargado dinamicamente desde base de datos
	$sql="select ";
	$sql.="a.dsm,a.dsd,a.dsr,a.dsimg1,a.dsimg2,a.dstabla";
	$sql.=" from tblmodulos a, tblrelaciones b ";
	$sql.=" where 1  ";
	$sql.=" and a.idm=b.idprimero  ";
	$sql.=" and b.idsegundo=".$_SESSION['i_idusuario'];
	$sql.=" and b.idtipo=1 ";
	$sql.=" and a.idactivo=3";
	$sql.=" order by a.idpos ASC ";

}
//echo $sql;
 $result = $db->Execute($sql);
			 if (!$result->EOF) {

?>

      <table width="95%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="6" align="left" valign="top"><img src="../../img_modulos/modulos/titulo_r1_c1.jpg" width="6" height="22" /></td>
          <td width="615" align="left" valign="middle" background="../../img_modulos/modulos/franja_grisoscuro_r1_c2.jpg" class="titulo_negro">MODULOS DEL SISTEMA</td>
        </tr>
      </table>

	  	<table width="95%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td align="center" valign="top" bgcolor="#FFFFFF">

	  <? while (!$result->EOF) {
	  	 $dsm=$result->fields[0];
		 $dsd=$result->fields[1];
		 $dsr=$result->fields[2];
		 $dsimg1=$result->fields[3];
		 if ($dsimg1<>"") $dsimg1=$rutabase."iconos/".$dsimg1;
		 if ($dsimg1=="") $dsimg1=$icono1;
		 $dsimg2=$result->fields[4];
		 if ($dsimg2<>"") $dsimg2=$rutabase."iconos/".$dsimg2;
 		 if ($dsimg2=="") $dsimg2=$icono2;
		 $dstabla=$result->fields[5];
		 if (is_file($dsr)) {
		 // total de datos encontrados por cada modulos
		 $totales="--";
		 if ($dstabla<>"" && $dstabla<>"0" )  $totales=total_modulos($dstabla);
	  ?>

<br />

              <table width="95%" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="57" align="left" valign="top" background="../../img_modulos/modulos/bot_opciones_r1_c1.jpg">
                  	<a href="<? echo $dsr?>"
                  	 onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image_<? echo $dsm;?>','','<? echo $dsimg2?>',1)" title="<? echo $dsd?>">
                  	 <img src="<? echo $dsimg1?>" name="Image_<? echo $dsm?>" width="57" height="37" border="0" id="Image_<? echo $dsm;?>" />
                  	</a>
                  </td>

                  <td align="left" valign="middle" background="../../img_modulos/modulos/bot_opciones_r1_c1.jpg">
                  	<a href="<? echo $dsr?>"
                  	class="texto_normal1" title="<? echo $dsd?>"><? echo $dsm?>
                  	</a>
              	  </td>

                  <td width="41" align="center" valign="middle" background="../../img_modulos/modulos/bot_opciones_r1_c1.jpg">
                  	<a href="<? echo $dsr;?>" class="texto_link1"><? echo $totales;?>
                  	</a>
                  </td>

                  <td width="5" align="left" valign="top">
                  	<img src="../../img_modulos/modulos/bot_opciones_r1_c2.jpg" width="5" height="37" />
                  </td>
                </tr>
              </table>
              <table width="95%" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="2"></td>
                </tr>
              </table>

			  <?
			 } // fin si deteccion de modulo
			  	$result->MoveNext();

			   } // fin while
			  ?>
			  <br>

</td>
</tr>
</table>


              <br />
<?
}
 $result->close();
?>