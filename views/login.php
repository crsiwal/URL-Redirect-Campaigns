<!DOCTYPE html>
<html lang="en">
<head>
  <title>Add new Campaign</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container">
  <h1>Add New Campaign</h1>
  <p>This campaign will be used for promotion</p>
  <form action="">
		<div class="mb-3 mt-3">
			<label for="email" class="form-label">Email:</label>
			<input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
		</div>
		<div class="mb-3">
			<label for="pwd" class="form-label">Password:</label>
			<input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pswd">
		</div>
		<div class="form-check mb-3">
			<label class="form-check-label">
				<input class="form-check-input" type="checkbox" name="remember"> Remember me
			</label>
		</div>
		<button type="submit" class="btn btn-primary">Submit</button>
	</form>

</div>
</body>
</html>