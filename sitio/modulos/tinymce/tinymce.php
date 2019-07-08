<!-- TinyMCE -->
<script type="text/javascript" src="../../externos/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">		
	tinyMCE.init({
		// General options
		width: "100%",
		height: "280",
		mode : "exact",
		elements: "<? echo $elements?>",
		theme : "advanced",
		plugins : "safari,pagebreak,style,layer,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,inlinepopups",

		// Theme options
		theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "paste,pastetext,pasteword,|,bullist,numlist,|,undo,redo,|,code,|forecolor,backcolor,link,unlink,anchor",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
</script>
<!-- /TinyMCE -->

