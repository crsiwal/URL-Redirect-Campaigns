<?php
global $conn;
load("db.con", "lib");
$content = [
	"title" => "Campaign List | Redirect Campaign Tool",
	"description" => "This is a list of campaigns added in this system.",
];

$offset = (isset($_GET["o"]) ? $_GET["0"] : 0) * 20;
$private = (isset($_GET["p"]) ? $_GET["p"] : 0);
$search = (isset($_GET["s"]) ? $_GET["s"] : "");

$query = "SELECT * FROM wp_campaigns WHERE is_adult=$private";
if (!empty($search)) {
	$search =  $conn->real_escape_string($search);
	$query .= " AND ( title like '%$search%'";
	$query .= " OR slug like '%$search%'";
	$query .= " OR page_url like '%$search%' )";
}
$query .= " order by id desc limit $offset, 20;";
$campaigns = $conn->query($query);
include("header.php");
include("navbar.php");
?>
<main class="campaigns">
	<div class="container">
		<div class="row bg-white mt-2">
			<div class="col-md-8">
				<div class="search">
					<form action="<?= base_url("campaign"); ?>" method="get">
						<i class="fa fa-search"></i>
						<input name="s" type="text" class="form-control" value="<?= $search; ?>" placeholder="Search campaign by name or URL">
						<input type="hidden" name="p" value="<?= $private; ?>" />
						<button class="btn btn-primary">Search</button>
					</form>
				</div>
			</div>
		</div>
		<div class="row bg-white mt-2">
			<?php
			if ($campaigns && $campaigns->num_rows >= 0) {
				while ($row = $campaigns->fetch_assoc()) {
			?>
					<div class="col-12 col-md-3">
						<div class="card">
							<img src="<?= $row["image_url"]; ?>" class="card-img-top" alt="<?= $row["title"]; ?>">
							<div class="card-body">
								<h6 class="fs-7 card-title"><?= $row["title"]; ?></h6>
								<p class="fs-8 card-text"><?= $row["summery"]; ?></p>
								<a href="<?= base_url($row["slug"]); ?>" class="fs-8 card-link">Campaign Link</a>
								<a href="<?= $row["page_url"]; ?>" class="fs-8 card-link">Redirect URL</a>
								<a href="<?= base_url("editcampaign?id=" . $row["id"]); ?>" class="fs-8 card-link">Edit</a>
							</div>
						</div>
					</div>
			<?php
				}
			}
			?>
		</div>
	</div>
</main>
<?php include("footer.php"); ?>