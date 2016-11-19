<?php

if (isset($_POST['submit'])) {
	// save user 
	$user = new User();
	$user->username = $_POST['username'];
	$user->password = $_POST['password'];
	$user->password = password_hash($user->password, PASSWORD_DEFAULT); // hash password with salt
	$user->role = $_POST['role'];
	$user->email = $_POST['email'];
	$user->fullname = $_POST['name'];
	$user->save();
}

?>


<h1>New User</h1>
<form action="" method="POST">
	<fieldset>
		<!--
		<div class="form-group">
			<label for="username">Username</label>
			<input required name="username" type="text" class="form-control" id="username" placeholder="bob">
		</div>-->
		<?php $field = new TextField('Username','username',true); $field->render(); ?>
		<div class="form-group">
			<label for="name">Full Name</label>
			<input required name="name" type="text" class="form-control" id="name" placeholder="Full Name">
		</div>
		<div class="form-group">
			<label for="email">Email</label>
			<input required name="email" type="text" class="form-control" id="email" placeholder="example@test.com">
		</div>
		<div class="form-group">
			<label for="password">Password</label>
			<input required name="password" type="password" class="form-control" id="password" placeholder="Password">
		</div>
		

		<div class="form-group">
			<legend>Role</legend>
			<div class="radio">
				<label>
					<input type="radio" name="role" id="role1" value="editor" >
					Editor
				</label>
			</div>
			<div class="radio">
				<label>
					<input type="radio" name="role" id="role2" value="admin" checked>
					Admin
				</label>
			</div>
		</div>

		<div class="control-group">
			<!-- Button -->
			<div class="controls">
				<button name="submit" type="submit" class="btn btn-success">Save New User</button>
			</div>
		</div>
	</fieldset>
</form>