<h1>Content Edit <a href='/admin/content' class='btn pull-right btn-warning'>Cancel</a></h1>

<?php

$content_folder = $_POST['folder'];
$content_item = Type::get_content_object($content_folder);

if (!empty($_POST['submit'])) {
	// saving
	// update content with posted info
	$content_item->update();
	//now save
	$content_item->save();
	// redirect
	CMS::Instance()->queue_message('Content updated', 'success', $redirect='/admin/content');
}
else {
	// render edit admin
	
	
	$content_item->render_admin();
}
	

	
	
