<?php
	
	if (CMS::Instance()->user->role=="guest") {
		CMS::Instance()->queue_message('Access denied','danger','<?php echo CMS::Instance()->config->basepath; ?>/admin/login');
		return;
	}
?>
<h1>Admin Home</h1>
<p>Welcome to Simple CMS - the lightweight, minimalistic content management system for content creators and developers.</p>
<h2>Overview</h2>
<p>This CMS was designed with 2 main goals in mind:</p>
<ul><li>Be completely file-based - for speed, simplicity and ease of deployment.</li><li>Be friendly for end-users and developers - and not the mythical users that exist in the spectrum between the two.</li></ul>
<h2>Pages</h2>
<p>This section serves as your sitemap. All site structure (and unique URLs) are defined in this area by creating a heirarchy of titles which are each associated with a content item.</p>
<h2>Content</h2>
<p>Create all content that will be needed on the site in this area. The system ships with 3 standard content types: A simple page type, a simple blog, and a special empty content item for pages which are populated entirely by widgets.</p>
<h2>Widgets</h2>
<p>Little pieces of content that can be placed in a specific location in the sites template on one or more pages. Used mainly for persistent site elements, such as sidebars, menus or conversions.</p>
<h2>Users</h2>
<p>Manage all users from this area. The system ships with 2 user types by default, admin and editor - but this can easily be expanded by any developer.</p>
<h2>Plugins</h2>
<p>The plugin system does not exist at this moment in time, but hooks are planned to be added to the system to allow for, amongst other things, content manipulation, caching solutions or database extensability.</p>