<?
$rutx=1;
if($rutx==1) $rutxx="../";

include ($rutxx."../../incluidos_modulos/comunes.php");
include ($rutxx."../../incluidos_modulos/varconexion.php");
include ($rutxx."../../incluidos_modulos/sessiones.php");
include ($rutxx."../../incluidos_modulos/funciones.php");
include ($rutxx."../../incluidos_modulos/func.calendario_2.php"); // funcion nueva del calendario


?>
<html>
<head>
<title>Reportes</title>
  <script type="text/javascript">
  
    function OpenLinkClose(ruta)
    {

      window.opener.document.location.href=ruta;
      window.close();

    }

  </script>
  <link rel="stylesheet" href="<?echo $rutxx?>../../css_modulos/estilos.modulos.css">
  <link rel="stylesheet" href="<?echo $rutxx?>../../css_modulos/estilos.admon.css">
  <link rel="stylesheet" href="<?echo $rutxx?>../../css_modulos/style.consola.css">
  <link rel="stylesheet" href="<?echo $rutxx?>../../css_modulos/style.frm.consola.css">
<? include ($rutxx."../../incluidos_modulos/javageneral.php"); ?>
</head>
<body color=#ffffff  topmargin=5 leftmargin=0>

<section class="cont_general">

<div id="capa_impresion" align=center>
<!--a href="javascript:imprimir();">Imprimir</a--><a href="javascript:window.close();" class="botones2">Cerrar esta ventana</a>
</div>
<div id="capa_impresion" align=center>
<h1>
<?
$dsnombre=seldato('nombre_o_razn_social','id','crm_clientes',$_REQUEST['id'],1);
$dsapellido=seldato('apellido_o_nombre_comercial','id','crm_clientes',$_REQUEST['id'],1);
echo strtoupper($dsnombre." ".$dsapellido) ;
  ?>
</h1>
</div>

<?
    $rutaImagend=$rutxx."../../../contenidos/images/empresa/";
    $rutaImagend2="../../../contenidos/images/logo_empresa/";

    $sqld="select id,dsnombre,dsimg1,copyright,dstitulo,codcliente from tblempresa where id=1";
    $resultd=$db->Execute($sqld);
    if(!$resultd->EOF){
    $id=$resultd->fields[0];
    $dsmempresa=reemplazar($resultd->fields[1]);
    $dsimg1empresa=$resultd->fields[2];
    $derechos=reemplazar($resultd->fields[3]);
    $dstituloempresa=reemplazar($resultd->fields[4]);
    $codcliente=reemplazar($resultd->fields[5]);


?>


<table width="100%" border="0">
	<tr>
		<td align="center">
            <?
            if(is_file($rutaImagend.$dsimg1empresa)){ ?>

            <img src="<? echo $rutaImagend.$dsimg1empresa ?>" >
             <? }elseif (is_file($rutaImagend2.$dsimg1empresa)){ ?>
      <img src="<? echo $rutaImagend2.$dsimg1empresa ?>" >

             <? } else {?>
            <br>
            <? echo $dstituloempresa?>
            <br>
            <? echo $derechos ?>
            <? } ?>

</td>

	</tr>
</table>
            <?
            }
            $resultd->Close();
            ?>



<table width="100%" border="0" cellspacing="0" cellspacing="0" class="encabezado_tabla" >
   <tr  valign="top">
      <td>GESTIONES REALIZADAS</td>
    </tr>
</table>

<table width="100%" border="0" cellspacing="0" class="text1">

    <tr class="tbl_cbz_lista" valign="top" align="center">
    	<td >Fecha de registro</td>
      <td >Observaciones</td>
      <td >Motivo</td>
      <td >Fecha cuando debio contactarlo</td>
      <td >Estado</td>
      <td >Usuario que gestiono</td>
      <td >Usuario que asocio gestion</td>
    </tr>
<?
 $sql="select a.id,a.idactivo,a.dsd,a.dsfechal,a.usuario,a.idregistra,a.idmotivo,a.dsfechallamada";
 $sql.=" from framecf_tblgestionesxusuario a WHERE ";
  $sql.=" a.idcliente='".$_REQUEST['id']."' ";
 // $sql.="AND a.idcliente=b.id AND a.dsfechai='".date('Y/m/d')."' ORDER BY a.id DESC LIMIT 0,5 ";
  //echo $sql;
  $result=$db->Execute($sql);
        if(!$result->EOF) {
           while(!$result->EOF) {

            $id=$result->fields[0];
            $estado=$result->fields[1];
            $dsd=$result->fields[2];
            $fecha=$result->fields[3];
            $usuario=$result->fields[4];
            $idregistra=$result->fields[5];
            $dsregistra=seldato("b.dsm","b.id"," tblusuarios b ",$idregistra,1);
            if ($idregistra==999) $dsregistra="Sitio Web";
            $idmotivo=$result->fields[6];
            $dsmotivo=seldato("b.dsnombre","b.id"," crmtblmotivos b ",$idmotivo,1);

            $dsfechallamada=$result->fields[7];


?>
  <tr valign="top" align="center" onMouseOut="mOut(this,'<? echo $fondo;?>');" onMouseOver="mOvr(this,'#f3f3f3');">

  <td><? echo $fecha;?></td>
  <td><? echo $dsd;?></td>
  <td><? echo $dsmotivo;?></td>
  <td><? echo $dsfechallamada;?></td>

  <td><?
    if($estado==0)echo "En proceso";
    if($estado==1)echo "Realizada";
    if($estado==2)echo "Cancelada";
    if($estado==3)echo "Anulada";
  	?>
  </td>
  <td><? echo seldato('dsm','id','tblusuarios',$usuario,2); ?></td>
  <td><? echo $dsregistra; ?></td>

  </tr>
<?
$result->MoveNext();
}
}else{
  ?>
   <tr valign="top">
    <td colspan="4">NO TIENE GESTIONES</td>
  </tr>
<?
}
$result->Close();

?>
  </table>


 <table width="100%" border="0" cellspacing="0" class="encabezado_tabla">
     <tr  valign="top">
            <td>ACTIVIDADES</td>
      </tr>
 </table>



<table width="100%" border="0" cellspacing="0" class="text1">

    <tr class="tbl_cbz_lista" valign="top">
        <td width="14%">Fecha</td>
        <td width="14%">Hora</td>
        <td width="14%">Prox&iacute;ma visita</td>
        <td width="14%">Observaciones</td>
        <td width="14%">Gesti&oacute;n</td>
        <td width="14%">Estado</td>
        <td width="14%">Asesor</td>
    </tr>
<?
 $sql="SELECT a.dsfechai,a.idcliente,a.idmedio,a.dsresena,a.idusuario,a.idactivo,dshorai,dshoraf,dsfechap FROM crmtblvisitas a, crm_clientes b WHERE ";
  $sql.=" a.idcliente='".$_REQUEST['id']."'";
  $sql.="AND a.idcliente=b.id  ORDER BY a.id DESC LIMIT 0,5 ";
 // echo $sql;
  $result=$db->Execute($sql);
        if(!$result->EOF) {
           while(!$result->EOF) {
            $fecha=$result->fields[0];
            $cliente=$result->fields[1];
            $idmedio=$result->fields[2];
            $obs=$result->fields[3];
            $usuario=$result->fields[4];
             $estado=$result->fields[5];

             $horai=$result->fields[6];
             $horaf=$result->fields[7];
             $dsfechap=$result->fields[8];

?>
    <tr valign="top" align="center" onMouseOut="mOut(this,'<? echo $fondo;?>');" onMouseOver="mOvr(this,'#f3f3f3');">
      <td><? echo $fecha;?></td>
      <td><? echo $horai." ".$horai;?></td>
      <td><? echo $dsfechap;?></td>
      <td><? echo reemplazar($obs);?></td>
      <td><? echo seldato('dsnombre','id','crmtblgestiones',$idmedio,2);?></td>
      <td>
      	<?
          if($estado==0)echo "En proceso";
          if($estado==1)echo "Realizada";
          if($estado==2)echo "Cancelada";
          if($estado==3)echo "Anulada";
        	?>
      </td>
      <td><? echo seldato('dsm','id','tblusuarios',$usuario,2); ?></td>
    </tr>
<?
$result->MoveNext();
}
}else{
  ?>
   <tr  valign="top">
    <td colspan="4">NO TIENE ACTIVIDADES</td>
  </tr>
<?
}
$result->Close();

?>
  </table>

<table width="100%" border="0" cellspacing="0" class="encabezado_tabla" >
   <tr  valign="top">
          <td>COTIZACIONES</td>
    </tr>
</table>



<table width="100%" border="0" cellspacing="0" class="text1">

  <tr class="tbl_cbz_lista" valign="top" align="center">
      <td width="20%">Numero</td>
      <td width="20%">Fecha</td>
      <td width="20%">Observaciones</td>
      <td width="20%">Estado</td>
      <td width="20%">Asesor</td>
  </tr>
<?
//$db->debug=true;
 $sql="select dsfecha, observaciones, asesor_operativo,estado_cotizacion,id from crm_cotizaciones b where ";
  $sql.=" b.cliente_asociado='".$_REQUEST['id']."'";
  $sql.="ORDER BY b.id DESC  ";
 // echo $sql;
  $result=$db->Execute($sql);
        if(!$result->EOF) {
           while(!$result->EOF) {
            $fecha=$result->fields[0];
            $obs=$result->fields[1];
            $usuario=$result->fields[2];
            $estado=$result->fields[3];
            $idcot=$result->fields[4];
            $idestado=seldato('estado_cotizacion','id','crm_cotizaciones',$idcot,1);
            $dsestado=seldato('estado','id','crm_estado_cotizaciones',$idestado,1);

?>
                  <tr onclick="OpenLinkClose('../../core.asesor/default.php?buscarpor=<? echo $idcot; ?>&paramBus=1&UsuarioBus=&fechaini=&fechafin=&estado=<? echo $dsestado; ?>');" valign="top" align="center" onMouseOut="mOut(this,'<? echo $fondo;?>');" onMouseOver="mOvr(this,'#f3f3f3');">
                    <td>
                      <a href="">
                       <? echo $idcot;?>
                      </a>
                    </td>
                    <td><? echo $fecha;?></td>
                    <td title="<? echo (strip_tags($obs)); ?>">
                          <? echo ellistr($obs, 170); ?>
                    </td>
                    <td>
                      <?
                     echo  seldato('estado','id','crm_estado_cotizaciones',$estado,1);

                        ?>
                    </td>
                    <td><? echo seldato('dsm','id','tblusuarios',$usuario,2);  ?></td>
                  </tr>
<?
$result->MoveNext();
}
}else{
  ?>
   <tr valign="top">
    <td colspan="4">NO TIENE COTIZACIONES</td>
  </tr>
<?
}
$result->Close();

?>
  </table>


<table width="100%" border="0" cellspacing="0" class="encabezado_tabla" >
  <tr  valign="top">
    <td>SEGUIMIENTOS</td>
  </tr>
</table>

<table width="100%" border="0" cellspacing="0" class="text1">

<tr class="tbl_cbz_lista" valign="top" align="center">
   <td width="20%">Fecha de registro</td>
   <td width="20%">Tipo de seguimiento</td>
   <td width="20%">Observaci&oacute;n</td>
   <td width="20%">Frecha proximo contacto</td>
   <td width="20%">Cotizaci&oacute;n</td>
</tr>
<?
//$db->debug=true;
$sql="select id from crm_cotizaciones where cliente_asociado='".$_REQUEST['id']."' ";
  $resultxx=$db->Execute($sql);
        $contar=0;
        if(!$resultxx->EOF) {
           while(!$resultxx->EOF) {
            $idcotizaciones=$result->fields[0];

 $sql=" select b.tipo_de_seguimiento, b.resultado_seguimiento, b.dsfecha, b.numero_de_cotizacion, b.fecha_proxima_de_contacto ";
 $sql.=" from crm_seguimientos_de_cotizaciones b where b.numero_de_cotizacion = '".$idcotizaciones."'  ";
  $sql.=" order by b.dsfecha DESC ";
 // echo $sql;
  $result=$db->Execute($sql);
        if(!$result->EOF) {

           while(!$result->EOF) {

            $ResulObs=$result->fields[1];
            $dsfecha=$result->fields[2];
            $numcot=$result->fields[3];
            $dsfechaprox=$result->fields[4];
            $tiposeguimiento= seldato('nombre','id','crm_seguimientos',$result->fields[0],1);

?>
<tr valign="top" align="center" onMouseOut="mOut(this,'<? echo $fondo;?>');" onMouseOver="mOvr(this,'#f3f3f3');">
  <td><? echo $dsfecha ;  ?></td>
  <td><? echo $tiposeguimiento ; ?></td>
  <td><? echo $ResulObs; ?></td>
  <td><? echo $dsfechaprox ; ?></td>
  <td><? echo $idcotizaciones; ?></td>
</tr>
<?
$contar++;
$result->MoveNext();
}

$result->Close();
}elseif($contar==0){
  ?>
   <tr valign="top">
    <td colspan="4">NO TIENE SEGUIMIENTOS</td>
  </tr>
<?
$contar++;
}

$resultxx->MoveNext();
  }

$resultxx->Close();
}else{
  ?>
   <tr valign="top">
    <td colspan="4">NO TIENE SEGUIMIENTOS</td>
  </tr>
<?
}

?>
  </table>

  <table width="100%" border="0" cellspacing="0" class="encabezado_tabla">
       <tr  valign="top">
          <td>CAMPA&Ntilde;AS ASOCIADA</td>
        </tr>
   </table>



<table width="100%" border="0" cellspacing="0" class="text1">

  <tr class="tbl_cbz_lista" valign="top" align="center" >
     <td width="25%">Fecha inicial</td>
     <td width="25%">Fecha final</td>
     <td width="25%">Campa&ntilde;a</td>
     <td width="25%">Preferencias</td>
  </tr>
<?
//$db->debug=true;
$sql="select campaa_asociada from crm_campa_por_cliente where cliente_asociado='".$_REQUEST['id']."' group by campaa_asociada ";
  $resultxz=$db->Execute($sql);
        if(!$resultxz->EOF) {
           while(!$resultxz->EOF) {
            $idcampana=$resultxz->fields[0];

    $sqlprefe="select filtro_asociado,tipo_de_filtro from crm_campa_por_cliente where cliente_asociado='".$_REQUEST['id']."' and campaa_asociada = $idcampana group by campaa_asociada ";

    $resutlprefe=$db->Execute($sqlprefe);

    if(!$resutlprefe->EOF)
    {
      $prefeasoc='';
      while(!$resutlprefe->EOF)
      {
        $idfiltro=$resutlprefe->fields[0];
        $idtipofiltro=$resutlprefe->fields[1];

        if($idtipofiltro=='1'){
         $campo="nombre";
         $tabla="crm_preferencias";
         }
        if($idtipofiltro=='2'){
         $campo="titulo";
         $tabla="crm_productos_y_servicios";
       }
        if($idtipofiltro=='3')
        {
          $campo="titulo";
          $tabla="crm_servicios";
        }


      $prefeasoc.=seldato($campo,'id',$tabla,$idfiltro,1);


      $resutlprefe->MoveNext();
      }

    }
    $resutlprefe->Close();

 $sql=" select a.descripcion, a.fecha_inicial ,a.fecha_final ";
 $sql.=" from crm_campaas a where id= '".$idcampana."'  ";
 // echo $sql;
  $resultYC=$db->Execute($sql);
        if(!$resultYC->EOF) {
           while(!$resultYC->EOF) {

            $dsdcampa=$resultYC->fields[0];
            $fechaini=$resultYC->fields[1];
            $fechafin=$resultYC->fields[2];


?>                  <tr valign="top" align="center" onMouseOut="mOut(this,'<? echo $fondo;?>');" onMouseOver="mOvr(this,'#f3f3f3');">
                    <td><? echo $fechaini ;  ?></td>
                    <td><? echo $fechafin ; ?></td>
                    <td><? echo $dsdcampa; ?></td>
                    <td><? echo $prefeasoc ; ?></td>
                  </tr>
<?
$resultYC->MoveNext();
}
}else{
  ?>
   <tr valign="top">
    <td colspan="4">NO ESTA ASOCIADO A NINGUNA CAMPA&Ntilde;A</td>
  </tr>
<?
}
$resultYC->Close();

$resultxz->MoveNext();
  }

$resultxz->Close();
}else{
  ?>
   <tr valign="top">
    <td colspan="4">NO ESTA ASOCIADO A NINGUNA CAMPA&Ntilde;A</td>
  </tr>
<?
}

?>
  </table>

  <? include('reporte.formularios.php');?>
</section>


</body>
</html>

