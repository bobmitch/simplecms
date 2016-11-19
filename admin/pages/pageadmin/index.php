<?php 
?>
<h1>Pages</h1>

<a href="/admin/pageadmin/new" class="btn  btn-success">New Page</a>
<div class="">
	<table class="table">
		<thead>
			<tr>
				<th>Title</th><th>Content</th>
			</tr>
		</thead>
		<tbody>

<?php  
	$all_pages = CMS::Instance()->get_all_pages_details_sorted();
	foreach ($all_pages as $page) {
		//CMS::pprint_r ($page);
		echo "<tr class='depth{$page->depth}'>";
			echo "<td>";
			for ($n=0; $n<$page->depth; $n++) {
				if ($n==$page->depth-1) {
					echo "<span style='color:#aaa;' class='child-indicator'> &nbsp; &dlcorn; &nbsp; </span>";
				}
				else {
					echo " &nbsp; &nbsp; ";
				}
			}
			echo "<p style='display:inline-block'><a href='".CMS::Instance()->config->basepath."/admin/pageadmin/edit{$page->path}/{$page->directory}'>{$page->title}</a><br><span data-toggle=\"tooltip\" data-placement=\"left\" title=\"Real folder name\" class='page-folder'>{$page->directory}</span></p></td>";
			if (property_exists($page,'content_config')) {
				if (!$page->content_config->type) {
					$page->content_config->type="None";
				}
			}
			else {
				$page->content_config = new stdClass();
				$page->content_config->type="Unknown type - config missing";
				$page->content_config->title="Unknown title - config missing";
			}
			echo "<td>{$page->content_config->title}<br><span class='page-folder'>{$page->content_config->type}</span></td>";
			?>
			
		</tr>
	<?php }
	//$tree = get_tree(CMSPATH . DS . 'content', "javascript:alert('You clicked on [link]');");
	//echo $tree;
?>
		</tbody>
	</table>
</div>