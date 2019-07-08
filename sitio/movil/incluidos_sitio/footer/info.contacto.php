<?
        $rutaImagen=$rut."../contenidos/images/remate/";
        $sql="select id,dsdireccion,dstelefono,dsimg1,dsemail,dsciudad from tblremate where idactivo=1";
        //    echo $sql;
        $result=$db->Execute($sql);
        if(!$result->EOF){
		$id=reemplazar($result->fields[0]);
		$dsdireccion=reemplazar($result->fields[1]);
		$dsimg1=($result->fields[3]);
		$dstelefono=reemplazar($result->fields[2]);

		$dsemail=$result->fields[4];
		$dsciudad=reemplazar($result->fields[5]);
?>
<article class ="cont_info">



		<a href="tel:0346040458"  data-transition="fade"></a>

		<p><? echo $dstelefono;?></p>
		<p><? echo $dsemail;?></p>
		<!--a href="tel:3122025864"  data-transition="fade"><span><img src="images/movil.png" alt="" class="phone"></span>
			<p>Movíl: 3122025864</p></a-->

		<p><? echo $dsdireccion;?></p>
		<h2 class="lugar">Medellín - Colombia</p></h2>


</article>
<?
}
$result->Close();
?>
