<?php
global $conn;
load("db.con", "lib");
$errorMessage = session("error");
$error = (empty($errorMessage) ? false : true);
if ($error) {
	$formData = session("formdata");
} else {
	if (isset($_GET["id"])) {
		$campaignId = $_GET["id"];
		$query = "SELECT * FROM wp_campaigns WHERE id=$campaignId;";
		$campaign = $conn->query($query);
		if ($campaign && $campaign->num_rows >= 1) {
			$data = $campaign->fetch_assoc();
			$formData = [
				"id" => $data["id"],
				"title" => $data["title"],
				"slug" => $data["slug"],
				"description" => $data["summery"],
				"autoselectimage" => false,
				"image" => $data["image_url"],
				"autoselecttargeturl" => (empty($data["page_url"])) ? true : false,
				"weburl" => $data["page_url"],
				"bitly" => $data["bitly_url"],
				"isadult" => $data["is_adult"],
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
<main class="newcampaign">
	<div class="container">
		<div class="row bg-white mt-2">
			<div class="col-12 col-md-6 m-auto card px-5 py-2 my-4">
				<h1 class="fs-2 mt-3">Edit Campaign</h1>
				<p>This campaign will be used for promotion</p>
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
				<form action="<?= base_url("post/editcampaign"); ?>" method="POST">

					<!-- title input -->
					<div class="mb-3">
						<label for="title" class="form-label">Campaign Title</label>
						<input name="t" type="text" class="form-control" id="title" placeholder="Write a title of campaign" value="<?= isset($formData["title"]) ? $formData["title"] : ""; ?>">
					</div>

					<!-- Slug input -->
					<div class="mb-3">
						<label for="slug" class="form-label">Page Slug</label>
						<input name="s" type="text" class="form-control" id="slug" placeholder="Type a slug (English only)" value="<?= isset($formData["slug"]) ? $formData["slug"] : ""; ?>">
					</div>

					<!-- Description input -->
					<div class="mb-3">
						<label class="form-label" for="description">Description</label>
						<textarea name="d" class="form-control" id="description" type="text" placeholder="Description" style="height: 5rem;"><?= isset($formData["description"]) ? $formData["description"] : ""; ?></textarea>
					</div>

					<!-- Preview photo input -->
					<div class="mb-3">
						<label for="photo" class="form-label">Image URL</label>
						<div class="d-flex">
							<input name="i" type="text" class="form-control" id="photo" placeholder="Preview photo URL" value="<?= (isset($formData["autoselectimage"]) && !$formData["autoselectimage"]) ? (isset($formData["image"]) ? $formData["image"] : "") : ""; ?>" <?= (isset($formData["autoselectimage"]) && !$formData["autoselectimage"]) ? "" : 'disabled="disabled"'; ?> />
							<div class="fs-6 px-4 mt-2">OR</div>
							<div class="form-check form-switch text-nowrap mt-2">
								<input name="ias" class="form-check-input" type="checkbox" id="imageautoselect" <?= (isset($formData["autoselectimage"]) && !$formData["autoselectimage"]) ? "" : 'checked="checked"'; ?>>
								<label class="form-check-label" for="imageautoselect">Auto Select</label>
							</div>
						</div>
					</div>

					<!-- Target URL input -->
					<div class="mb-3">
						<label for="webpage" class="form-label">Target URL</label>
						<div class="d-flex">
							<input name="u" type="text" class="form-control" id="webpage" placeholder="Webpage URL" value="<?= (isset($formData["autoselecttargeturl"]) && !$formData["autoselecttargeturl"]) ? (isset($formData["weburl"]) ? $formData["weburl"] : "") : ""; ?>" <?= (isset($formData["autoselecttargeturl"]) && !$formData["autoselecttargeturl"]) ? "" : 'disabled="disabled"'; ?> />
							<div class="fs-6 px-4 mt-2">OR</div>
							<div class="form-check form-switch text-nowrap mt-2">
								<input name="uas" class="form-check-input" type="checkbox" id="urlautoselect" <?= (isset($formData["autoselecttargeturl"]) && !$formData["autoselecttargeturl"]) ? "" : 'checked="checked"'; ?>>
								<label class="form-check-label" for="urlautoselect">Auto Select</label>
							</div>
						</div>
					</div>

					<!-- Bitly Webpage URL input -->
					<div class="mb-3">
						<label for="bitly" class="form-label">Bitly Webpage url</label>
						<input name="b" type="text" class="form-control" id="bitly" placeholder="Bitly Webpage url" value="<?= (isset($formData["autoselecttargeturl"]) && !$formData["autoselecttargeturl"]) ? (isset($formData["bitly"]) ? $formData["bitly"] : "") : ""; ?>" <?= (isset($formData["autoselecttargeturl"]) && !$formData["autoselecttargeturl"]) ? "" : 'disabled="disabled"'; ?> />
					</div>

					<div class="d-flex justify-content-between">
						<div class="form-check form-switch">
							<input name="ia" class="form-check-input" type="checkbox" id="privatecampaign" <?= (isset($formData["isadult"]) && !$formData["isadult"]) ? "" : 'checked="checked"'; ?> />
							<label class="form-check-label" for="privatecampaign">Private Campaign</label>
						</div>
						<input type="hidden" name="id" value="<?= isset($formData["id"]) ? $formData["id"] : ""; ?>">
						<button type="submit" class="btn btn-primary px-5">Update campaign</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</main>
<?php include("footer.php"); ?>