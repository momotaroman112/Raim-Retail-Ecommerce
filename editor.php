
<script type="text/javascript">
	tinyMCE.init({
		mode : "textareas",
		theme : "advanced",
	plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",
 
		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
	
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,
                file_browser_callback : "ajaxfilemanager",
 
		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js"
	});
	
        function ajaxfilemanager(field_name, url, type, win) {
                var ajaxfilemanagerurl = "module/editor/jscripts/tiny_mce/plugins/ajaxfilemanager/ajaxfilemanager.php";
                var view = 'detail';
                switch (type) {
                        case "image":
                        view = 'thumbnail';
                                break;
                        case "media":
                                break;
                        case "flash": 
                                break;
                        case "file":
                                break;
                        default:
                                return false;
                }
                tinyMCE.activeEditor.windowManager.open({
                    url: "module/editor/jscripts/tiny_mce/plugins/ajaxfilemanager/ajaxfilemanager.php?view=" + view,
                    width: 800,
                    height: 500,
                    inline : "yes",
                    close_previous : "no"
                },{
                    window : win,
                    input : field_name
                });         
        }
</script>