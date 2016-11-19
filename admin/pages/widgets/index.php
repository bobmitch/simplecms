<h1>Widgets </h1>
<a href="/admin/widgets/new" class="btn  btn-success">New Widget</a>

	<?php
	$widgets = CMS::Instance()->get_content_widgets();
	?>
	<div class='table-responsive'>
		<table class='table'>
			<thead>
				<tr>
					<th>Label</th>
					<th>Type</th>
					<th>Position</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
			<?php
			foreach ($widgets as $widget){?>
				<tr>
					<td><?php echo $widget->label;?></td>
					<td><?php echo $widget->name;?></td>
					<td><?php echo $widget->position;?></td>
					<td>
						<form class="form" style="display:inline-block;" action="/admin/widgets/edit" method="POST">
							<input type="hidden" name="label" value="<?php echo $widget->label; ?>">
							<button type="submit" class='btn btn-xs btn-primary' >edit</button>
						</form>
						<form class="form" style="display:inline-block;" action="/admin/widgets/delete" method="POST">
							<input type="hidden" name="label" value="<?php echo $widget->label; ?>">
							<button onclick="return confirm('Delete widget - are you sure?');" type="submit" class='btn btn-xs btn-danger' >delete</button>
						</form>
					</td>
				</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>

	
	
