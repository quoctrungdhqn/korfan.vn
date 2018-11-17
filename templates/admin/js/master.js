$(function()
{
	tinymce.init(
	{
		selector: "textarea.tinymcefull",theme: "modern",
		plugins: [
			"code",
			"advlist autolink link image lists charmap print preview hr anchor pagebreak",
			"searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
			"table contextmenu directionality emoticons paste textcolor responsivefilemanager"
		],
		toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect | fontselect | fontsizeselect",
		toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code ",
		image_advtab: true ,
		relative_urls: false,
		external_filemanager_path:"<?php echo base_url(); ?>filemanager/",
		filemanager_title:"Responsive Filemanager" ,
		external_plugins:
		{
			"filemanager" : "<?php echo base_url(); ?>filemanager/plugin.min.js"
		}
	});

});
