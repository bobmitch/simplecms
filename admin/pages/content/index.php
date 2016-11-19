<h1>Content </h1>
<a href="/admin/content/new" class="btn  btn-success">New Content Item</a>

	<?php
	$widgets = CMS::Instance()->get_content_items();
	?>
	<div class='table-responsive'>
		<table class='table'>
			<thead>
				<tr>
					<th>Title</th>
					<th>Type</th>
					<th>Author</th>
					<th>Created</th>
					<th>Modified</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
			<?php
			foreach ($widgets as $widget){?>
				<tr>
					<td><?php echo $widget->title;?></td>
					<td><?php echo $widget->type;?></td>
					<td><?php echo $widget->author;?></td>
					<td><?php echo get_nice_date_diff($widget->created);?></td>
					<td><?php echo get_nice_date_diff($widget->modified);?></td>
					<td>
						<form class="form" style="display:inline-block;" action="/admin/content/edit" method="POST">
							<input type="hidden" name="folder" value="<?php echo $widget->content_folder; ?>">
							<button type="submit" class='btn btn-xs btn-primary' >edit</button>
						</form>
						<form class="form" style="display:inline-block;" action="/admin/content/delete" method="POST">
							<input type="hidden" name="title" value="<?php echo $widget->title; ?>">
							<button onclick="return confirm('Delete widget - are you sure?');" type="submit" class='btn btn-xs btn-danger' >delete</button>
						</form>
					</td>
				</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>

	
	
