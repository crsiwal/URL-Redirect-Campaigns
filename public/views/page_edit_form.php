<?php
global $conn;
load("db.con", "lib");
$errorMessage = session("error");
$error = (empty($errorMessage) ? false : true);
if ($error) {
	$formData = session("formdata");
} else {
	if (isset($_GET["id"])) {
		$pageId = $_GET["id"];
		$query = "SELECT * FROM wp_pages WHERE id=$pageId;";
		$page = $conn->query($query);
		if ($page && $page->num_rows >= 1) {
			$data = $page->fetch_assoc();
			$formData = [
				"id" => $data["id"],
				"title" => $data["page_name"],
				"weburl" => $data["page_url"],
				"bitly" => $data["bitly_url"],
				"priority" => $data["priority"],
			];
		}
	} else {
		// Redirect to home
	}
}
$content = [
	"title" => isset($formData["title"]) ? $formData["title"] : "",
	"description" => isset($formData["description"]) ? $formData["description"] : "",
];
?>
<?php include("header.php"); ?>
<?php include("navbar.php"); ?>
<main class="newpage">
	<div class="container">
		<div class="row bg-white mt-2">
			<div class="col-12 col-md-6 m-auto card px-5 py-2 my-4">
				<h1 class="fs-2 mt-3">Edit Webpage</h1>
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
				<form action="<?= base_url("post/editpage"); ?>" method="POST">

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
						<input type="hidden" name="id" value="<?= isset($formData["id"]) ? $formData["id"] : ""; ?>">
						<button type="submit" class="btn btn-primary px-5">Update Webpage</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</main>
<?php include("footer.php"); ?>