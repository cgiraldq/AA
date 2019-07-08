<table width="98%" border="0" cellpadding="0" cellspacing="0" >
             <tr class="btn_modulos" valign="top" align="">
                    <td><h1>Gestiones asociadas a usted</h1></td>
                    <td colspan="5" align="right">
                     <input type="submit" name="Agendamiento" class="botones" value="Agendamiento" title="Click para abrir el agendamiento">
                     <input type="button" onclick="irAPaginaD('../../core.asesor/default.php');" name="Principal_Asesor" class="botones" value="Principal Asesor" title="Click para ir a la principal del asesor">

                    </td>
              </tr>
         </table>

<table width="98%" border="0" cellpadding="0" cellspacing="0">


                  <tr class="tbl_cbz_core" valign="top" align="center" style="background:#fff">

                    <td>Cliente</td>
                    <td>Motivo</td>
                    <td>Observaciones</td>
                    <td>Cuando contactarlo</td>
                    <td>Estado</td>
                    <td>Usuario que lo gestiono</td>


                    <td>Opci&oacute;n</td>
                  </tr>
<?
  if($_REQUEST['idusuario']=="")$_REQUEST['idusuario']=$_SESSION['i_idusuario'];
 $sql="SELECT a.id,a.idcliente,a.dsd,a.dsfechal,b.nombre_o_razn_social,b.apellido_o_nombre_comercial,a.idactivo,a.dsfechallamada,a.idregistra,a.idmotivo";
 $sql.=" FROM framecf_tblgestionesxusuario a, crm_clientes b WHERE ";
  $sql.=" a.usuario='".$_REQUEST['idusuario']."' and b.id=a.idcliente and a.idactivo='0'";
 // $sql.="AND a.idcliente=b.id AND a.dsfechai='".date('Y/m/d')."' ORDER BY a.id DESC LIMIT 0,5 ";
  //echo $sql;
  $result=$db->Execute($sql);
        if(!$result->EOF) {
           while(!$result->EOF) {

            $id=$result->fields[0];
            $cliente=$result->fields[1];
            $dsd=$result->fields[2];
            $fecha=$result->fields[3];
            $nombre=$result->fields[4];
            $apellido=$result->fields[5];
            $estado=$result->fields[6];
            $fechallamada=$result->fields[7];
            $idregistra=$result->fields[8];
            $dsregistra=seldato("b.dsm","b.id"," tblusuarios b ",$idregistra,1);
            if ($idregistra==999) $dsregistra="Sitio Web";
            $idmotivo=$result->fields[9];
            $dsmotivo=seldato("b.dsnombre","b.id"," crmtblmotivos b ",$idmotivo,1);



?>
                  <tr class="tbl_cbz_core" valign="top" align="center">

                    <td><? echo $nombre." ".$apellido;?></td>
                    <td><? echo $dsmotivo;?></td>

                    <td><? echo $dsd;?></td>

                    <td><? echo $fechallamada;?></td>
                    <td><?
                      if($estado==0)echo "En proceso";
                      if($estado==1)echo "Realizada";
                      if($estado==2)echo "Cancelada";
                      if($estado==3)echo "Anulada";

                      ?>

                    </td>
                    <td><? echo $dsregistra;?></td>

                <td><a class="botones2" style="background: #4FB95E;color: #FFF;border-radius: 4px;" href="default.php?Agendamiento=Agendamiento&idgestion=<? echo $id;?>">Agendar</a></td>
                  </tr>
<?
$result->MoveNext();
}
}else{
  ?>
   <tr class="tbl_cbz_core" valign="top" align="center">
    <td colspan="4">NO TIENE GESTIONES PARA HOY</td>
  </tr>
<?
}
$result->Close();

?>
  </table>

<?
$idanio=$_REQUEST["idanio"];
$idmes=$_REQUEST["idmes"];
$iddia=$_REQUEST["iddia"];

$anho=$_REQUEST["anho"];
$mes=$_REQUEST["mes"];
$fechaxx=$anho."/".$mes;

$fechax=$idanio."/".$idmes."/".$iddia;

if($idanio=="" && $anho=="")$fechax=$fechaBase;
if($anho<>"" && $mes<>"")$fechax=$fechaxx;
?>


<table width="98%" border="0" cellpadding="0" cellspacing="0" >
             <tr class="btn_modulos" valign="top">
                    <td><h1>Cumplea&ntilde;os o aniversarios <? echo $fechax;?></h1></td>
                    <td colspan="5" align="right">

                      <input type="hidden" name="idgestion" value="<? echo $_REQUEST['idgestion'];?>">
                      <input type="hidden" name="idcliente" value="<? echo $_REQUEST['idcliente'];?>">

                      <!--a href="../crm/agenda/default.php">Crear agenda</a-->
                    </td>
              </tr>
  </table>

   <table width="98%" border="0" cellpadding="0" cellspacing="0">


                  <tr class="tbl_cbz_core" valign="top" align="center" style="background:#fff" >
                    <td>Nombre</td>
                    <td>Telefono</td>
                    <td >Celular</td>
                    <td >Email</td>
                  </tr>
<?

 $sql="SELECT a.nombre_o_razn_social,a.apellido_o_nombre_comercial,a.telfono_1,a.telfono_2,a.correo_email  FROM  crm_clientes a, tblusuarios b WHERE ";
  $sql.=" a.idusuario='".$_REQUEST['idusuario']."'";
  $sql.=" and a.idusuario=b.id and a.fecha_constitucin='$fechax' order by a.id desc ";
 //echo $sql;
  $result=$db->Execute($sql);
        if(!$result->EOF) {
           while(!$result->EOF) {
            $nombre=$result->fields[0];
            $apellido=$result->fields[1];
            $telefono=$result->fields[2];
            $celular=$result->fields[3];
            $email=$result->fields[4];

?>
                  <tr class="tbl_cbz_core" valign="top" align="center">

                    <td><? echo $nombre." ".$apellido;?></td>
                    <td><? echo $telefono?></td>
                    <td><? echo $celular;?></td>
                    <td><? echo $email;?></td>
                  </tr>
<?
$result->MoveNext();
}

}else{
  ?>
   <tr class="tbl_cbz_core" valign="top" align="center">
    <td colspan="4">En estos momentos no hay registros para el dia</td>
  </tr>
<?
}
$result->Close();

?>

   </table>


<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////////////  -->


 <table width="98%" border="0" cellpadding="0" cellspacing="0" >
             <tr class="btn_modulos" valign="top">
                    <td><h1>Listado de actividades</h1></td>

              </tr>
  </table>

          <table width="98%" border="0" cellpadding="0" cellspacing="0">


                  <tr class="tbl_cbz_core" valign="top" align="center" style="background:#fff" >
                    <td>Fecha</td>
                    <td>Cliente</td>
                    <td>Gesti&oacute;n</td>
                    <td >Observaciones</td>
                  </tr>
<?
 $sql="SELECT a.dsfechai,a.idcliente,a.idmedio,a.dsresena,b.nombre_o_razn_social,b.apellido_o_nombre_comercial  FROM crmtblvisitas a, crm_clientes b WHERE ";
  $sql.=" a.idusuario='".$_REQUEST['idusuario']."' and a.idactivo='0'";
  $sql.=" and a.idcliente=b.id and (a.dsfechai>='$fechaBase') order by a.id desc ";
 //echo $sql;
  $result=$db->Execute($sql);
        if(!$result->EOF) {
           while(!$result->EOF) {
            $fecha=$result->fields[0];
            $cliente=$result->fields[1];
            $idmedio=$result->fields[2];
            $obs=$result->fields[3];

            $nombre=$result->fields[4];
            $apellido=$result->fields[5];
?>
                  <tr class="tbl_cbz_core" valign="top" align="center">
                    <td><? echo $fecha;?></td>
                    <td><? echo $nombre." ".$apellido;?></td>
                    <td><? echo seldato('dsnombre','id','crmtblgestiones',$idmedio,2);?></td>
                    <td><? echo reemplazar($obs);?></td>
                  </tr>
<?
$result->MoveNext();
}

}else{
  ?>
   <tr class="tbl_cbz_core" valign="top" align="center">
    <td colspan="4">NO TIENE ACTIVIDADES ASIGNADAS</td>
  </tr>
<?
}
$result->Close();

?>

   </table>
