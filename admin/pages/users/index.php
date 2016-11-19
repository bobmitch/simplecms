<?php
	$usernames = Users::get_all_usernames();
?>

<div class="container-fluid">
	<div class="row">
		<div class="col-xs-12">
			
			<h1>Users</h1>
			<div>
				<a class="btn btn-success" href="/admin/users/new">New User</a>
			</div>
			<div class='table-responsive'>
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Username</th>
							<th>Full Name</th>
							<th>Email</th>
							<th>Role</th>
							<th>Registered</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($usernames as $username) {
							$user = new User();
							$user->load($username);
							?>
							<tr>
								<td><?php echo $user->username;?></td>
								<td><?php echo $user->fullname;?></td>
								<td><?php echo $user->email;?></td>
								<td><?php echo $user->role;?></td>
								<td><?php echo $user->registered;?></td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>