<h1>Content</h1>
<?php 
// if this is /admin/content/new and not /admin/widgets/new/CONTENTNAME then show list of widgets we can add
if (sizeof(CMS::Instance()->content_parameters)==0) { ?>
<div class='table-responsive'>
	<table class='table'>
		<thead><tr><th>Name</th><th>Description</th><th>Action</th></tr></thead>
		<tbody>
		<?php 
			$foldernames = CMS::Instance()->get_contenttypes();
			foreach ($foldernames as $foldername){
				// include class for content type
				include_once (CMSPATH . DS . 'types' . DS . $foldername . DS . "controller.php");
				// get class name from config
				$configjson = file_get_contents(CMSPATH . DS . 'types' . DS . $foldername . DS . "config.json");
				$config = json_decode($configjson);
				?>

				<tr>
					<td><?php echo $foldername;  ?></td> 
					<td><?php echo $config->description; ?></td>
					<td><a href='/admin/content/new/<?php echo $foldername;?>' class='btn btn-xs btn-success' >Add New</a></td>
				</tr>
				</p>
			<?php } ?>
			</tbody>
		</table>
	</div>

<?php } 

else { 

	// /content/new/TYPE
	// load controller/class + config
		$param2 = CMS::Instance()->content_parameters[0];
		$param2 = urldecode($param2);
		include_once(CMSPATH . DS . "types" . DS . $param2 . DS . "controller.php");
		$configjson = file_get_contents(CMSPATH . DS . 'types' . DS . $param2 . DS . "config.json");
		$config = json_decode($configjson);
		$itemtype = new $config->classname; 
		echo "<h2>New {$config->classname}</h2>";
		

		// check if we should be saving...

		if (isset($_POST['submit'])) {
			// update
			$itemtype->update();

			//now save
			$itemtype->save();

			// redirect
			CMS::Instance()->queue_message('Content created', 'success', $redirect='/admin/content');
			return true;
		}

		// not saving new, just render admin

		$itemtype->render_admin();

		?>
		
	<?php } 
	

	
