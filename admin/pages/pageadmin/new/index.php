<?php

$contentfolder = CMS::getvar('newcontentfolder');
$title = CMS::getvar('title');	
$page_parent_path = CMS::getvar('parent');
$segment = CMS::getvar('segment');

if (CMS::getvar('title')) {
	// update content folder
	
	if (!$contentfolder) {
		CMS::queue_message('No content item selected','danger',CMS::Instance()->config->basepath.'/admin/pageadmin/new');
	}
	// update title
	
	if (!$title) {
		CMS::queue_message('Title cannot be empty','danger',CMS::Instance()->config->basepath.'/admin/pageadmin/new');
	}
	// update parent
	
	if ($page_parent_path=='root') {
		$page_parent_path='';
	}

	// make new dir based on segment passed from user
	$destination = CMSPATH . DS . 'pages' . $page_parent_path . DS . $segment;
	$ok = @mkdir ($destination);
	if ($ok===FALSE) {
		CMS::queue_message('Failed to create new page folder: $destination','danger',CMS::Instance()->config->basepath.'/admin/pageadmin/new');
	}

	$options = [];
	$page_config = new Page($title, $options,$contentfolder);

	// write config file
	$ok = write_json_file (CMSPATH . DS . 'pages' . DS .  $page_parent_path . DS . $segment . DS . 'config.json', $page_config);
	if ($ok===FALSE) {
		CMS::queue_message('Failed to write config file for ' . $page_config->title,'danger',CMS::Instance()->config->basepath.'/admin/pageadmin/new');
	}

	// show message
	CMS::queue_message('Created ' . $page_config->title,'success',CMS::Instance()->config->basepath.'/admin/pageadmin');
}

// reached this point, no saving, just display form

//CMS::pprint_r ($page_config);

echo "<h1>New Page</h1>";

$content = CMS::get_content_items();



?>



<form method="POST">
	<fieldset>
		<legend>Details</legend>
		<div class="form-group">
			<label for="title">Title</label>
			<input name='title' type="text" required class="form-control" id="title" value="<?php echo $title; ?>">
		</div>
		<div class="form-group">
			<label for="folder">URL Segment</label>
			<input type="text" required class="form-control" name="segment" id="folder" value="">
			<p class="help-block">URL segment and physical folder name. Include a number and dash at start to force ordering.</p>
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
	<a href="<?php echo CMS::Instance()->config->basepath;?>/admin/pageadmin" class='btn button btn-danger'>Cancel</a>
</form>