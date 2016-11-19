<?php

// TODO: folder/url change

// get page folder as passed in url
$pagefolder = implode(CMS::Instance()->content_parameters,DS);
$pagefoldername = end(CMS::Instance()->content_parameters);
$pagepath = DS . implode( array_slice(CMS::Instance()->content_parameters,0,-1), DS);

// get page config
$page_config_json = @file_get_contents(CMSPATH . DS . 'pages' . DS . $pagefolder . DS . 'config.json');
if ($page_config_json===FALSE) {
	CMS::queue_message('No config.json file found for page located in ' . $pagefolder,'danger',CMS::Instance()->config->basepath.'/admin/pageadmin');
}
$page_config = json_decode($page_config_json);



if (CMS::getvar('newcontentfolder')) {
	// We got variable for new content folder (and possibly others) - save and redirect back to pageadmin
	// update content folder
	$page_config->contentfolder = CMS::getvar('newcontentfolder');
	// update title
	$page_config->title = CMS::getvar('title');	
	// update parent
	$page_parent_path = CMS::getvar('parent');
	if ($page_parent_path=='root') {
		$page_parent_path='';
	}
	$ok = write_json_file (CMSPATH . DS . 'pages' . DS . $pagefolder . DS . 'config.json', $page_config);
	if ($ok===FALSE) {
		CMS::queue_message('Failed to write config file to change content for ' . $page_config->title,'danger',CMS::Instance()->config->basepath.'/admin/pageadmin');
	}
	$source = CMSPATH . DS . 'pages' . DS . $pagefolder;
	$destination = CMSPATH . DS . 'pages' . $page_parent_path . DS . $pagefoldername;
	$ok = @rename ($source, $destination);
	if ($ok===FALSE) {
		CMS::queue_message('Failed to move page folder from ' . $source . ' to ' . $destination,'warning');
	}
	// update url segment / page folder
	// note: using $destination from above, just in case we move page folder to a new parent
	// TODO: verify this segment is valid
	$segment = CMS::getvar('segment');
	$source = $destination; // previous parent change destination is now current source
	$destination = CMSPATH . DS . 'pages' . $page_parent_path . DS . $segment;
	$ok = @rename ($source, $destination);
	if ($ok===FALSE) {
		CMS::queue_message('Failed to rename URL Segment to ' . $segment ,'warning');
	}
	// show message
	CMS::queue_message('Saved ' . $page_config->title,'success',CMS::Instance()->config->basepath.'/admin/pageadmin');
}

// reached this point, no saving, just display form

//CMS::pprint_r ($page_config);

echo "<h1>Editing {$page_config->title}</h1>";
//echo "<p>Current content: {$config->type} - \"{$config->title}\" </p> ";

$content = CMS::get_content_items();



?>


<form method="POST">
	<fieldset>
		<legend>Details</legend>
		<div class="form-group">
			<label for="title">Title</label>
			<input name='title' type="text" required class="form-control" id="title" value="<?php echo $page_config->title; ?>">
		</div>
		<div class="form-group">
			<label for="folder">URL Segment</label>
			<input type="text" required class="form-control" name="segment" id="folder" value="<?php echo $pagefoldername; ?>">
			<p class="help-block">This determines both the name of the physical folder the page configuration is stored in, as well as the URL segment text.<br>The format can include a number followed by a dash <em>at the beginning of the segment/foldername</em> to force ordering. This is stripped out of the URL by the system.</p>
		</div>
		<div class="form-group">
			<label for='parent'>Parent</label>
			<select name='parent' id='parent' class='form-control'>
				<?php
				$all_pages = CMS::Instance()->get_all_pages_details_sorted();
				echo "<option value='root'>None</option>";
				foreach ($all_pages as $page) {
					//CMS::pprint_r ($page);
					// get parent config - path is just parent folder :)
					$parent_config_json = file_get_contents(CMSPATH . DS . 'pages' . $page->path . DS . 'config.json');
					$parent_config = json_decode ($parent_config_json);
					$selected=false;	
					if ($pagepath==$page->path . DS . $page->directory) {
						// if the currently edited page config path matches the currently looped pages path... then thats our current parent
						$selected = ' selected ';
					}
					echo "<option {$selected} value='" . $page->path . DS . $page->directory . "'>" . $page->title . "</option>";
				}
				?>
			</select>
		</div>
	</fieldset>
	<fieldset>
		<legend>Content</legend>
		<table class='table'>
			<thead>
				<tr>
					<th>Content Title</th><th>Type</th><th>Author</th>
				</tr>
			</thead>
			<tbody>
				<?php
				foreach ($content as $item) {
					//print_r ($item);
					$content_folder = $item->content_folder;
					$checked=false;
					if ($content_folder==@$page_config->contentfolder) {
						$checked=' checked ';
					}
					echo "<tr><td><input id='{$content_folder}' name='newcontentfolder' value='{$content_folder}' type='radio' {$checked}> <label for='{$content_folder}'>{$item->title}</label></td><td>{$item->type}</td><td>{$item->author}</td></tr>";
				} 
				?>
			</tbody>
		</table>
	</fieldset>
	<button type='submit' class='submit btn btn-success'>Save Changes</button>
	<a href="<?php echo CMS::Instance()->config->basepath; ?>/admin/pageadmin" class='btn button btn-danger'>Cancel</a>
</form>