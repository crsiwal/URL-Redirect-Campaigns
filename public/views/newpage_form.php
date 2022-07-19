<?php
$content = [
	"title" => "Add new campaign | Redirect Campaign Tool",
	"description" => "add new campaign for public use",
];
$errorMessage = session("error");
$error = (empty($errorMessage) ? false : true);
$formData = ($error) ? session("formdata") : [];
?>
<?php include("header.php"); ?>
<?php include("navbar.php"); ?>
<main class="login">
	<div class="container">
		<div class="row bg-white mt-3">
			<div class="col-12 col-md-6 m-auto card px-5 py-2 pb-5">
				<h1 class="fs-2 mt-3">Add New Webpage</h1>
				<p>Based on the priority this webpage will be redirect</p>
				<?php
				if ($error) {
				?>
					<p class="text-danger"><?= $errorMessage; ?></p>
				<?php
				} else {
				?>
					<p class="text-success"><?= session("success"); ?></p>
				<?php
				}
				?>
				<form action="<?= base_url("post/newpage"); ?>" method="POST">

					<!-- title input -->
					<div class="mb-3">
						<label for="title" class="form-label">Webpage title</label>
						<input type="text" class="form-control" id="title" placeholder="Webpage title" name="t" value="<?= isset($formData["title"]) ? $formData["title"] : ""; ?>">
					</div>

					<!-- Webpage URL input -->
					<div class="mb-3">
						<label for="url" class="form-label">Webpage url</label>
						<input type="text" class="form-control" id="url" placeholder="Webpage url" name="u" value="<?= isset($formData["weburl"]) ? $formData["weburl"] : ""; ?>">
					</div>

					<!-- Bitly Webpage URL input -->
					<div class="mb-3">
						<label for="bitly" class="form-label">Bitly Webpage url</label>
						<input type="text" class="form-control" id="bitly" placeholder="Bitly Webpage url" name="b" value="<?= isset($formData["bitly"]) ? $formData["bitly"] : ""; ?>">
					</div>

					<!-- Webpage priority select -->
					<div class="mb-3">
						<label for="priority" class="form-label">Priority</label>
						<input id="priority" type="range" class="form-range" min="1" max="3" name="p" value="<?= isset($formData["priority"]) ? $formData["priority"] : "1"; ?>" />
						<div class="d-flex">
							<div class="col-4 text-start">Low</div>
							<div class="col-4 ps-5 ps-3">
								<span class="ps-3">High</span>
							</div>
							<div class="col-4 text-end">Top</div>
						</div>
					</div>
					<div class="d-flex justify-content-center py-4">
						<button type="submit" class="btn btn-primary px-5">Add Webpage</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</main>
<?php include("footer.php"); ?>