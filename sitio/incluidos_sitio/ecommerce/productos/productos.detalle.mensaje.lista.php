<article class="cont_noticas_centro_detalle">
<?
$cat=$_REQUEST['cat'];
$campobase=$_REQUEST['campobase'];

?>

<section id="wrapper_content">
  <section class="content">
    <h1>Mensajes para tu pedido</h1>
      
    <hr>
    <div class="clear"></div>
<form action="<? echo $pagina;?>" name="ux">  
<input type=hidden name="campobase" value="<? echo $campobase?>">
<input type=hidden name="enc" value="<? echo $enc?>">

      <select name="cat" id="cat" style="width:300px; height:30px;" onChange="cargarmensaje('u','<? echo $pagina;?>','cat');" >

        <option value="">Seleccione la categoria</option>
<?
            $sql="select a.id,a.dsm from  tblcategorias_mensajes a where a.idactivo in (1) order by a.dsm ";
           // echo $sqlx;
            $result=$db->Execute($sql);
            if(!$result->EOF){
                    while(!$result->EOF){
                $id=reemplazar($result->fields[0]);
                $dsm=reemplazar($result->fields[1]);

?>
        <option value="<? echo $id?>"><? echo $dsm; ?></option>
<?
                   $result->MoveNext();
              }

          }
          $result->Close();
?>
      </select>
    </form>
<?
            $sql="select a.id,a.dsd from tblmensajes a where a.idactivo in (1)";
      if ($cat<>"") $sql.=" and idtipo=$cat  ";
            $sql.=" order by rand() ";
           //echo $sql;
            $result=$db->Execute($sql);
            if(!$result->EOF){
                    while(!$result->EOF){
                $id=reemplazar($result->fields[0]);
                $dsm=trim(reemplazar($result->fields[1]));

?>

    <article style="margin:20px 0px;">
      <? echo $dsm?> 
      <br><a href="javascript:cargarcampo('<? echo $campobase?>','<? echo ($dsm) ?>');" title='Click para copiar el mensaje al arreglo seleccionado' style="color:#f90; font-size:12px;">Copiar Mensaje</a>
    </article>

<?
                   $result->MoveNext();
              }

          }
          $result->Close();
?>
</form>

  </section>
</section>
<div class="clear"></div>


</article>





