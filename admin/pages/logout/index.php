<?php
	s::remove('username');
	if (CMS::Instance()->user->role!='guest') {
		CMS::Instance()->queue_message('Logged out','warning','/admin/login');	
	}
	else {
		CMS::Instance()->queue_message("You weren't even logged in!",'info','/admin/login');
	}
