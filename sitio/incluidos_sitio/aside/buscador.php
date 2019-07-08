<article class="buscador">
        <form action="<? echo $rutalocal?>/buscador.php" method=post name="frm_buscador">
		<!--label for="search">Buscador</label-->
		<input type="text" name="dsbusqueda" id="dsbusqueda" placeholder="Buscar">
		<input type="submit" value="" onClick="busqueda();">
	</form>
</article>

<script language="javascript">
	function busqueda(){
	if (document.buscar.dsbusqueda.value!="Ingresar palabra") document.buscar.submit() ;
	}
</script>


