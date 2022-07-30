<?php
global $conn;
load("db.con", "lib");
$content = [
	"title" => "Page List | Redirect Campaign Tool",
	"description" => "This is a list of pages added in this system.",
];

$offset = (isset($_GET["o"]) ? $_GET["0"] : 0) * 20;
$search = (isset($_GET["s"]) ? $_GET["s"] : "");

$query = "SELECT * FROM wp_pages";
if (!empty($search)) {
	$search =  $conn->real_escape_string($search);
	$query .= " WHERE ( page_name like '%$search%'";
	$query .= " OR page_url like '%$search%'";
	$query .= " OR bitly_url like '%$search%' )";
}
$query .= " order by priority desc limit $offset, 20;";
$pages = $conn->query($query);
include("header.php");
include("navbar.php");
?>
<main class="campaigns">
	<div class="container">
		<div class="row bg-white mt-2">
			<div class="col-md-8">
				<div class="search">
					<form action="<?= base_url("page"); ?>" method="get">
						<i class="fa fa-search"></i>
						<input name="s" type="text" class="form-control" value="<?= $search; ?>" placeholder="Search page by name or URL">
						<button class="btn btn-primary">Search</button>
					</form>
				</div>
			</div>
		</div>
		<div class="row bg-white mt-2">

			<table class="table">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Page Name</th>
						<th scope="col">Page/Bitly URL</th>
						<th scope="col">Priority</th>
						<th scope="col">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if ($pages && $pages->num_rows >= 0) {
						while ($row = $pages->fetch_assoc()) {
					?>
							<tr>
								<th scope="row"><?= $row["id"]; ?></th>
								<td><?= $row["page_name"]; ?></td>
								<td style="font-size: 12px;">
									<div><a href="<?= $row["page_url"]; ?>"><?= $row["page_url"]; ?></a></div>
									<div><a href="<?= $row["bitly_url"]; ?>"><?= $row["bitly_url"]; ?></a></div>
								</td>
								<td><?= $row["priority"]; ?></td>
								<td>
									<a href="<?= base_url("editpage?id=" . $row["id"]); ?>" class="fs-8 card-link">Edit</a>
									<a href="<?= base_url("post/delpage?id=" . $row["id"]); ?>" class="fs-8 card-link">Delete</a>
								</td>
							</tr>
					<?php
						}
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
</main>
<?php include("footer.php"); ?>