
<h1><? echo reemplazar($dstituloPagina);?></h1>

<?
$sql="select a.id,a.dsm,a.dsruta,a.dsimg from tblbanners a,";
$sql.=" tblbannersxtblpaginas b where a.idactivo=6 and a.id=b.idorigen and b.iddestino='$idpagina' LIMIT 0,1";
$result=$db->Execute($sql);
if(!$result->EOF){
$dsimg=$result->fields[3];
$dsruta=$result->fields[2];
?>
<a href="<? echo $dsruta;?>">
<img src="<? echo $rutalocalimag;?>/contenidos/images/banners/<? echo $dsimg;?>" class="banner_tienda" />
</a>

<?}$result->Close();?>

<article class="contenedor_tiendas">

<form name="u" action="" method="POST">
    <table border="0" style="width:100%;" class="buscador_tiendas" cellspacing="10" cellspadding="0">
    <tr>
        <td>
          <select name="idpais" id="idpais" onchange="buscar_tiendas('1')">
            <option value="">-- Seleccione pais --</option>
            <?echo categorias('tblpaises','')?>
          </select>
        </td>
            <td>
          <select name="iddepartamento" id="iddepartamento" disabled  onchange="buscar_tiendas('2')">
          <option value="">-- Seleccione estado --</option>
          </select>
        </td>
            <td>
          <select name="idciudad" id="idciudad" disabled  onchange="buscar_tiendas('3')">
          <option value="">-- Seleccione Ciudad--</option>
          </select>
        </td>
    </tr>


    </table>
</form>
  <div id="tiendas_busqueda" >
    
 


  </div>
</article>

 <script language="javascript">
<!--
  function cargar() {
          $(".ver_mapa").colorbox({iframe:true, width:"45%", height:"70%"});
}
//-->

        </script>