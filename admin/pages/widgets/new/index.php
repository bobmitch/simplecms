<h1>Widgets</h1>
<?php 
// if this is /admin/widgets/new and not /admin/widgets/new/WIDGETNAME then show list of widgets we can add
if (sizeof(CMS::Instance()->content_parameters)==0) { ?>
<div class='table-responsive'>
	<table class='table'>
		<thead><tr><th>Name</th><th>Description</th><th>Action</th></tr></thead>
		<tbody>
		<?php 
			$foldernames = CMS::Instance()->get_widgetnames();
			foreach ($foldernames as $foldername){
				// include class for widget
				include_once (CMSPATH . DS . 'widgets' . DS . $foldername . DS . $foldername . ".php");
				?>

				<tr>
					<td><?php $widget = new $foldername;  echo $widget->name;  ?></td> 
					<td><?php echo $widget->description; ?></td>
					<td><a href='/admin/widgets/new/<?php echo $foldername;?>' class='btn btn-xs btn-success' >Add New</a></td>
				</tr>
				</p>
			<?php } ?>
			</tbody>
		</table>
	</div>

<?php } 

else { 

	
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
	

	
