<h1>Widgets</h1>
<?php 

if (!empty($_POST['label'])) {
	

	
		$widget_label = $_POST['label'];
		$widget_path = CMSPATH . DS . 'widget_content' . DS . $widget_label . ".json";
		
		$result = unlink ($widget_path);
		if ($result) {
			CMS::Instance()->queue_message('Widget deleted: ' . $widget_label,'success','/admin/widgets');
		}
		else {
			CMS::Instance()->queue_message('Widget delete failed. ' . $widget_path,'danger','/admin/widgets');	
		}		
}
else {
	CMS::Instance()->queue_message('Widget delete failed - widget label required','danger','/admin/widgets');	
}	

	
	

	
