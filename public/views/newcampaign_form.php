<?php
$content = [
	"title" => "Add new campaign | Redirect Campaign Tool",
	"description" => "add new campaign for public use",
];
?>
<?php include("header.php"); ?>
<?php include("navbar.php"); ?>
<main class="login">
	<div class="container">
		<div class="row bg-white mt-2">
			<div class="col-12 col-md-6 m-auto card px-5 py-2 my-4">
				<h1 class="fs-2 mt-3">Add New Campaign</h1>
				<p>This campaign will be used for promotion</p>
				<form action="<?= base_url("post/newcampaign"); ?>" method="POST">

					<!-- title input -->
					<div class="mb-3">
						<label for="title" class="form-label">Campaign Title</label>
						<input type="text" class="form-control" id="title" placeholder="Write a title of campaign" name="t">
					</div>

					<!-- Slug input -->
					<div class="mb-3">
						<label for="slug" class="form-label">Page Slug</label>
						<input type="text" class="form-control" id="slug" placeholder="Type a slug (English only)" name="s">
					</div>

					<!-- Message input -->
					<div class="mb-3">
						<label class="form-label" for="message">Message</label>
						<textarea name="m" class="form-control" id="message" type="text" placeholder="Message" style="height: 5rem;"></textarea>
					</div>

					<!-- Preview photo input -->
					<div class="mb-3">
						<label for="photo" class="form-label">Image URL</label>
						<input type="text" class="form-control" id="photo" placeholder="Preview photo URL" name="i">
					</div>

					<!-- Target URL input -->
					<div class="mb-3">
						<label for="webpage" class="form-label">Target URL</label>
						<input type="text" class="form-control" id="webpage" placeholder="Webpage URL" name="u" />
					</div>

					<!-- Bitly Webpage URL input -->
					<div class="mb-3">
						<label for="bitly" class="form-label">Bitly Webpage url</label>
						<input type="text" class="form-control" id="bitly" placeholder="Bitly Webpage url" name="b">
					</div>

					<div class="d-flex justify-content-between">
						<div class="form-check form-switch">
							<input name="ia" class="form-check-input" type="checkbox" id="privatecampaign" checked="checked">
							<label class="form-check-label" for="privatecampaign">Private Campaign</label>
						</div>
						<button type="submit" class="btn btn-primary px-5">Add new campaign</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</main>
<?php include("footer.php"); ?>