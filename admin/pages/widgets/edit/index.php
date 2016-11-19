<h1>Widgets</h1>

<?php 

if (!empty($_POST['label'])) {

		// get widget config file and create class
		$label = $_POST['label'];
		if (!empty($_POST['old_label'])) {
			$old_label = $_POST['old_label'];
		}
		else {
			$old_label = $label;
		}
		$widget_content_path = CMSPATH . DS . 'widget_content' . DS . $old_label . ".json"; // always get content from old_label file before possible deletion :)
		$widget_json = file_get_contents ($widget_content_path);
		$widget_info = json_decode ($widget_json);
		$widget_type = $widget_info->type;
		// load widget class file so we can create it 
		include_once(CMSPATH . DS . 'widgets' . DS . $widget_type . DS . $widget_type . ".php");
		$widget = new $widget_type();

		// are we saving?
		if (isset($_POST['submit'])) {
			// first, check if label has changed
			// if it has, we need to delete the old file first
			
			if ($label!=$old_label) {
				$widget_path = CMSPATH . DS . 'widget_content' . DS . $old_label . ".json";
				$result = unlink ($widget_path);
				if (!$result) {
					CMS::Instance()->queue_message('Widget edit failed - could not delete old widget file','danger','/admin/widgets');
				}
			}

			$widget->populate(); // populate based on post vars 
			$widget->save();

			CMS::Instance()->queue_message('Widget changes saved','success','/admin/widgets');
			return (true);
		}
		else {
			// not saving, get config and form 
		
			
			// assign values to new widget from previously decoded json 
			$widget->assign_values($widget_info);
			?>

			<form method="POST">
				<input type="hidden" name="old_label" id="old_label" value="<?php echo $label;?>">
				<div class='panel panel-default'>
					<div class='panel-heading'>
						<h3 class='panel-title'>Default Widget Fields</h3>
					</div>
					<div class='panel-body'>
						<div class='form-group'>
							<label for="label">Label/Description</label>
							<input type='text' value="<?php echo $widget->label; ?>" required class='form-control' id="label" name="label">
							
						</div>
						<div class='form-group'>
							<label for="position">Position</label>
							<input type='text' value="<?php echo $widget->position; ?>" required class='form-control' id="position" name="position">
							<p class="help-block">Position is used in the front-end template to determine where the widget is actually displayed.</p>
						</div>
					</div>
				</div>
				<div class='panel panel-default'>
					<div class='panel-heading'>
						<h3 class='panel-title'>Custom Widget Fields</h3>
					</div>
					<div class='panel-body'>
						<?php // get widget specific admin form
						include_once (CMSPATH . DS . 'widgets' . DS . $widget_type . DS . 'admin.php');?>
					</div>
				</div>
				<button name="submit" class='submit btn btn-success'>Save Changes</button>
			</form>

	<?php	}
}
else {
	CMS::Instance()->queue_message('Widget edit failed - widget label required','danger','/admin/widgets');	
}	

	
	

	
/*

	
		$param2 = CMS::Instance()->content_parameters[0];
		include_once(CMSPATH . DS . "widgets" . DS . $param2 . DS . $param2 . ".php");
		$widget = new $param2; 
		echo "<h2>New {$widget->name}</h2>";
		

		// check if we should be saving...

		if (isset($_POST['submit'])) {
			$widget->populate(); // populate automatically from get/post values
			$widget->save();
			CMS::Instance()->queue_message('Widget saved','success','/admin/widgets');
			return (true);
		}

		// output default widget form elements
		?>
		<form method="POST">
			<div class='panel panel-default'>
				<div class='panel-heading'>
					<h3 class='panel-title'>Default Widget Fields</h3>
				</div>
				<div class='panel-body'>
					<div class='form-group'>
						<label for="label">Label/Description</label>
						<input type='text' required class='form-control' id="label" name="label">
						
					</div>
					<div class='form-group'>
						<label for="position">Position</label>
						<input type='text' required class='form-control' id="position" name="position">
						<p class="help-block">Position is used in the front-end template to determine where the widget is actually displayed.</p>
					</div>
				</div>
			</div>
			<div class='panel panel-default'>
				<div class='panel-heading'>
					<h3 class='panel-title'>Custom Widget Fields</h3>
				</div>
				<div class='panel-body'>
					<?php // get widget specific admin form
					include_once (CMSPATH . DS . 'widgets' . DS . $param2 . DS . 'admin.php');?>
				</div>
			</div>
			<button name="submit" class='submit btn btn-success'>Save New Widget</button>
		</form>
	<?php } 
	

	*/
