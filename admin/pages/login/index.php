<?php

	// handle submission
	if (!empty($_POST['username']) && !empty($_POST['password'])) {
		// submission
		$username = $_POST['username'];
		$password = $_POST['password'];

		if (PFBC\Form::isValid('login')) {
			echo "<h2>Valid Form</h2>";
		}
		else {
			CMS::Instance()->queue_message('Invalid form','danger','/admin/login');
			
		}

		if (User::login($username,$password)) {
			PFBC\Form::clearValues('login');
			CMS::Instance()->set_user($username);
			CMS::Instance()->queue_message('Login successful!','success','/admin/home');
		}
		else {
			CMS::Instance()->queue_message('Incorrect username or password','danger','/admin/login');
		}
	}
?>
<div class="container-fluid">
	<div class="row">
		<div class="col-xs-12">
			<?php if (CMS::Instance()->user->role!='guest'): ?>
			<div class="alert alert-success" role="alert"> <strong>Are you sure?</strong> You are already logged in! </div>
			<?php endif; ?>
			<h1>Login</h1>
		
			<?php
			$form = new PFBC\Form("login","");
			$form->addElement(new PFBC\Element\Textbox("Username or email:", "username"));
			$form->addElement(new PFBC\Element\Password("Password:", "password"));
			$form->addElement(new PFBC\Element\Button);
			$form->render();
			?>
		</div>
	</div>
</div>