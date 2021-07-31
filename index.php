<?php

	class MyDB extends SQLite3
	{
	    function __construct()
	    {
	        $this->open('assets/db/db.sqlite');
	    }
	}

	$db = new MyDB();


	// ALert and redirect
	function alert($msg)
	{
		?>
			<script>
				alert("<?php echo $msg ?>");
				window.location = 'index.php';
			</script>
		<?php
	}

	// Add user
	if (isset($_POST['save'])) {
		$name = $_POST['name'];
		$email = $_POST['email'];

		$sql = "INSERT INTO `users` (`name`, `email`) VALUES ('$name', '$email')";

		$res = $db->exec($sql);
		if ($res) {
			alert("Saved!");
		}
		else {
			alert("Not Saved!");
		}
	}

	// Delete User
	if (isset($_GET['del'])) {
		$id = intval($_GET['id']);
		$sql = "DELETE FROM `users` WHERE `id` = $id";
		$res = $db->exec($sql);
		if ($res) {
			alert("Deleted");
		}
		else {
			alert("Not Deleted");
		}
	}

	// Update User
	if (isset($_POST['update'])) {
		$id = intval($_POST['id']);
		$name = $_POST['name'];
		$email = $_POST['email'];

		$sql = "UPDATE `users` SET `name` = '$name', `email` = '$email' WHERE `id` = '$id'";

		$res = $db->exec($sql);
		if ($res) {
			alert("Updated");
		}
		else {
			alert("Not Updated");
		}
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>CRUD - PHP - SQLITE</title>
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
</head>
<body>
	<h2 class="alert alert-success text-center mt-5">CRUD - PHP - SQLITE</h2>
	<div class="container-fluid row d-flex justify-content-center mt-5">
		<div class="col-lg-4 col-md-4 col-sm-12">
			<h3 class="alert alert-info text-center">Add User</h3>

			<form method="POST" action="?" class="form">
				<input type="number" hidden name="id" class="form-control">
				<fieldset class="form-group">
					<label>Name</label>
					<input type="text" name="name" class="form-control">
				</fieldset>
				<fieldset class="form-group">
					<label>Email</label>
					<input type="text" name="email" class="form-control">
				</fieldset>
				<fieldset class="form-group">
					<input type="submit" name="save" class="form-control btn btn-success">
				</fieldset>
				<fieldset class="form-group">
					<input value="Update" type="submit" name="update" class="form-control btn btn-primary" style="display: none;">
				</fieldset>
			</form>
		</div>
		<div class="col col-sm-12 col-md-8 col-lg-8">
			<h3 class="alert alert-info text-center">Users</h3>
			<table class="table table-striped">
				<thead class="table-dark text-white">
					<tr>
						<th>Id</th>
						<th>Name</th>
						<th>Email</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody id="table-body">
					<?php 

						$res = $db->query("SELECT * FROM `users`");
						while ($row = $res->fetchArray()) {
							?>

								<tr>
									<td class="id"><?php echo $row['id']; ?></td>
									<td class="name"><?php echo $row['name']; ?></td>
									<td class="email"><?php echo $row['email']; ?></td>
									<td>
										<button class="btn btn-info edit-btn">Edit</button>
										<a href="index.php?del&id=<?php echo $row['id']; ?>" 
											class="btn btn-danger">Delete
										</a>
									</td>									
								</tr>

							<?php
						}

					?>
				</tbody>
			</table>
		</div>
	</div>
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/script.js"></script>
</body>
</html>