<?
$rutx=1;
if($rutx==1) $rutxx="../";
include($rutxx."../../incluidos_modulos/modulos.globales.php");

//$db->debug=true;
$dsdplan=seldato("descripcion","id","crm_productos_y_servicios",$_REQUEST['idplan'],1);
$dsmplan=seldato("titulo","id","crm_productos_y_servicios",$_REQUEST['idplan'],1);
$dsdprecio=seldato("dsd2","idproducto"," tblproductosxprecios",$_REQUEST['idplan'],1);
$tipomoneda=seldato("idtipomoneda","idproducto"," tblproductosxprecios",$_REQUEST['idplan']." group by id",1);
$dsmtipomoneda=seldato("codigo","id"," crm_tipos_de_monedas",$tipomoneda,1);

 /*
$dsdterminos=seldato('terminos_y_condiciones','id','crm_productos_y_servicios',$_REQUEST['idplan'],1);
$dsdplaninclu=seldato('el_plan_incluye','id','crm_productos_y_servicios',$_REQUEST['idplan'],1);
$dsmnombre=seldato("nombre_o_razn_social","id","crm_clientes",$_REQUEST['idcliente'],1);
$dsmapellido=seldato("apellido_o_nombre_comercial","id","crm_clientes",$_REQUEST['idcliente'],1);
$dsmtelefono=seldato("telfono_1","id","crm_clientes",$_REQUEST['idcliente'],1);
*/
$dsfechaini=seldato("fecha_inicial_de_publicacion","id","crm_productos_y_servicios",$_REQUEST['idplan'],1);
$dsfechafin=seldato("fecha_final_de_publicacion","id","crm_productos_y_servicios",$_REQUEST['idplan'],1);
$dsimg=seldato("dsarchivo3","idproducto","tblproductosxgalerias",$_REQUEST['idplan']." and idactivo=4",1);
?>

<html>
<head>
	<title>Correo respuesta Univiajes</title>
	<style type="text/css">
	.cms_cont_relacionado {
	    list-style: none;
	    padding: 0;
	    margin: 0 0 10px 0;
	    position: relative;
	    box-sizing: border-box;
	    -o-box-sizing: border-box;
	    -webkit-box-sizing: border-box;
	    -moz-box-sizing: border-box;
	}
	.txt_cms_cbz {
    
    margin: 0 0 10px 0;
    background: #F2F2F2;
    padding: 10px;
    position: relative;
    display: inline-block;
    width: 100%;
    box-sizing: border-box;
    -o-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
}
.precio1 {
    display: inline-block;
    padding: 5px 20px;
    background: #f4f4f4;
    box-sizing: border-box;
    -o-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
}
.cms_producto_detalle h3 {
    color: #0050A5;
    font-size: 1.55em;
    margin: 0;
}
.cms_producto_detalle h2 {
    color: #727F99;
    font-size: 2.2em;
    font-style: italic;
    margin: 0 0 10px 0;
    font-weight: 100;
}
.cms_producto_detalle {
    text-align: left;
    margin: 0 0 10px 0;
    display: inline-block;
    width: 100%;
}
.cms_producto_detalle img {
    max-width: 100%;
    margin: 0 20px 10px 0;
    float: left;
}
.txt_cms_cbz p {
    color: #333;
    font-size: 0.8em;
    width: 72%;
    line-height: 14px;
}
ul {
    display: block;
    list-style-type: disc;
    -webkit-margin-before: 1em;
    -webkit-margin-after: 1em;
    -webkit-margin-start: 0px;
    -webkit-margin-end: 0px;
    -webkit-padding-start: 40px;
}
li {
    display: list-item;
    text-align: -webkit-match-parent;
}
.txt_cms_cbz img {
    max-width: 10%;
    float: left;
    margin: 0 10px 0 0;
}
.txt_cms_cbz h3 {
    color: #333;
    margin: 0;
    font-weight: 700;
    width: 72%;
}

	</style>
</heade>
<body>
	  <article class="cms_producto_detalle">
        <h2><?echo ($dsmplan);?></h2>
        <? if($dsimg<>""){
          ?>
        <img src="<?echo $rutalocalimag?><? echo $ubicasitio ?>../../../../../gcomercialV3/contenidos/temas/productos/<? echo $dsimg;?>">
         <?}else{?>
          <img src="../../../images/img_sin.png">
        <? }?>
      <div class="cont_info">
        <p><? echo trim($dsdplan);?></p>
       <? if ($dsdprecio<>''){?>
        <div class="precio1">
          <span>Valor desde</span>
          <h3><? echo number_format($dsdprecio,0,",",".")." ".$dsmtipomoneda; ?></h3>
        </div>
        <?} ?>
      </div>
  </article>


<?
$sqlphr="select id, dsd2, idproducto from tblproductosxprecios where idproducto=".$_REQUEST['idplan']." and idactivo not in (2,9) order by dsd2 asc ";

	$resultph=$db->Execute($sqlphr);

	if(!$resultph->EOF)
	{
		$count=0;
	
		while(!$resultph->EOF)
		{

			$idproh = $resultph->fields[0];
			$dsd2proh = $resultph->fields[1];

			$sql="select hotel from crm_precios_por_hotel where idprecio = $idproh group by hotel ";

			$resulthxp=$db->Execute($sql);
			if(!$resulthxp->EOF){
			if($count==0){
			?>
				<h2>Hoteles relacionados</h2>
			<?
			}
				$count = $count +1 ;
				while(!$resulthxp->EOF){
					$idhorel=$resulthxp->fields[0];

	$sql="select a.titulo, a.descripcion_corta, b.dsimg, a.id ,a.terminos_y_condiciones	";
	$sql.=" from crm_hoteles a , tblgaleriahoteles b , tblproductosxhoteles c "; 
	$sql.=" where a.id=b.idorigen and a.idactivo=1 and a.id=$idhorel group by a.id";

	$result=$db->Execute($sql);
	
	if(!$result->EOF){
		while(!$result->EOF){

			$dsm=$result->fields[0];
			$dsd=$result->fields[1];
			$dsimg=$result->fields[2];
			$idho=$result->fields[3];
			$dsdterminos=$result->fields[4];

?>
<ul class="cms_cont_relacionado">

    <li class="txt_cms_cbz">
		 <? if($dsimg<>''){ ?>
		<img  src="<? echo $rutalocalimag?>/contenidos/images/hoteles/<? echo $dsimg;?>" alt="">
		<? }else{?>
		<img  src="../../../images/img_sin.png" alt="">
		<? }?>
		<h3><? echo ($dsm); ?></h3>
		<p><? echo ($dsd); ?></p>

		<? if($dsprecio<>""){ ?>
		<div class="precio">
			<h5>Desde</h5>
			<h4><? echo number_format($dsd2proh,0,",",".")." ".$tipomoneda ; ?></h4>
			<h5>Por persona<h5>
		</div>
		<?  }?>
	</li>

	<article class="txt_cms_detalle">
		<? 
		$sql="select dsimg ";
		$sql.=" from tblgaleriahoteles  "; 
		$sql.=" where idorigen=$idho  ";

		$resultxx=$db->Execute($sql);
		if(!$resultxx->EOF){
			
		?>
		<ul>
			<? while(!$resultxx->EOF){

				$dsimg=	$resultxx->fields[0];
			 ?>
			<a href="<? echo $rutalocalimag?>/contenidos/images/hoteles/<? echo $dsimg;?>" class="galeria_detalle"></a>
			<? 
			$resultxx->MoveNext();
		} ?>
		</ul>
		<? 
			}
			$resultxx->Close();
		?>	
	</article>

</ul>
<? 
$result->MoveNext();
	}// fin while interno

}//fin if interno
$result->Close();

$resulthxp->MoveNext();
		}
	}
	
	$resulthxp->Close();

	$resultph->MoveNext();
		}
	

	}
	$resultph->Close();

?>

</body>

</html>