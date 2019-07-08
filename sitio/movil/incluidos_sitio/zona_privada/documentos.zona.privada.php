<article id='documentos' class="cuerpo_tab">
	<article class="txt_qsomos">
	<h2>Descarga de Documentos</h2>
	<p>Donec vitae nisl turpis, vitae interdum nisl. Nulla sed sollicitudin nunc. Proin rhoncus purus ut erat rhoncus at iaculis enim dapibus. Mauris sed eros in sem porta adipiscing in a arcu.</p>
	</article>
	<?for ($i=0; $i < 5; $i++) { ?>
    <a href="">
	    <article class="cont_docs">
	    	<article>
	    		<h2>Nombre del Documento</h2>
	    		<p>descripci&oacute;n corta del ducumento</p>
	    	</article>
	    	<img src="<?echo $rut?>images/icon_pdf.png" alt="">
	    </article>
	</a>
	<?}?>
</article>