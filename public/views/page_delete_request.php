<?php
global $conn;
load("db.con", "lib");
if (isset($_POST["id"])) {
	$id = $conn->real_escape_string($_POST["id"]);
	$sql = "DELETE from wp_pages where id=$id";
	if ($conn->query($sql) === TRUE) {
		$error = false;
		$_SESSION["success"] = "Page deleted successfully";
	} else {
		$error = true;
		$_SESSION["error"] = $conn->error;
	}
	$redirectLocation = base_url("page");
	header("Location: $redirectLocation");
} elseif (isset($_GET["id"])) {
	$query = "SELECT * FROM wp_pages WHERE id=${_GET["id"]};";
	$page = $conn->query($query);
	if ($page && $page->num_rows >= 1) {
		$data = $page->fetch_assoc();
		include("header.php");
		include("navbar.php");
?>
		<main class="newcampaign">
			<div class="container">
				<div class="row bg-white mt-2">
					<div class="col-12 col-md-6 m-auto card px-5 py-5 my-4">
						<h1 class="fs-2 mt-3">Delete Page</h1>
						<p>Are you sure you want to delete this page ?</p>
						<p><b>Title:</b> <?= $data["page_name"]; ?></p>
						<p><b>URL:</b> <?= $data["page_url"]; ?></p>
						<p><b>Bitly URL:</b> <?= $data["bitly_url"]; ?></p>
						<p><b>Priority:</b> <?= $data["priority"]; ?></p>
						<form action="<?= base_url("post/delpage"); ?>" method="POST">
							<input type="hidden" name="id" value="<?= $_GET["id"]; ?>">
							<button type="submit" class="btn btn-danger px-5 me-3">Yes</button>
							<a href="<?= base_url("page"); ?>" class="btn btn-primary px-5">No</a>
						</form>
					</div>
				</div>
			</div>
		</main>
		<?php include("footer.php"); ?>
<?php
	}
}
