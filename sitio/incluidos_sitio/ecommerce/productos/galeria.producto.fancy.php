	<h3>Thumbnail helper</h3>


	<a class="fancybox-thumb" rel="fancybox-thumb" href="<?echo $rutbase?>images/logo_principal.png" title="Ayvalık, Turkey (Nejdet Düzen)">
	<img src="<?echo $rutbase?>images/logo_principal.png" alt="" />
</a>
<a class="fancybox-thumb" rel="fancybox-thumb" href="<?echo $rutbase?>images/logo_principal.png" title="Sicilian Scratches   erice (italianoadoravel on/off coming back)">
	<img src="<?echo $rutbase?>images/logo_principal.png" alt="" />
</a>
<a class="fancybox-thumb" rel="fancybox-thumb" href="<?echo $rutbase?>images/logo_principal.png" title="The Trail (Msjunior-Check out my galleries)">
	<img src="<?echo $rutbase?>images/logo_principal.png" alt="" />
</a>
<a class="fancybox-thumb" rel="fancybox-thumb" href="<?echo $rutbase?>images/logo_principal.png" title="Trees (Joerg Marx)">
	<img src="<?echo $rutbase?>images/logo_principal.png" alt="" />
</a>

<script>

$(document).ready(function() {
	$(".fancybox-thumb").fancybox({
		prevEffect	: 'none',
		nextEffect	: 'none',
		helpers	: {
			title	: {
				type: 'outside'
			},
			thumbs	: {
				width	: 50,
				height	: 50
			}
		}
	});
});

</script>